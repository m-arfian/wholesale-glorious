<?php

/**
 * This is the model class for table "subkategori".
 *
 * The followings are the available columns in table 'subkategori':
 * @property integer $SUBKATEGORI_ID
 * @property string $SUBKATEGORI_NAMA
 * @property integer $KATEGORI_ID
 * @property integer $SUBKATEGORI_STATUS
 *
 * The followings are the available model relations:
 * @property Barang[] $barangs
 * @property SubGambar[] $subGambars
 * @property MKategori $kATEGORI
 */
class Subkategori extends CActiveRecord {

    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Subkategori the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'subkategori';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SUBKATEGORI_NAMA, KATEGORI_ID', 'required'),
            array('KATEGORI_ID, GAMBAR_ID, SUBKATEGORI_STATUS', 'numerical', 'integerOnly'=>true),
            array('SUBKATEGORI_NAMA', 'length', 'max' => 45),
            array('SUBKATEGORI_LINK', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('SUBKATEGORI_ID, SUBKATEGORI_NAMA, KATEGORI_ID, GAMBAR_ID, SUBKATEGORI_LINK, SUBKATEGORI_STATUS', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'barang' => array(self::HAS_MANY, 'Barang', 'SUBKATEGORI_ID'),
            'kategori' => array(self::BELONGS_TO, 'Kategori', 'KATEGORI_ID'),
            'gambar' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'SUBKATEGORI_ID' => 'Subkategori',
            'SUBKATEGORI_NAMA' => 'Subkategori Nama',
            'KATEGORI_ID' => 'Kategori',
            'SUBKATEGORI_LINK' => 'Subkategori Link',
            'GAMBAR_ID' => 'Subkategori Gambar',
            'SUBKATEGORI_STATUS' => 'Subkategori Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('SUBKATEGORI_ID', $this->SUBKATEGORI_ID);
        $criteria->compare('SUBKATEGORI_NAMA', $this->SUBKATEGORI_NAMA, true);
        $criteria->compare('KATEGORI_ID', $this->KATEGORI_ID);
        $criteria->compare('SUBKATEGORI_LINK', $this->SUBKATEGORI_LINK);
        $criteria->compare('GAMBAR_ID', $this->GAMBAR_ID);
        $criteria->compare('SUBKATEGORI_STATUS', $this->SUBKATEGORI_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        parent::beforeSave();
        $this->SUBKATEGORI_LINK = Expr::isNoValue($this->SUBKATEGORI_LINK) ? strtolower(str_replace(' ', '-', $this->SUBKATEGORI_NAMA)) : $this->SUBKATEGORI_LINK;
        $this->GAMBAR_ID = Expr::isNoValue($this->GAMBAR_ID) ? Gambar::NO_IMAGE_MEDIUM : $this->GAMBAR_ID;

        return true;
    }

//    public static function GetAll() {
//        $criteria = new CDbCriteria();
//        $criteria->condition = 'SUBKATEGORI_STATUS=1';
//        
//        return $criteria;
//    }
//    
    public static function GetByKategori($kid) {
        $criteria = new CDbCriteria();
        $criteria->condition = 'SUBKATEGORI_STATUS=1 AND KATEGORI_ID=' . $kid;

        return $criteria;
    }

    public static function ListByKategori($kid) {
        if (!is_null($kid))
            return CHtml::listData(self::model()->findAllByAttributes(array('KATEGORI_ID' => $kid, 'SUBKATEGORI_STATUS' => self::AKTIF)), 'SUBKATEGORI_ID', 'SUBKATEGORI_NAMA');
        else
            return array();
    }

}
