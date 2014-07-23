<?php

/**
 * This is the model class for table "m_order_status".
 *
 * The followings are the available columns in table 'm_order_status':
 * @property integer $ORDER_STATUS_ID
 * @property string $ORDER_STATUS_NAMA
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 */
class OrderStatus extends CActiveRecord {
    
    const BATAL = 1;
    const PENDING = 2;
    const MENUNGGU = 3;
    const PERSIAPAN = 4;
    const TERKIRIM = 5;
    const DITERIMA = 6;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_order_status';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ORDER_STATUS_NAMA', 'required'),
            array('ORDER_STATUS_NAMA', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ORDER_STATUS_ID, ORDER_STATUS_NAMA', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order' => array(self::HAS_MANY, 'Order', 'ORDER_STATUS_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ORDER_STATUS_ID' => 'Order Status ID',
            'ORDER_STATUS_NAMA' => 'Order Status Nama',
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

        $criteria->compare('ORDER_STATUS_ID', $this->ORDER_STATUS_ID);
        $criteria->compare('ORDER_STATUS_NAMA', $this->ORDER_STATUS_NAMA, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderStatus the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function ListAll() {
        return CHtml::listData(self::model()->findAll(), 'ORDER_STATUS_ID', 'ORDER_STATUS_NAMA');
    }

}
