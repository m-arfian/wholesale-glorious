<?php

/**
 * This is the model class for table "m_kota".
 *
 * The followings are the available columns in table 'm_kota':
 * @property integer $KOTA_ID
 * @property string $KOTA_NAMA
 * @property integer $PROVINSI_ID
 * @property integer $WILAYAH_ID
 * @property integer $KOTA_STATUS
 *
 * The followings are the available model relations:
 * @property AlamatPengiriman[] $alamatPengirimen
 * @property MProvinsi $pROVINSI
 * @property MWilayah $wILAYAH
 */
class Kota extends CActiveRecord {

    const WIL_KOTA = 1;
    const WIL_KAB = 2;
    
    const AKTIF = 1;
    const NONAKTIF = 2;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_kota';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('KOTA_NAMA, PROVINSI_ID, WILAYAH_ID', 'required'),
            array('PROVINSI_ID, WILAYAH_ID, KOTA_STATUS', 'numerical', 'integerOnly' => true),
            array('KOTA_NAMA', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('KOTA_ID, KOTA_NAMA, PROVINSI_ID, WILAYAH_ID, KOTA_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'alamatpengiriman' => array(self::HAS_MANY, 'AlamatPengiriman', 'KOTA_ID'),
            'provinsi' => array(self::BELONGS_TO, 'Provinsi', 'PROVINSI_ID'),
            'wilayah' => array(self::BELONGS_TO, 'Wilayah', 'WILAYAH_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'KOTA_ID' => 'Kota',
            'KOTA_NAMA' => 'Kota',
            'PROVINSI_ID' => 'Provinsi',
            'WILAYAH_ID' => 'Wilayah',
            'KOTA_STATUS' => 'Kota Status',
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

        $criteria->compare('KOTA_ID', $this->KOTA_ID);
        $criteria->compare('KOTA_NAMA', $this->KOTA_NAMA, true);
        $criteria->compare('PROVINSI_ID', $this->PROVINSI_ID);
        $criteria->compare('WILAYAH_ID', $this->WILAYAH_ID);
        $criteria->compare('KOTA_STATUS', $this->KOTA_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Kota the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function ListByProvinsi($id) {
        if(!empty($id)) {    // awalnya !is_null
            $criteria = new CDbCriteria(array(
                'condition' => "PROVINSI_ID=$id AND KOTA_STATUS=1",
                'order' => 'WILAYAH_ID',
            ));
            $newlist = array();
            $list = self::model()->findAll($criteria);
            foreach ($list as $row) {
                $newlist[$row->KOTA_ID] = $row->WILAYAH_ID==1 ? 'Kota '.$row->KOTA_NAMA : 'Kabupaten '.$row->KOTA_NAMA;
            }

            return $newlist;
        }
        else
            return array();
    }
    
    public static function KabOrKota($id) {
        // mendapatkan nama kota/kabupaten beserta atribut kota/kabupaten masing2
        $kota = self::model()->find('KOTA_ID='.$id);
        return $kota->WILAYAH_ID==1 ? 'Kota '.$kota->KOTA_NAMA : 'Kabupaten '.$kota->KOTA_NAMA;
    }

}
