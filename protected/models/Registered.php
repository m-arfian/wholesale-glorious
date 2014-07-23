<?php

/**
 * This is the model class for table "registered".
 *
 * The followings are the available columns in table 'registered':
 * @property integer $REGISTERED_ID
 * @property integer $PELANGGAN_ID
 * @property string $USERNAME
 * @property string $PASS
 * @property integer $GAMBAR_ID
 * @property string $MEMBER_SINCE
 * @property string $LAST_LOGIN
 * @property integer $STATUS
 *
 * The followings are the available model relations:
 * @property MGambar $gAMBAR
 * @property Pelanggan $pELANGGAN
 */
class Registered extends CActiveRecord {

    public $REPEATPASS, $OLDPASS;
    public $CAPTCHA;

    const AKTIF = 1;
    const NONAKTIF = 0;
    
    const ACCOUNT_MINLENGTH = 5;
    const ACCOUNT_MAXLENGTH = 64;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'registered';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('PELANGGAN_ID, USERNAME, PASS, MEMBER_SINCE, LAST_LOGIN', 'required'),
            array('USERNAME', 'userUnique', 'on' => 'akunbaru'),
            array('USERNAME, PASS, REPEATPASS, MEMBER_SINCE, CAPTCHA', 'required', 'on' => 'akunbaru', 'message' => '{attribute} wajib diisi'),
            array('PASS, OLDPASS, REPEATPASS', 'required', 'on' => 'editpass', 'message' => '{attribute} wajib diisi'),
            array('CAPTCHA', 'CaptchaExtendedValidator', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'akunbaru'),
            array('OLDPASS', 'comparePass', 'on' => 'editpass'),
            array('REPEATPASS', 'compare', 'compareAttribute' => 'PASS', 'message' => "Password tidak cocok."),
            array('PELANGGAN_ID, GAMBAR_ID', 'numerical', 'integerOnly' => true),
            array('USERNAME, PASS', 'length', 'max' => self::ACCOUNT_MAXLENGTH, 'min' => self::ACCOUNT_MINLENGTH, 'tooLong' => 
            	'Panjang karakter {attribute} maksimal '.self::ACCOUNT_MAXLENGTH.' karakter', 'tooShort' => 'Panjang karakter {attribute} minimal '.self::ACCOUNT_MINLENGTH.' karakter'),
           	// array('USERNAME', 'match', 'pattern'=>'\s+', 'not' => false, 'message'=>'{attribute} tidak boleh menggunakan spasi.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('REGISTERED_ID, PELANGGAN_ID, USERNAME, PASS, GAMBAR_ID, MEMBER_SINCE, LAST_LOGIN, STATUS', 'safe', 'on' => 'search'),
        );
    }

    public function userUnique($attribute, $params) {
        $username = $this->{$attribute};
        $model = self::model()->countByAttributes(array("USERNAME" => $username));
        
        if($model>0)
            $this->addError ('USERNAME', Message::_alert('username_exist'));
    }
    
    public function comparePass($attribute, $params) {
        $model = self::model()->findByPk($this->REGISTERED_ID);
        $currentpass = $model->PASS;
        $oldpass = md5($this->{$attribute});

        if($currentpass != $oldpass)
            $this->addError ('OLDPASS', 'Password tidak cocok dengan password saat ini.');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'gambar' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_ID'),
            'pelanggan' => array(self::BELONGS_TO, 'Pelanggan', 'PELANGGAN_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        if($this->scenario == 'editpass')
            return array(
                'OLDPASS' => 'Password lama',
                'PASS' => 'Password baru',
                'REPEATPASS' => 'Ulangi Password',
            );
        else
            return array(
                'REGISTERED_ID' => 'Akun ID',
                'PELANGGAN_ID' => 'Pelanggan',
                'USERNAME' => 'Username',
                'PASS' => 'Password',
                'REPEATPASS' => 'Ulangi Password',
                'GAMBAR_ID' => 'Gambar',
                'MEMBER_SINCE' => 'Terdaftar sejak',
                'LAST_LOGIN' => 'Last Login',
                'STATUS' => 'Status',
                'CAPTCHA' => 'Kode Verifikasi',
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

        $criteria->compare('REGISTERED_ID', $this->REGISTERED_ID);
        $criteria->compare('PELANGGAN_ID', $this->PELANGGAN_ID);
        $criteria->compare('USERNAME', $this->USERNAME, true);
        $criteria->compare('PASS', $this->PASS, true);
        $criteria->compare('GAMBAR_ID', $this->GAMBAR_ID);
        $criteria->compare('MEMBER_SINCE', $this->MEMBER_SINCE, true);
        $criteria->compare('LAST_LOGIN', $this->LAST_LOGIN, true);
        $criteria->compare('STATUS', $this->STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Registered the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
//    protected function afterValidate() {
//        parent::afterValidate();
//        if ($this->scenario == 'editpass')
//            $this->PASS = md5($this->PASS);
//
//        return true;
//    }
    
    protected function beforeValidate() {
        parent::beforeValidate();
        if($this->scenario == 'akunbaru') {
            $this->STATUS = self::NONAKTIF;
            $this->MEMBER_SINCE = date("Y-m-d H:i:s");
        }
        
        return true;
    }


    protected function beforeSave() {
        parent::beforeSave();
        if ($this->scenario == 'editpass')
            $this->PASS = md5($this->PASS);
        else if ($this->scenario == 'akunbaru')
            $this->PASS = md5($this->PASS);

        return true;
    }

    public static function CekUsername() {
        // untuk mendapatkan akun pelanggan berdasarkan username (via ajax)
        $user = self::model()->countByAttributes(array("USERNAME" => $_POST['username']));
        return $user;
    }

}
