<?php

/**
 * This is the model class for table "periodik_detail".
 *
 * The followings are the available columns in table 'periodik_detail':
 * @property integer $PERIODIK_DETAIL_ID
 * @property integer $PERIODIK_ID
 * @property string $ORDER_ID
 * @property string $SENT_DATE
 *
 * The followings are the available model relations:
 * @property Order $oRDER
 * @property Periodik $pERIODIK
 */
class PeriodikDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'periodik_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PERIODIK_ID, ORDER_ID, SENT_DATE', 'required'),
			array('PERIODIK_ID', 'numerical', 'integerOnly'=>true),
			array('ORDER_ID', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PERIODIK_DETAIL_ID, PERIODIK_ID, ORDER_ID, SENT_DATE', 'safe', 'on'=>'search'),
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
			'oRDER' => array(self::BELONGS_TO, 'Order', 'ORDER_ID'),
			'pERIODIK' => array(self::BELONGS_TO, 'Periodik', 'PERIODIK_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PERIODIK_DETAIL_ID' => 'Periodik Detail',
			'PERIODIK_ID' => 'Periodik',
			'ORDER_ID' => 'Order',
			'SENT_DATE' => 'Sent Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('PERIODIK_DETAIL_ID',$this->PERIODIK_DETAIL_ID);
		$criteria->compare('PERIODIK_ID',$this->PERIODIK_ID);
		$criteria->compare('ORDER_ID',$this->ORDER_ID,true);
		$criteria->compare('SENT_DATE',$this->SENT_DATE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PeriodikDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
