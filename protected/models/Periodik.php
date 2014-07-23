<?php

/**
 * This is the model class for table "periodik".
 *
 * The followings are the available columns in table 'periodik':
 * @property integer $PERIODIK_ID
 * @property integer $ALAMAT_ID
 * @property string $PERIODIK_NAMA
 * @property integer $NUM_WAKTU
 * @property integer $SATUAN_WAKTU_ID
 * @property string $CREATE_DATE
 * @property integer $EKSPEDISI_ID
 * @property integer $PERIODIK_STATUS
 *
 * The followings are the available model relations:
 * @property AlamatPengiriman $aLAMAT
 * @property MEkspedisi $eKSPEDISI
 * @property MSatuanWaktu $sATUANWAKTU
 * @property PeriodikDetail[] $periodikDetails
 */
class Periodik extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'periodik';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ALAMAT_ID, PERIODIK_NAMA, NUM_WAKTU, SATUAN_WAKTU_ID, CREATE_DATE, EKSPEDISI_ID, PERIODIK_STATUS', 'required'),
			array('ALAMAT_ID, NUM_WAKTU, SATUAN_WAKTU_ID, EKSPEDISI_ID, PERIODIK_STATUS', 'numerical', 'integerOnly'=>true),
			array('PERIODIK_NAMA', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PERIODIK_ID, ALAMAT_ID, PERIODIK_NAMA, NUM_WAKTU, SATUAN_WAKTU_ID, CREATE_DATE, EKSPEDISI_ID, PERIODIK_STATUS', 'safe', 'on'=>'search'),
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
			'aLAMAT' => array(self::BELONGS_TO, 'AlamatPengiriman', 'ALAMAT_ID'),
			'eKSPEDISI' => array(self::BELONGS_TO, 'MEkspedisi', 'EKSPEDISI_ID'),
			'sATUANWAKTU' => array(self::BELONGS_TO, 'MSatuanWaktu', 'SATUAN_WAKTU_ID'),
			'periodikDetails' => array(self::HAS_MANY, 'PeriodikDetail', 'PERIODIK_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PERIODIK_ID' => 'Periodik',
			'ALAMAT_ID' => 'Alamat',
			'PERIODIK_NAMA' => 'Periodik Nama',
			'NUM_WAKTU' => 'Num Waktu',
			'SATUAN_WAKTU_ID' => 'Satuan Waktu',
			'CREATE_DATE' => 'Create Date',
			'EKSPEDISI_ID' => 'Ekspedisi',
			'PERIODIK_STATUS' => 'Periodik Status',
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

		$criteria->compare('PERIODIK_ID',$this->PERIODIK_ID);
		$criteria->compare('ALAMAT_ID',$this->ALAMAT_ID);
		$criteria->compare('PERIODIK_NAMA',$this->PERIODIK_NAMA,true);
		$criteria->compare('NUM_WAKTU',$this->NUM_WAKTU);
		$criteria->compare('SATUAN_WAKTU_ID',$this->SATUAN_WAKTU_ID);
		$criteria->compare('CREATE_DATE',$this->CREATE_DATE,true);
		$criteria->compare('EKSPEDISI_ID',$this->EKSPEDISI_ID);
		$criteria->compare('PERIODIK_STATUS',$this->PERIODIK_STATUS);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Periodik the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
