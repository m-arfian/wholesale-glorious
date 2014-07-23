<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property integer $SUPPLIER_ID
 * @property string $SUPPLIER_NAMA
 * @property string $NAMA_PEMILIK
 * @property string $SUPPLIER_BIDANG
 * @property string $SUPPLIER_EMAIL
 * @property string $SUPPLIER_KONTAK
 * @property string $SUPPLIER_LOKASI
 * @property integer $SUPPLIER_KOTA
 * @property string $SUPPLIER_DESKRIPSI
 * @property string $SUPPLIER_TGL
 * @property integer $SUPPLIER_STATUS
 *
 * The followings are the available model relations:
 * @property Kota $kota
 */
class Supplier extends CActiveRecord {
    
    public $SUPPLIER_PROVINSI, $CAPTCHA;
    
    const BARU = 0;
    const OK = 1;
    const TOLAK = -1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'supplier';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NAMA_PEMILIK, SUPPLIER_BIDANG, SUPPLIER_DESKRIPSI, CAPTCHA', 'required', 'on' => 'supplierbaru', 'message' => '{attribute} wajib diisi'),
            array('SUPPLIER_KOTA, SUPPLIER_PROVINSI, SUPPLIER_STATUS', 'numerical', 'integerOnly' => true),
            array('SUPPLIER_NAMA, NAMA_PEMILIK, SUPPLIER_BIDANG, SUPPLIER_EMAIL', 'length', 'max' => 127),
            array('SUPPLIER_KONTAK', 'length', 'max' => 31),
            array('SUPPLIER_LOKASI, SUPPLIER_TGL', 'safe'),
            array('CAPTCHA', 'CaptchaExtendedValidator', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'supplierbaru'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('SUPPLIER_ID, SUPPLIER_NAMA, NAMA_PEMILIK, SUPPLIER_BIDANG, SUPPLIER_EMAIL, SUPPLIER_KONTAK, SUPPLIER_LOKASI, SUPPLIER_KOTA, SUPPLIER_DESKRIPSI, SUPPLIER_TGL, SUPPLIER_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kota' => array(self::BELONGS_TO, 'Kota', 'SUPPLIER_KOTA'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'SUPPLIER_ID' => 'Supplier ID',
            'SUPPLIER_NAMA' => 'Nama Usaha',
            'NAMA_PEMILIK' => 'Nama Pemilik',
            'SUPPLIER_BIDANG' => 'Bidang usaha/Produk',
            'SUPPLIER_EMAIL' => 'Email yang aktif',
            'SUPPLIER_KONTAK' => 'Kontak yang aktif',
            'SUPPLIER_LOKASI' => 'Lokasi Supplier',
            'SUPPLIER_PROVINSI' => 'Provinsi',
            'SUPPLIER_KOTA' => 'Kota',
            'SUPPLIER_DESKRIPSI' => 'Deskripsi dari bidang usaha/produk',
            'SUPPLIER_STATUS' => 'Supplier Status',
            'CAPTCHA' => 'Kode verifikasi'
        );
    }
    
//    public function guide() {
//        return array(
//            'SUPPLIER_ID' => 'Supplier',
//            'SUPPLIER_NAMA' => 'Nama Usaha',
//            'NAMA_PEMILIK' => 'Nama Pemilik',
//            'SUPPLIER_BIDANG' => 'Bidang usaha/Produk',
//            'SUPPLIER_EMAIL' => 'Email yang aktif',
//            'SUPPLIER_KONTAK' => 'Kontak yang aktif',
//            'SUPPLIER_LOKASI' => 'Lokasi Supplier',
//            'SUPPLIER_KOTA' => 'Kota',
//            'SUPPLIER_DESKRIPSI' => 'Deskripsi dari bidang usaha/produk',
//            'SUPPLIER_STATUS' => 'Supplier Status',
//        );
//    }

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

        $criteria->compare('SUPPLIER_ID', $this->SUPPLIER_ID);
        $criteria->compare('SUPPLIER_NAMA', $this->SUPPLIER_NAMA, true);
        $criteria->compare('NAMA_PEMILIK', $this->NAMA_PEMILIK, true);
        $criteria->compare('SUPPLIER_BIDANG', $this->SUPPLIER_BIDANG, true);
        $criteria->compare('SUPPLIER_EMAIL', $this->SUPPLIER_EMAIL, true);
        $criteria->compare('SUPPLIER_KONTAK', $this->SUPPLIER_KONTAK, true);
        $criteria->compare('SUPPLIER_LOKASI', $this->SUPPLIER_LOKASI, true);
        $criteria->compare('SUPPLIER_KOTA', $this->SUPPLIER_KOTA);
        $criteria->compare('SUPPLIER_DESKRIPSI', $this->SUPPLIER_DESKRIPSI, true);
        $criteria->compare('SUPPLIER_STATUS', $this->SUPPLIER_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function searchSIM() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'SUPPLIER_ID desc';

        $criteria->compare('SUPPLIER_ID', $this->SUPPLIER_ID);
        $criteria->compare('SUPPLIER_NAMA', $this->SUPPLIER_NAMA, true);
        $criteria->compare('NAMA_PEMILIK', $this->NAMA_PEMILIK, true);
        $criteria->compare('SUPPLIER_BIDANG', $this->SUPPLIER_BIDANG, true);
        $criteria->compare('SUPPLIER_EMAIL', $this->SUPPLIER_EMAIL, true);
        $criteria->compare('SUPPLIER_KONTAK', $this->SUPPLIER_KONTAK, true);
        $criteria->compare('SUPPLIER_LOKASI', $this->SUPPLIER_LOKASI, true);
        $criteria->compare('SUPPLIER_KOTA', $this->SUPPLIER_KOTA);
        $criteria->compare('SUPPLIER_DESKRIPSI', $this->SUPPLIER_DESKRIPSI, true);
        $criteria->compare('SUPPLIER_STATUS', $this->SUPPLIER_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Supplier the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    protected function beforeSave() {
        parent::beforeSave();
        if($this->scenario == 'supplierbaru') {
            $this->SUPPLIER_TGL = date('Y-m-d');
        }
        
        return true;
    }

}
