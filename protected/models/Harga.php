<?php

/**
 * This is the model class for table "harga".
 *
 * The followings are the available columns in table 'harga':
 * @property integer $HARGA_ID
 * @property integer $HARGA_NORMAL
 * @property integer $HARGA_SALE
 * @property integer $BARANG_ID
 * @property integer $SATUAN_ID
 * @property integer $HARGA_PRIORITAS
 *
 * The followings are the available model relations:
 * @property Barang $bARANG
 * @property MSatuan $sATUAN
 * @property OrderDetail[] $orderDetails
 * @property OrderTemp[] $orderTemps
 */
class Harga extends CActiveRecord {

    const NO_PRIORITY = 0;
    const PRIORITY_1 = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'harga';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('HARGA_PRIORITAS', 'uniquecheck', 'on' => 'hargabaru'),
            array('HARGA_PRIORITAS, HARGA_NORMAL, BARANG_ID, SATUAN_ID', 'required', 'on' => 'hargabaru, editharga'),
            array('HARGA_PASAR, HARGA_NORMAL, HARGA_SALE, BARANG_ID, SATUAN_ID, HARGA_PRIORITAS', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('HARGA_ID, HARGA_NORMAL, HARGA_SALE, BARANG_ID, SATUAN_ID, HARGA_PRIORITAS', 'safe', 'on' => 'search'),
        );
    }

    public function uniquecheck($attribute, $params) {
        $attr = $this->{$attribute};
        $model = self::model()->countByAttributes(array("BARANG_ID" => $this->BARANG_ID, $attribute => $attr));
        $label = $this->attributeLabels();

        if ($model > 0)
            $this->addError($attribute, Message::_alert('price_duplicate', array($label[$attribute])));
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'barang' => array(self::BELONGS_TO, 'Barang', 'BARANG_ID'),
            'satuan' => array(self::BELONGS_TO, 'Satuan', 'SATUAN_ID'),
            'orderdetail' => array(self::HAS_MANY, 'OrderDetail', 'HARGA_ID'),
            'ordertemp' => array(self::HAS_MANY, 'OrderTemp', 'HARGA_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'HARGA_ID' => 'Harga',
            'HARGA_PASAR' => 'Harga Pasar',
            'HARGA_NORMAL' => 'Harga Normal',
            'HARGA_SALE' => 'Harga Sale',
            'BARANG_ID' => 'Barang',
            'SATUAN_ID' => 'Satuan',
            'HARGA_PRIORITAS' => 'Prioritas',
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

        $criteria->compare('HARGA_ID', $this->HARGA_ID);
        $criteria->compare('HARGA_NORMAL', $this->HARGA_NORMAL);
        $criteria->compare('HARGA_SALE', $this->HARGA_SALE);
        $criteria->compare('BARANG_ID', $this->BARANG_ID);
        $criteria->compare('SATUAN_ID', $this->SATUAN_ID);
        $criteria->compare('HARGA_PRIORITAS', $this->HARGA_PRIORITAS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByPrioritas() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'BARANG_ID asc HARGA_PRIORITAS asc';

        $criteria->compare('HARGA_ID', $this->HARGA_ID);
        $criteria->compare('HARGA_NORMAL', $this->HARGA_NORMAL);
        $criteria->compare('HARGA_SALE', $this->HARGA_SALE);
        $criteria->compare('BARANG_ID', $this->BARANG_ID);
        $criteria->compare('SATUAN_ID', $this->SATUAN_ID);
        $criteria->compare('HARGA_PRIORITAS', $this->HARGA_PRIORITAS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByBarang($brgid) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria();
        $criteria->condition = 'BARANG_ID=' . $brgid;
        $criteria->order = 'HARGA_PRIORITAS';

        //$criteria->compare('HARGA_ID', $this->HARGA_ID);
        $criteria->compare('HARGA_NORMAL', $this->HARGA_NORMAL);
        $criteria->compare('HARGA_SALE', $this->HARGA_SALE);
        $criteria->compare('SATUAN_ID', $this->SATUAN_ID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Harga the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function GetByBarang($brgid) {
        $criteria = new CDbCriteria();
        $criteria->alias = 'harga';
        $criteria->select = 'HARGA_NORMAL, HARGA_SALE';
        $criteria->condition = 'HARGA_PRIORITAS!=0 AND BARANG_ID=' . $brgid;
        $criteria->order = 'HARGA_PRIORITAS asc';
        $criteria->with = array('satuan');

        return $criteria;
    }

    public static function NormalOrSale($harga) {
        // untuk melakukan pengecekan apakah sebuah barang memiliki harga sale saat itu
//        if(is_numeric($harga))
        $obj = self::model()->findByAttributes(array('HARGA_ID' => $harga));
//        else if(is_array($harga))
//            $obj = self::model()->find("BARANG_ID=$harga[brg] AND SATUAN_ID=$harga[sat]");

        return empty($obj->HARGA_SALE) ? $obj->HARGA_NORMAL : $obj->HARGA_SALE;
    }

    public static function PilihanHarga($hargaid) {
        // untuk mengirimkan data harga dari tabel harga
        $harga = self::model()->findByPk($hargaid);
        return CJSON::encode(array('normal' => $harga->HARGA_NORMAL, 'sale' => $harga->HARGA_SALE));
    }

    public static function ListByBarang($brgid) {
        // untuk menyimpan harga ID ke dalam array berdasarkan barang ID
        $arr = array();
        foreach (self::model()->findAll(self::GetByBarang($brgid)) as $harga) {
            array_push($arr, $harga->HARGA_ID);
        }
        return $arr;
    }

    public static function GetLowestPrior($brgid) {
        //untuk menemukan angka prioritas terbesar (lebih besar angka, lebih kecil prioritas) dari barang
        $sql = "select max(HARGA_PRIORITAS) as max from harga where BARANG_ID=$brgid";
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryRow();

        return $row['max'];
    }

    public static function GetRowCount() {
        $sql = 'select count(HARGA_ID) from harga where HARGA_PRIORITAS != ' . self::NO_PRIORITY;
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryScalar();

        return $row;
    }

}
