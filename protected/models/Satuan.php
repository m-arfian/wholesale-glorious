<?php

/**
 * This is the model class for table "m_satuan".
 *
 * The followings are the available columns in table 'm_satuan':
 * @property integer $SATUAN_ID
 * @property string $SATUAN_NAMA
 * @property integer $SATUAN_STATUS
 *
 * The followings are the available model relations:
 * @property Harga[] $hargas
 * @property OrderDetail[] $orderDetails
 */
class Satuan extends CActiveRecord {

    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Satuan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_satuan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SATUAN_NAMA', 'required'),
            array('SATUAN_STATUS', 'numerical', 'integerOnly' => true),
            array('SATUAN_NAMA', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('SATUAN_ID, SATUAN_NAMA, SATUAN_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'harga' => array(self::HAS_MANY, 'Harga', 'SATUAN_ID'),
            'orderdetail' => array(self::HAS_MANY, 'OrderDetail', 'SATUAN_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'SATUAN_ID' => 'Satuan',
            'SATUAN_NAMA' => 'Nama Satuan',
            'SATUAN_STATUS' => 'Satuan Status',
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

        $criteria->compare('SATUAN_ID', $this->SATUAN_ID);
        $criteria->compare('SATUAN_NAMA', $this->SATUAN_NAMA, true);
        $criteria->compare('SATUAN_STATUS', $this->SATUAN_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public static function GetByBarang($brgid) {
        $criteria = new CDbCriteria();
        $criteria->alias = 'satuan';
        $criteria->select = 'SATUAN_NAMA';
        $criteria->condition = 'SATUAN_STATUS=1';
        $criteria->with = array('harga' => array(
            'joinType' => 'inner join',
            'condition' => 'HARGA_PRIORITAS!=0 and BARANG_ID='.$brgid,
            'order' => 'HARGA_PRIORITAS asc'
        ));
        
        return $criteria;
    }
    
    public static function ListByBarang($brgid) {
        // mendapatkan daftar satuan (array) dari barang_id
        return CHtml::listData(Satuan::model()->findAll(Satuan::GetByBarang($brgid)), 'SATUAN_ID', 'SATUAN_NAMA');
    }
    
    public static function ListYetBarang($brgid = 0) {
        // mendapatkan daftar satuan (array) yang TIDAK dipunyai oleh barang
        if(empty($brgid))
            return self::ListAll();
        
        $sql = "select SATUAN_ID from harga inner join barang on barang.BARANG_ID = harga.BARANG_ID where barang.BARANG_ID = $brgid";
        $command = Yii::app()->db->createCommand($sql);
        $col=$command->queryColumn();
        
        $criteria = new CDbCriteria();
        $criteria->select = 'SATUAN_ID, SATUAN_NAMA';
        $criteria->condition = 'SATUAN_STATUS=1';
        $criteria->addNotInCondition('SATUAN_ID', $col);
        
        return CHtml::listData(self::model()->findAll($criteria), 'SATUAN_ID', 'SATUAN_NAMA');
    }
    
    public static function ListOne($satid) {
    	// mendapatkan 1 daftar list berdasarkan satuan id
    	return CHtml::listData(Satuan::model()->findAllByAttributes(array('SATUAN_ID' => $satid)), 'SATUAN_ID', 'SATUAN_NAMA');
    }
    
    public static function ListAll() {
        // mendapatkan daftar satuan (array)
        return CHtml::listData(self::model()->findAllByAttributes(array('SATUAN_STATUS'=>1)), 'SATUAN_ID', 'SATUAN_NAMA');
    }

}