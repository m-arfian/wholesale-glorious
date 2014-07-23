<?php

/**
 * This is the model class for table "m_ekspedisi".
 *
 * The followings are the available columns in table 'm_ekspedisi':
 * @property integer $EKSPEDISI_ID
 * @property string $EKSPEDISI_NAMA
 * @property integer $EKSPEDISI_TIPE
 * @property integer $EKSPEDISI_STATUS
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 */
class Ekspedisi extends CActiveRecord {

    const BIAYA_SEMENTARA = 0;
    
    /* TIPE */
    const EKSP_NON_KONV = 2;
    const EKSP_KONV = 1;
    const EKSP_TEMP = 0;
    
    /* ID */
    const NO_EKSPEDISI = 1;
    const NON_KONVENSIONAL = 2;
    
    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /*sementara*/
//    const EKS_NONTRACKING = 2;
//    const EKS_LATER = 1;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_ekspedisi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('EKSPEDISI_NAMA, EKSPEDISI_TIPE', 'required'),
            array('EKSPEDISI_TIPE, EKSPEDISI_STATUS', 'numerical', 'integerOnly' => true),
            array('EKSPEDISI_NAMA', 'length', 'max' => 25),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('EKSPEDISI_ID, EKSPEDISI_NAMA, EKSPEDISI_TIPE, EKSPEDISI_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order' => array(self::HAS_MANY, 'Order', 'EKSPEDISI_ID'),
            'periodik' => array(self::HAS_MANY, 'Periodik', 'EKSPEDISI_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'EKSPEDISI_ID' => 'Ekspedisi',
            'EKSPEDISI_NAMA' => 'Ekspedisi Nama',
            'EKSPEDISI_TIPE' => 'Ekspedisi Tipe',
            'EKSPEDISI_STATUS' => 'Ekspedisi Status',
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

        $criteria->compare('EKSPEDISI_ID', $this->EKSPEDISI_ID);
        $criteria->compare('EKSPEDISI_NAMA', $this->EKSPEDISI_NAMA, true);
        $criteria->compare('EKSPEDISI_TIPE', $this->EKSPEDISI_TIPE);
        $criteria->compare('EKSPEDISI_STATUS', $this->EKSPEDISI_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ekspedisi the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function ListAll() {
        return self::ListTemporary()+self::ListKonvensional()+self::ListNonKonvensional();
    }
    
    public static function ListKonvensional() {
        return CHtml::listData(self::model()->findAll('EKSPEDISI_TIPE=1 and EKSPEDISI_STATUS=1'), 'EKSPEDISI_ID', 'EKSPEDISI_NAMA');
    }
    
    public static function ListNonKonvensional() {
        return CHtml::listData(self::model()->findAll('EKSPEDISI_TIPE=2 and EKSPEDISI_STATUS=1'), 'EKSPEDISI_ID', 'EKSPEDISI_NAMA');
    }
    
    public static function ListTemporary() {
        return CHtml::listData(self::model()->findAll('EKSPEDISI_TIPE=0 and EKSPEDISI_STATUS=1'), 'EKSPEDISI_ID', 'EKSPEDISI_NAMA');
    }

}
