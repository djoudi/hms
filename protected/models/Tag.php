<?php

/**
 * This is the model class for table "Tag".
 *
 * The followings are the available columns in table 'Tag':
 * @property integer $Id
 * @property string $Name
 * @property integer $Frequency
 */
class Tag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name', 'required'),
			array('Frequency', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Name, Frequency', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Name' => 'Name',
			'Frequency' => 'Frequency',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Frequency',$this->Frequency);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function string2array($tags)
	{
	    return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}
	 
	public static function array2string($tags)
	{
	    return implode(', ',$tags);
	}

	public function updateFrequency($oldTags, $newTags)
	{
		$oldTags=self::string2array($oldTags);
		$newTags=self::string2array($newTags);
		$this->addTags(array_values(array_diff($newTags,$oldTags)));
		$this->removeTags(array_values(array_diff($oldTags,$newTags)));
	}

	public function addTags($tags)
	{
		$criteria=new CDbCriteria;
		$criteria->addInCondition('Name',$tags);
		$this->updateCounters(array('Frequency'=>1),$criteria);
		foreach($tags as $name)
		{
			if(!$this->exists('Name=:Name',array(':Name'=>$name)))
			{
				$tag=new Tag;
				$tag->Name=$name;
				$tag->Frequency=1;
				$tag->save();
			}
		}
	}

	public function removeTags($tags)
	{
		if(empty($tags))
			return;
		$criteria=new CDbCriteria;
		$criteria->addInCondition('Name',$tags);
		$this->updateCounters(array('Frequency'=>-1),$criteria);
		$this->deleteAll('Frequency<=0');
	}
}
