<?php

/**
 * This is the model class for table "m_provinsi".
 *
 * The followings are the available columns in table 'm_provinsi':
 * @property integer $PROVINSI_ID
 * @property string $PROVINSI_NAMA
 * @property integer $PROVINSI_STATUS
 *
 * The followings are the available model relations:
 * @property AlamatPengiriman[] $alamatPengirimen
 * @property MKota[] $mKotas
 */
class Provinsi extends CActiveRecord {

    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_provinsi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('PROVINSI_NAMA', 'required'),
            array('PROVINSI_STATUS', 'numerical', 'integerOnly' => true),
            array('PROVINSI_NAMA', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('PROVINSI_ID, PROVINSI_NAMA, PROVINSI_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'alamatpengiriman' => array(self::HAS_MANY, 'AlamatPengiriman', 'PROVINSI_ID'),
            'kota' => array(self::HAS_MANY, 'Kota', 'PROVINSI_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        if($this->scenario == 'search')
            return array(
                'PROVINSI_ID' => 'Provinsi ID',
                'PROVINSI_NAMA' => 'Nama Provinsi',
                'PROVINSI_STATUS' => 'Provinsi Status',
            );
        
        return array(
            'PROVINSI_ID' => 'Provinsi',
            'PROVINSI_NAMA' => 'Provinsi',
            'PROVINSI_STATUS' => 'Provinsi Status',
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

        $criteria->compare('PROVINSI_ID', $this->PROVINSI_ID);
        $criteria->compare('PROVINSI_NAMA', $this->PROVINSI_NAMA, true);
        $criteria->compare('PROVINSI_STATUS', $this->PROVINSI_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Provinsi the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function ListAll() {
        return CHtml::listData(self::model()->findAll('PROVINSI_STATUS=1'), 'PROVINSI_ID', 'PROVINSI_NAMA');
    }

}
