<?php

/**
 * This is the model class for table "sub_gambar".
 *
 * The followings are the available columns in table 'sub_gambar':
 * @property integer $SUB_GAMBAR_ID
 * @property integer $GAMBAR_LARGE
 * @property integer $GAMBAR_MEDIUM
 * @property integer $GAMBAR_SMALL
 * @property integer $GAMBAR_ICON
 * @property integer $BARANG_ID
 *
 * The followings are the available model relations:
 * @property Barang $bARANG
 * @property MGambar $gAMBARLARGE
 */
class SubGambar extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sub_gambar';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('GAMBAR_LARGE, GAMBAR_MEDIUM, GAMBAR_SMALL, GAMBAR_ICON, BARANG_ID', 'required', 'on'=>'barangbaru'),
            array('GAMBAR_LARGE, GAMBAR_MEDIUM, GAMBAR_SMALL, GAMBAR_ICON', 'required', 'on'=>'editfoto'),
            array('GAMBAR_LARGE, GAMBAR_MEDIUM, GAMBAR_SMALL, GAMBAR_ICON, BARANG_ID', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('SUB_GAMBAR_ID, GAMBAR_LARGE, GAMBAR_MEDIUM, GAMBAR_SMALL, GAMBAR_ICON, BARANG_ID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'barang' => array(self::BELONGS_TO, 'Barang', 'BARANG_ID'),
            'gambarlarge' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_LARGE'),
            'gambarmedium' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_MEDIUM'),
            'gambarsmall' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_SMALL'),
            'gambaricon' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_ICON'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'SUB_GAMBAR_ID' => 'Sub Gambar',
            'GAMBAR_LARGE' => 'Gambar Large',
            'GAMBAR_MEDIUM' => 'Gambar Medium',
            'GAMBAR_SMALL' => 'Gambar Small',
            'GAMBAR_ICON' => 'Gambar Icon',
            'BARANG_ID' => 'Barang ID',
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

        $criteria->compare('SUB_GAMBAR_ID', $this->SUB_GAMBAR_ID);
        $criteria->compare('GAMBAR_LARGE', $this->GAMBAR_LARGE);
        $criteria->compare('GAMBAR_MEDIUM', $this->GAMBAR_MEDIUM);
        $criteria->compare('GAMBAR_SMALL', $this->GAMBAR_SMALL);
        $criteria->compare('GAMBAR_ICON', $this->GAMBAR_ICON);
        $criteria->compare('BARANG_ID', $this->BARANG_ID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SubGambar the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
