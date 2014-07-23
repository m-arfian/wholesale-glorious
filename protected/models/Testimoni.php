<?php

/**
 * This is the model class for table "testimoni".
 *
 * The followings are the available columns in table 'testimoni':
 * @property integer $TESTIMONI_ID
 * @property string $TESTIMONI_NAMA
 * @property string $ORDER_ID
 * @property string $TESTIMONI
 * @property date $TESTIMONI_DATE
 *
 * The followings are the available model relations:
 * @property Order $oRDER
 */
class Testimoni extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'testimoni';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('TESTIMONI_NAMA, TESTIMONI', 'required', 'on' => 'testimonibaru', 'message' => '<i class="fa fa-ban"></i> {attribute} wajib diisi'),
            array('TESTIMONI_NAMA', 'length', 'max'=>50),
            array('ORDER_ID', 'length', 'max' => 25),
            array('ORDER_ID', 'validasi'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('TESTIMONI_ID, TESTIMONI_DATE, TESTIMONI_NAMA, ORDER_ID, TESTIMONI', 'safe', 'on' => 'search'),
        );
    }
    
    public function validasi($attribute, $params) {
    	if(isset($this->{$attribute}) && !empty($this->{$attribute})) {
	        $row = Order::model()->countByAttributes(array('ORDER_ID' => $this->{$attribute}));
	        if($row < 1)
	            $this->addError ('ORDER_ID', '<i class="fa fa-exclamation"></i> Order ID invalid! (Kosongi apabila lupa/hilang)');
    	}
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order' => array(self::BELONGS_TO, 'Order', 'ORDER_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'TESTIMONI_ID' => 'Testimoni ID',
            'TESTIMONI_DATE' => 'Tanggal Testimoni',
            'TESTIMONI_NAMA' => 'Nama Testimonial',
            'ORDER_ID' => 'Order ID',
            'TESTIMONI' => 'Testimoni',
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
        $criteria->order = 'TESTIMONI_ID desc';

        $criteria->compare('TESTIMONI_ID', $this->TESTIMONI_ID);
        $criteria->compare('TESTIMONI_DATE', Expr::systemDate($this->TESTIMONI_DATE),true);
        $criteria->compare('TESTIMONI_NAMA',$this->TESTIMONI_NAMA,true);
        $criteria->compare('ORDER_ID', $this->ORDER_ID, true);
        $criteria->compare('TESTIMONI', $this->TESTIMONI, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Testimoni the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            $this->ORDER_ID = str_replace('-', '', $this->ORDER_ID);
            $this->TESTIMONI_DATE = date("Y-m-d H:i:s");
            
            return true;
        }
        else
            return false;
    }

}
