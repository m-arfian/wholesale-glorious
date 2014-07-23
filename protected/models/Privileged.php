<?php

/**
 * This is the model class for table "privileged".
 *
 * The followings are the available columns in table 'privileged':
 * @property integer $PRIVILEGED_ID
 * @property string $UNAME
 * @property string $PASS
 * @property integer $ROLE
 * @property string $CREATEDATE
 * @property string $LASTLOGIN
 * @property string $FULLNAME
 * @property integer $GAMBAR_ID
 * @property integer $PRIVILEGED_STATUS
 *
 * The followings are the available model relations:
 * @property Artikel[] $artikels
 * @property MGambar $gAMBAR
 */
class Privileged extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'privileged';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('UNAME, PASS, ROLE, CREATEDATE, LASTLOGIN, FULLNAME', 'required'),
            array('CREATEDATE, LASTLOGIN','default','value'=>new CDbExpression('DATE(:value)', array(':value'=>'Y-m-d H:i:s')),'setOnEmpty'=>false,'on'=>'adminbaru'),
            array('ROLE, GAMBAR_ID, PRIVILEGED_STATUS', 'numerical', 'integerOnly' => true),
            array('UNAME, PASS', 'length', 'max' => 45),
            array('FULLNAME', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('PRIVILEGED_ID, UNAME, PASS, ROLE, CREATEDATE, LASTLOGIN, FULLNAME, GAMBAR_ID, PRIVILEGED_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'artikel' => array(self::HAS_MANY, 'Artikel', 'PRIVILEGED_ID'),
            'gambar' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'PRIVILEGED_ID' => 'Privileged',
            'UNAME' => 'Username',
            'PASS' => 'Password',
            'ROLE' => 'Role',
            'CREATEDATE' => 'Createdate',
            'LASTLOGIN' => 'Lastlogin',
            'FULLNAME' => 'Fullname',
            'GAMBAR_ID' => 'Gambar',
            'PRIVILEGED_STATUS' => 'Privileged Status',
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

        $criteria->compare('PRIVILEGED_ID', $this->PRIVILEGED_ID);
        $criteria->compare('UNAME', $this->UNAME, true);
        $criteria->compare('PASS', $this->PASS, true);
        $criteria->compare('ROLE', $this->ROLE);
        $criteria->compare('CREATEDATE', $this->CREATEDATE, true);
        $criteria->compare('LASTLOGIN', $this->LASTLOGIN, true);
        $criteria->compare('FULLNAME', $this->FULLNAME, true);
        $criteria->compare('GAMBAR_ID', $this->GAMBAR_ID);
        $criteria->compare('PRIVILEGED_STATUS', $this->PRIVILEGED_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Privileged the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
