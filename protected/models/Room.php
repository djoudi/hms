<?php

/**
 * This is the model class for table "Room".
 *
 * The followings are the available columns in table 'Room':
 * @property integer $Id
 * @property string $Name
 * @property integer $Type_Id
 * @property string $Tags
 * @property integer $Status
 * @property integer $IsArchieved
 *
 * The followings are the available model relations:
 * @property Metadata[] $metadatas
 * @property Roomtype $type
 * @property RoomWithGuest[] $roomWithGuests
 * @property Roompriceschedule[] $roompriceschedules
 */
class Room extends CActiveRecord
{
	private $_oldTags;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Room the static model class
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
		return 'Room';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Type_Id, Name', 'required'),
			array('Type_Id, Status, IsArchieved', 'numerical', 'integerOnly'=>true),
			array('Status', 'in', 'range'=>array(1,2,3)),
			array('Name', 'length', 'max'=>45),
			array('Tags', 'match', 'pattern'=>'/^[\w\s,]+$/',
				'message'=>'Tags can only contain word characters.'),
			array('Tags', 'normalizeTags'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Name, Type_Id, Tags, Status, IsArchieved', 'safe', 'on'=>'search'),
		);
	}

	public function normalizeTags($attribute,$params)
	{
	    $this->Tags=Tag::array2string(array_unique(Tag::string2array($this->Tags)));
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Metadatas' => array(self::HAS_MANY, 'Metadata', 'Room_Id'),
			'Type' => array(self::BELONGS_TO, 'Roomtype', 'Type_Id'),
			//'roomWithGuests' => array(self::HAS_MANY, 'RoomWithGuest', 'Room_Id'),
			//'roompriceschedules' => array(self::HAS_MANY, 'Roompriceschedule', 'Room_Id'),
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
			'Type_Id' => 'Type',
			'Tags' => 'Tags',
			'Status' => 'Status',
			'IsArchieved' => 'Is Archieved',
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
		$criteria->compare('Type_Id',$this->Type_Id);
		$criteria->compare('Tags',$this->Tags,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('IsArchieved',$this->IsArchieved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterFind() {
		parent::afterFind();
		$this->_oldTags = $this->Tags;
	}
	
	protected function afterSave() {
		parent::afterSave();
		Tag::model()->updateFrequency($this->_oldTags, $this->Tags);
	}
	
		/**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->Tags) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('post/index', 'tag'=>$tag));
		return $links;
	}
}