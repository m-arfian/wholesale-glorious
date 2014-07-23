<?php

/**
 * This is the model class for table "pelanggan".
 *
 * The followings are the available columns in table 'pelanggan':
 * @property integer $PELANGGAN_ID
 * @property string $NAMA
 * @property string $PASS
 * @property string $EMAIL
 * @property string $HP
 * @property string $KELAMIN
 * @property integer $PELANGGAN_STATUS
 *
 * The followings are the available model relations:
 * @property AlamatPengiriman[] $alamatPengirimen
 * @property Order[] $orders
 */
class Pelanggan extends CActiveRecord {

    const PUNYA_AKUN = 1;
    const NO_AKUN = 9;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pelanggan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NAMA, EMAIL, KELAMIN, PELANGGAN_STATUS', 'required', 'on' => 'orderbaru, editprofil, akunbaru', 'message' => '{attribute} wajib diisi.'),
            array('PELANGGAN_STATUS', 'numerical', 'integerOnly' => true),
            array('NAMA', 'length', 'max' => 100),
            array('EMAIL', 'length', 'max' => 50),
            array('EMAIL', 'emailUnique', 'on' => 'akunbaru'),
            array('HP', 'length', 'max' => 20),
            array('KELAMIN', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('PELANGGAN_ID, NAMA, EMAIL, HP, KELAMIN, PELANGGAN_STATUS', 'safe', 'on' => 'search'),
        );
    }
    
    public function emailUnique($attribute, $params) {
        $email = $this->{$attribute};
        $model = self::model()->countByAttributes(array("EMAIL" => $email, 'PELANGGAN_STATUS' => self::PUNYA_AKUN));
        
        if($model>0)
            $this->addError ('EMAIL', Message::_alert('email_exist'));
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'alamatpengiriman' => array(self::HAS_MANY, 'AlamatPengiriman', 'PELANGGAN_ID'),
            'registered' => array(self::HAS_ONE, 'Registered', 'PELANGGAN_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'PELANGGAN_ID' => 'Pelanggan ID',
            'NAMA' => 'Nama Lengkap',
            'EMAIL' => 'Email',
            'HP' => 'Nomor HP',
            'KELAMIN' => 'Jenis Kelamin',
            'PELANGGAN_STATUS' => 'Pelanggan Status',
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

        $criteria->compare('PELANGGAN_ID', $this->PELANGGAN_ID);
        $criteria->compare('NAMA', $this->NAMA, true);
        $criteria->compare('EMAIL', $this->EMAIL, true);
        $criteria->compare('HP', $this->HP, true);
        $criteria->compare('KELAMIN', $this->KELAMIN, true);
        $criteria->compare('PELANGGAN_STATUS', $this->PELANGGAN_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pelanggan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    protected function beforeValidate() {
        parent::beforeValidate();
        if($this->scenario == 'akunbaru') {
            $this->PELANGGAN_STATUS = self::PUNYA_AKUN;
        }
        
        return true;
    }

    public static function CekPelanggan() {		/*deprecated*/
        // untuk mendapatkan jumlah pelanggan yang memiliki akun berdasarkan email (via ajax)
        return self::model()->countByAttributes(array('EMAIL' => $_POST['email'], 'PELANGGAN_STATUS' => self::PUNYA_AKUN));
    }

    public static function GetPelangganByAlamat($alamatid) {
        return AlamatPengiriman::model()->findByPk($alamatid)->PELANGGAN_ID;
    }
    
    public static function CekAkunByEmail() {
    	// untuk mendapatkan akun pelanggan berdasarkan username (via ajax)
    	$mail = self::model()->countByAttributes(array("EMAIL" => $_POST['email'], "PELANGGAN_STATUS" => self::PUNYA_AKUN));
        return $mail;
    }

}
