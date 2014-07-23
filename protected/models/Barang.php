<?php

/**
 * This is the model class for table "barang".
 *
 * The followings are the available columns in table 'barang':
 * @property integer $BARANG_ID
 * @property string $BARANG_NAMA
 * @property integer $SUBKATEGORI_ID
 * @property integer $CUSTOMABLE
 * @property integer $STOK_STATUS_ID
 * @property string $BARANG_SPEK
 * @property string $BARANG_DESKRIPSI
 * @property integer $BARANG_STATUS
 *
 * The followings are the available model relations:
 * @property Subkategori $sUBKATEGORI
 * @property StokStatus $sTOKSTATUS
 * @property Harga[] $hargas
 * @property OrderDetail[] $orderDetails
 * @property TagDetail[] $tagDetails
 */
class Barang extends CActiveRecord {
    
    const CUSTOMABLE = 1;
    const NOT_CUSTOMABLE = 0;
    
    const TIPE_PER = 1;
    const TIPE_PAKET = 2;
    
    const THUMB = 1;
    const NO_THUMB = 0;
    
    const AKTIF = 1;
    const NONAKTIF = 0;
    
    const MAX_FOTO = 5;
    
    public $FOTO, $TAG;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Barang the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'barang';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('BARANG_NAMA, SUBKATEGORI_ID, KATEGORI_ID, CUSTOMABLE, STOK_STATUS_ID, BARANG_STATUS', 'required', 'on'=>'barangbaru, editbarang'),
            array('FOTO', 'required', 'on'=>'editfoto'),
            array('SUBKATEGORI_ID, KATEGORI_ID, BGRUP_ID, CUSTOMABLE, STOK_STATUS_ID, BARANG_TIPE, THUMBNAILED, BARANG_STATUS', 'numerical', 'integerOnly'=>true),
            array('BARANG_BOBOT', 'numerical'),
            array('BARANG_NAMA', 'length', 'max' => 45),
            array('BARANG_LINK', 'length', 'max'=>255),
            array('BARANG_SPEK, BARANG_DESKRIPSI, TAG, BARANG_ALIAS', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('BARANG_ID, BARANG_NAMA, BARANG_ALIAS, SUBKATEGORI_ID, KATEGORI_ID, BGRUP_ID, CUSTOMABLE, STOK_STATUS_ID, BARANG_SPEK, BARANG_DESKRIPSI, BARANG_BOBOT, BARANG_TIPE, BARANG_LINK, THUMBNAILED, BARANG_STATUS', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bgrup' => array(self::BELONGS_TO, 'Barang', 'BGRUP_ID'),
            'barang' => array(self::HAS_MANY, 'Barang', 'BGRUP_ID'),
            'subkategori' => array(self::BELONGS_TO, 'Subkategori', 'SUBKATEGORI_ID'),
            'kategori' => array(self::BELONGS_TO, 'Kategori', 'KATEGORI_ID'),
            'subgambar' => array(self::HAS_MANY, 'SubGambar', 'BARANG_ID'),
            'stokstatus' => array(self::BELONGS_TO, 'StokStatus', 'STOK_STATUS_ID'),
            'harga' => array(self::HAS_MANY, 'Harga', 'BARANG_ID'),
            'orderdetail' => array(self::HAS_MANY, 'OrderDetail', 'BARANG_ID'),
            'barangtag' => array(self::HAS_MANY, 'BarangTag', 'BARANG_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'BARANG_ID' => 'Barang ID',
            'BARANG_NAMA' => 'Nama Barang',
            'BARANG_ALIAS' => 'Barang Alias',
            'KATEGORI_ID' => 'Kategori',
            'SUBKATEGORI_ID' => 'Subkategori',
            'BGRUP_ID' => 'Barang Grup',
            'CUSTOMABLE' => 'Pesan Kustom',
            'STOK_STATUS_ID' => 'Stok Status',
            'BARANG_SPEK' => 'Barang Spesifikasi',
            'BARANG_DESKRIPSI' => 'Barang Deskripsi',
            'BARANG_BOBOT' => 'Bobot Barang',
            'BARANG_TIPE' => 'Tipe Barang',
            'BARANG_LINK' => 'Link Barang',
            'THUMBNAILED' => 'Ditampilkan berupa thumbnail',
            'BARANG_STATUS' => 'Status Barang',
            'FOTO' => 'Foto Barang',
            'TAG' => 'Tag Barang',
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
        $criteria->order = 'BARANG_ID desc';

        $criteria->compare('BARANG_ID', $this->BARANG_ID);
        $criteria->compare('BARANG_NAMA', $this->BARANG_NAMA, true);
        $criteria->compare('BARANG_ALIAS',$this->BARANG_ALIAS,true);
        $criteria->compare('SUBKATEGORI_ID', $this->SUBKATEGORI_ID);
        $criteria->compare('KATEGORI_ID', $this->KATEGORI_ID);
        $criteria->compare('BGRUP_ID',$this->BGRUP_ID);
        $criteria->compare('CUSTOMABLE', $this->CUSTOMABLE);
        $criteria->compare('STOK_STATUS_ID', $this->STOK_STATUS_ID);
        $criteria->compare('BARANG_SPEK', $this->BARANG_SPEK, true);
        $criteria->compare('BARANG_DESKRIPSI', $this->BARANG_DESKRIPSI, true);
        $criteria->compare('BARANG_BOBOT',$this->BARANG_BOBOT);
        $criteria->compare('BARANG_TIPE',$this->BARANG_TIPE);
        $criteria->compare('BARANG_LINK',$this->BARANG_LINK,true);
        $criteria->compare('THUMBNAILED',$this->THUMBNAILED);
        $criteria->compare('BARANG_STATUS', $this->BARANG_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    protected function beforeSave() {
        parent::beforeSave();
        if(in_array($this->scenario, array('barangbaru', 'editbarang'))) {
            $this->BARANG_SPEK = MyFormatter::formatToJSON($this->BARANG_SPEK);
            $this->BARANG_LINK = Expr::isNoValue($this->BARANG_LINK) ? strtolower(str_replace(' ', '-', $this->BARANG_NAMA)) : $this->BARANG_LINK;
            $this->BGRUP_ID = Expr::isNoValue($this->BGRUP_ID) ? $this->BARANG_ID : $this->BGRUP_ID;
        }
        
        return true;
    }
    
//    public function afterSave() {
//        parent::afterSave();
//        if(empty($this->BGRUP_ID)) {
//            self::model()->findByPk($this->BARANG_ID)->saveAttributes(array('BGRUP_ID' => $this->BARANG_ID));
//        }
//        
//        return true;
//    }

//    protected function afterFind() {
//        parent::afterFind();
//        if(!$this->isNewRecord && in_array($this->scenario, array('update', 'editbarang'))) {
//            $this->BARANG_SPEK = MyFormatter::formatFromJson($this->BARANG_SPEK);
//        }
//    }

    public static function CompleteRowSingleQuery($id) {
        // digunakan untuk menampilkan detail barang
        $criteria = new CDbCriteria();
        $criteria->alias = 'barang';
        $criteria->with = array(
            'harga' => array(
                'joinType' => 'inner join',
                'select' => 'HARGA_NORMAL, HARGA_SALE',
                'condition' => 'HARGA_PRIORITAS = 1', // harga default tiap barang
                'order' => 'HARGA_PRIORITAS asc',
            ),
            'harga.satuan' => array(
                'joinType' => 'inner join',
                'select' => 'SATUAN_NAMA',
                'condition' => 'SATUAN_STATUS = 1',
            ),
        );
        $criteria->order = 'barang.BARANG_ID asc';
        $criteria->condition = 'barang.BARANG_ID=:id AND BARANG_STATUS=:status';
        $criteria->params = array(':id' => $id, ':status' => self::AKTIF);
        $criteria->limit = 1;
        $criteria->together = true;

        return $criteria;
    }

    public static function DistinctRowMultiQuery($limit = -1) {
        // digunakan untuk menampilkan thumbnail barang-barang, terutama di halaman depan
        // yang ditampilkan = nama, harga + satuan default, gambar
        $criteria = new CDbCriteria();
        $criteria->alias = 'barang';
        $criteria->select = 'BARANG_NAMA';
        $criteria->with = array(
            'harga' => array(
                'joinType' => 'inner join',
                'select' => 'HARGA_NORMAL, HARGA_SALE',
                'condition' => 'HARGA_PRIORITAS = 1', // harga default tiap barang
                'order' => 'HARGA_PRIORITAS asc',
            ),
            'harga.satuan' => array(
                'joinType' => 'inner join',
                'select' => 'SATUAN_NAMA',
                'condition' => 'SATUAN_STATUS = 1',
            ),
//            'subgambar' => array(
//                'joinType' => 'inner join',
//                'select' => 'GAMBAR_SMALL',
//            ),
//            'subgambar.gambarsmall' => array(
//                'joinType' => 'inner join',
//                'condition' => 'GAMBAR_STATUS = 1',
//            ),
        );
        $criteria->order = 'barang.BARANG_ID desc';
        $criteria->condition = 'THUMBNAILED=:thumb AND BARANG_STATUS=:status';
        $criteria->params = array(':thumb' => self::THUMB, ':status' => self::AKTIF);
        $criteria->limit = $limit;
        $criteria->together = true;

        return $criteria;

        /*
         * SELECT barang_nama, barang_deskripsi, harga_normal, harga_sale, satuan_nama
         * FROM barang
         * INNER JOIN harga ON barang.barang_id = harga.barang_id
         * INNER JOIN m_satuan ON m_satuan.satuan_id = harga.satuan_id
         * WHERE barang_status = 1
         * AND harga_prioritas = 1
         * AND satuan_status =1
         * ORDER BY barang.barang_id, harga_prioritas
         */
    }
    
    public static function ListBySubkategori($subid) {
        if(!is_null($subid))
            return CHtml::listData(self::model()->findAllByAttributes(array('SUBKATEGORI_ID'=>$subid, 'BARANG_STATUS'=>self::AKTIF)), 'BARANG_ID', 'BARANG_NAMA');
        else
            return array();
    }
    
    public static function ListAll() {
        $criteria = new CDbCriteria(array(
            'select' => 'BARANG_ID, BARANG_NAMA',
            'order' => 'BARANG_NAMA asc',
            'condition' => 'BARANG_STATUS = '.self::AKTIF,
        ));
        return CHtml::listData(self::model()->findAll($criteria), 'BARANG_ID', 'BARANG_NAMA');
    }
    
    public static function ListRandom($count = 8) {
        // mendapatkan barang secara random
        $barang = array();
        while ($count > 0) {
            $random = rand(self::GetRowMax(), self::GetRowMax());
            $model = Barang::model()->findByAttributes(array('BARANG_ID'=>$random, 'BARANG_STATUS'=>self::AKTIF));
            if($model !== null) {
                array_push($barang, $model);
                $count--;
            }
        }
        
        return $barang;
    }
    
    public static function ListGrup() {
        $kategori = Kategori::model()->findAllByAttributes(array('KATEGORI_STATUS' => Kategori::AKTIF));
        $list = array();
        foreach($kategori as $kat) {
            $sublist = array();
            foreach ($kat->baranggrup as $barang) {
                $sublist[$barang->BARANG_ID] = $barang->BARANG_NAMA;
            }
            
            $list[$kat->KATEGORI_NAMA] = $sublist;
        }
        
        return $list;
    }
    
    public static function ListGrupee($bgrupid) {
        $criteria = new CDbCriteria(array(
            'select' => 'BARANG_LINK, BARANG_ALIAS',
            'condition' => 'BGRUP_ID=:bgrup AND BARANG_STATUS=:status',
            'params' => array(':bgrup' => $bgrupid, ':status' => self::AKTIF),
            'order' => 'BARANG_ALIAS asc'
        ));
        return CHtml::listData(self::model()->findAll($criteria), 'BARANG_LINK', 'BARANG_ALIAS');
    }
    
    public static function ListFotoBarang($barang /*model*/) {
        $listgambar = array();
        foreach ($barang->subgambar as $subgambar){
            array_push($listgambar, array(
                Gambar::LARGE => $subgambar->gambarlarge->GAMBAR_ID,
                Gambar::MEDIUM => $subgambar->gambarmedium->GAMBAR_ID,
                Gambar::SMALL => $subgambar->gambarsmall->GAMBAR_ID,
                Gambar::ICON => $subgambar->gambaricon->GAMBAR_ID,
            ));
        }
        
        return $listgambar;
    }
    
    public static function ListTagBarang($barang /*model*/) {
        $listtag = array();
        foreach ($barang->barangtag as $tag) {
            array_push($listtag, $tag->tag->TAG_ID);
        }
        
        return $listtag;
    }
    
    public static function GetRowMax() {
        $sql = 'select max(BARANG_ID) from barang where BARANG_STATUS = '.self::AKTIF;
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryScalar();
        
        return $row;
    }
    
    public static function GetRowMin() {
        $sql = 'select min(BARANG_ID) from barang where BARANG_STATUS = '.self::AKTIF;
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryScalar();
        
        return $row;
    }
    
}