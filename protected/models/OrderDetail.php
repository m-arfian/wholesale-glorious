<?php

/**
 * This is the model class for table "order_detail".
 *
 * The followings are the available columns in table 'order_detail':
 * @property integer $ORDER_DETAIL_ID
 * @property string $ORDER_ID
 * @property integer $HARGA_ID
 * @property integer $HARGA_BELI
 * @property integer $JUMLAH
 * F
 * The followings are the available model relations:
 * @property Order $oRDER
 * @property Harga $hARGA
 */
class OrderDetail extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order_detail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ORDER_ID, HARGA_ID, HARGA_BELI, JUMLAH', 'required'),
            array('HARGA_ID, HARGA_BELI, JUMLAH', 'numerical', 'integerOnly' => true),
            array('ORDER_ID', 'length', 'max' => 25),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ORDER_DETAIL_ID, ORDER_ID, HARGA_ID, HARGA_BELI, JUMLAH', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order' => array(self::BELONGS_TO, 'Order', 'ORDER_ID'),
            'harga' => array(self::BELONGS_TO, 'Harga', 'HARGA_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ORDER_DETAIL_ID' => 'Order Detail',
            'ORDER_ID' => 'Order',
            'HARGA_ID' => 'Harga',
            'HARGA_BELI' => 'Harga Beli',
            'JUMLAH' => 'Jumlah',
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

        $criteria->compare('ORDER_DETAIL_ID', $this->ORDER_DETAIL_ID);
        $criteria->compare('ORDER_ID', $this->ORDER_ID, true);
        $criteria->compare('HARGA_ID', $this->HARGA_ID);
        $criteria->compare('HARGA_BELI', $this->HARGA_BELI);
        $criteria->compare('JUMLAH', $this->JUMLAH);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function searchByOrder($orderid) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->condition = "ORDER_ID = '$orderid'";

        $criteria->compare('ORDER_DETAIL_ID', $this->ORDER_DETAIL_ID);
        $criteria->compare('ORDER_ID', $this->ORDER_ID, true);
        $criteria->compare('HARGA_ID', $this->HARGA_ID);
        $criteria->compare('HARGA_BELI', $this->HARGA_BELI);
        $criteria->compare('JUMLAH', $this->JUMLAH);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderDetail the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
