<?php

/**
 * This is the model class for table "Guest".
 *
 * The followings are the available columns in table 'Guest':
 * @property string $Id
 * @property string $Name
 * @property integer $Gender
 * @property string $Email
 * @property string $Mobile
 *
 * The followings are the available model relations:
 * @property RoomWithGuest[] $roomWithGuests
 */
class Guest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Guest the static model class
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
		return 'guest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id', 'required'),
			array('Gender', 'numerical', 'integerOnly'=>true),
			array('Id, Name, Email, Mobile', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Name, Gender, Email, Mobile', 'safe', 'on'=>'search'),
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
			'roomWithGuests' => array(self::HAS_MANY, 'RoomWithGuest', 'Guest_Id'),
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
			'Gender' => 'Gender',
			'Email' => 'Email',
			'Mobile' => 'Mobile',
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

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Gender',$this->Gender);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Mobile',$this->Mobile,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
