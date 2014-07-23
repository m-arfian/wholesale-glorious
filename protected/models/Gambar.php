<?php

/**
 * This is the model class for table "m_gambar".
 *
 * The followings are the available columns in table 'm_gambar':
 * @property integer $GAMBAR_ID
 * @property string $GAMBAR_NAMA
 * @property string $GAMBAR_LOKASI
 * @property string $GAMBAR_STATUS
 *
 * The followings are the available model relations:
 * @property MKategori[] $kategori
 * @property Privileged[] $privileged
 * @property Registered[] $registered
 * @property SubGambar[] $subgambar
 * @property Subkategori[] $subkategori
 */
class Gambar extends CActiveRecord {
    
    // ID database gambar 
    const NO_IMAGE_LARGE = 1;
    const NO_IMAGE_MEDIUM = 2;
    const NO_IMAGE_SMALL = 3;
    const NO_IMAGE_ICON = 4;
    
    // Inisial gambar
    const LARGE = 'L';
    const MEDIUM = 'M';
    const SMALL = 'S';
    const ICON = 'I';
    
    // Standar lebar gambar
    const WIDTH_LARGE = 1000;
    const WIDTH_MEDIUM = 500;
    const WIDTH_SMALL = 250;
    const WIDTH_ICON = 80;

	// Status gambar
    const AKTIF = 1;
    const NONAKTIF = 0;
    
//    const URL_WEB = 1;      // gagal
//    const URL_SERVER = 2;   // gagal
    
    // Lokasi gambar (URL::Gambar)
    const URL_EKSTERN = 0;
    const URL_TOKO = 1;
    const URL_PELANGGAN = 2;
    const URL_PRODUK = 3;
    const URL_MAIL = 4;
    const URL_REKENING = 5;
    const URL_SUBKATEGORI = 6;
    const URL_KATEGORI = 7;
    const URL_LAIN = 99;
    
    public $GAMBAR_LOKASI;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_gambar';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('GAMBAR_LOKASI', 'required', 'on' => 'gambarbaru', 'message' => '{attribute} wajib diisi'),
            array('GAMBAR_NAMA', 'required', 'on' => 'barangbaru, rekeningbaru',
            	'message' => '{attribute} wajib diisi'),
            array('GAMBAR_NAMA', 'file', 'types' => 'jpg, png, bmp, jpeg',
                'maxSize' => 1024 * 300, // 300KB
                'tooLarge' => 'Ukuran file data pendukung maksimal 300 Kb',
                'allowEmpty' => false,
                'on' => 'barangbaru, rekeningbaru',
                'message' => 'Anda harus memilih file gambar.'
            ),
            array('GAMBAR_NAMA', 'file', 'types' => 'jpg, png, bmp, jpeg',
                'maxSize' => 1024 * 1024 * 1, // 1MB
                'tooLarge' => 'Ukuran file data pendukung maksimal 1 Mb',
                'allowEmpty' => true,
                'on' => 'akunbaru',
                'message' => 'Anda harus memilih file gambar.'
            ),
            array('GAMBAR_NAMA', 'length', 'max' => 200),
            array('GAMBAR_ID, GAMBAR_LOKASI, GAMBAR_STATUS', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('GAMBAR_ID, GAMBAR_NAMA, GAMBAR_LOKASI, GAMBAR_STATUS', 'safe', 'on' => 'search, view'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kategori' => array(self::HAS_MANY, 'Kategori', 'GAMBAR_ID'),
            'privileged' => array(self::HAS_MANY, 'Privileged', 'GAMBAR_ID'),
            'registered' => array(self::HAS_MANY, 'Registered', 'GAMBAR_ID'),
            'subgambarlarge' => array(self::HAS_MANY, 'SubGambar', 'GAMBAR_LARGE'),
            'subgambarmedium' => array(self::HAS_MANY, 'SubGambar', 'GAMBAR_MEDIUM'),
            'subgambarsmall' => array(self::HAS_MANY, 'SubGambar', 'GAMBAR_SMALL'),
            'subgambaricon' => array(self::HAS_MANY, 'SubGambar', 'GAMBAR_ICON'),
            'subkategori' => array(self::HAS_MANY, 'Subkategori', 'GAMBAR_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
    	$id = 'Gambar ID';
    	$nama = 'Gambar/Foto (Max 300Kb)';
    	$lokasi = 'Lokasi gambar';
    	$status = 'Status gambar';
    	
        if($this->scenario == 'view')
            $nama = 'Nama & alamat';
        else if($this->scenario == 'akunbaru')
        	$nama = 'Gambar/Foto (Maks 1Mb)';
            
        return array(
            'GAMBAR_ID' => $id,
            'GAMBAR_NAMA' => $nama,
            'GAMBAR_LOKASI' => $lokasi,
            'GAMBAR_STATUS' => $status,
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

        $criteria->compare('GAMBAR_ID', $this->GAMBAR_ID);
        $criteria->compare('GAMBAR_NAMA', $this->GAMBAR_NAMA, true);
        $criteria->compare('GAMBAR_LOKASI', $this->GAMBAR_LOKASI, true);
        $criteria->compare('GAMBAR_STATUS', $this->GAMBAR_STATUS, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    protected function beforeSave() {
        parent::beforeSave();
        if($this->scenario == 'gambarbaru') {
        	$this->GAMBAR_NAMA = URL::Gambar($this->GAMBAR_LOKASI).$this->GAMBAR_NAMA;
        }
        
        return true;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Gambar the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function ListLokasi() {
        return array(
            self::URL_TOKO => URL::Gambar(self::URL_TOKO),
            self::URL_PELANGGAN => URL::Gambar(self::URL_PELANGGAN),
            self::URL_PRODUK => URL::Gambar(self::URL_PRODUK),
            self::URL_MAIL => URL::Gambar(self::URL_MAIL),
            self::URL_LAIN => URL::Gambar(self::URL_LAIN),
        );
    }
    
    public static function CekDuplikasi($string) {
    	$count = self::model()->countByAttributes(array('GAMBAR_NAMA' => $string));
    	return ($count > 0);
    }
    
    public static function GetGambarID($string) {
    	$model = self::model()->findByAttributes(array('GAMBAR_NAMA' => $string));
    	return $model === null ? 0 : $model->GAMBAR_ID;
    }

}
