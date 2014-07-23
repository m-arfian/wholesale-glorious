<?php

/**
 * This is the model class for table "m_kategori".
 *
 * The followings are the available columns in table 'm_kategori':
 * @property integer $KATEGORI_ID
 * @property string $KATEGORI_NAMA
 * @property integer $GAMBAR_ID
 * @property integer $KATEGORI_STATUS
 *
 * The followings are the available model relations:
 * @property MGambar $gAMBAR
 * @property Subkategori[] $subkategoris
 */
class Kategori extends CActiveRecord {

    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Kategori the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_kategori';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('KATEGORI_NAMA', 'required'),
            array('GAMBAR_ID, KATEGORI_STATUS', 'numerical', 'integerOnly' => true),
            array('KATEGORI_NAMA', 'length', 'max' => 45),
            array('KATEGORI_LINK', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('KATEGORI_ID, KATEGORI_NAMA, GAMBAR_ID, KATEGORI_LINK, KATEGORI_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'gambar' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_ID'),
            'subkategori' => array(self::HAS_MANY, 'Subkategori', 'KATEGORI_ID'),
            'barang' => array(self::HAS_MANY, 'Barang', 'KATEGORI_ID'),
            'baranggrup' => array(self::HAS_MANY, 'Barang', 'KATEGORI_ID', 'on' => 'baranggrup.BGRUP_ID = baranggrup.BARANG_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'KATEGORI_ID' => 'Kategori',
            'KATEGORI_NAMA' => 'Kategori Nama',
            'GAMBAR_ID' => 'Kategori Gambar',
            'KATEGORI_LINK' => 'Kategori Link',
            'KATEGORI_STATUS' => 'Kategori Status',
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

        $criteria->compare('KATEGORI_ID', $this->KATEGORI_ID);
        $criteria->compare('KATEGORI_NAMA', $this->KATEGORI_NAMA, true);
        $criteria->compare('GAMBAR_ID', $this->GAMBAR_ID);
        $criteria->compare('KATEGORI_LINK', $this->KATEGORI_LINK, true);
        $criteria->compare('KATEGORI_STATUS', $this->KATEGORI_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    protected function beforeSave() {
        parent::beforeSave();
        $this->KATEGORI_LINK = Expr::isNoValue($this->KATEGORI_LINK) ? Expr::linkForward($this->KATEGORI_ID, Expr::LINK_KATEGORI) : $this->KATEGORI_LINK;
        $this->GAMBAR_ID = Expr::isNoValue($this->GAMBAR_ID) ? Gambar::NO_IMAGE_MEDIUM : $this->GAMBAR_ID;

        return true;
    }
    
    public static function ModelAll() {
        return Kategori::model()->findAll(Kategori::GetAll());
    }
    
    public static function GetAll() {
        $criteria = new CDbCriteria();
        $criteria->condition = 'KATEGORI_STATUS=1';
        
        return $criteria;
    }
    
    public static function ListAll() {
        return CHtml::listData(self::model()->findAllByAttributes(array('KATEGORI_STATUS'=>self::AKTIF)), 'KATEGORI_ID', 'KATEGORI_NAMA');
    }

}