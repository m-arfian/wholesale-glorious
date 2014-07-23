<?php

/**
 * This is the model class for table "m_satuan_waktu".
 *
 * The followings are the available columns in table 'm_satuan_waktu':
 * @property integer $SATUAN_WAKTU_ID
 * @property string $SATUAN_WAKTU_NAMA
 * @property integer $SATUAN_WAKTU_TIPE
 * @property integer $SATUAN_WAKTU_STATUS
 *
 * The followings are the available model relations:
 * @property Periodik[] $periodiks
 */
class SatuanWaktu extends CActiveRecord {

    const TIPE_WAKTU = 1;
    const TIPE_TANGGAL = 2;
    
    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_satuan_waktu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SATUAN_WAKTU_NAMA, SATUAN_WAKTU_TIPE, SATUAN_WAKTU_STATUS', 'required'),
            array('SATUAN_WAKTU_TIPE, SATUAN_WAKTU_STATUS', 'numerical', 'integerOnly' => true),
            array('SATUAN_WAKTU_NAMA', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('SATUAN_WAKTU_ID, SATUAN_WAKTU_NAMA, SATUAN_WAKTU_TIPE, SATUAN_WAKTU_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'periodik' => array(self::HAS_MANY, 'Periodik', 'SATUAN_WAKTU_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'SATUAN_WAKTU_ID' => 'Satuan Waktu',
            'SATUAN_WAKTU_NAMA' => 'Satuan Waktu Nama',
            'SATUAN_WAKTU_TIPE' => 'Satuan Waktu Tipe',
            'SATUAN_WAKTU_STATUS' => 'Satuan Waktu Status',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('SATUAN_WAKTU_ID', $this->SATUAN_WAKTU_ID);
        $criteria->compare('SATUAN_WAKTU_NAMA', $this->SATUAN_WAKTU_NAMA, true);
        $criteria->compare('SATUAN_WAKTU_TIPE', $this->SATUAN_WAKTU_TIPE);
        $criteria->compare('SATUAN_WAKTU_STATUS', $this->SATUAN_WAKTU_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SatuanWaktu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
