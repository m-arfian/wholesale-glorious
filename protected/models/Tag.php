<?php

/**
 * This is the model class for table "m_tag".
 *
 * The followings are the available columns in table 'm_tag':
 * @property integer $TAG_ID
 * @property string $TAG_NAMA
 * @property integer $TAG_STATUS
 *
 * The followings are the available model relations:
 * @property ArtikelTag[] $artikelTags
 * @property BarangTag[] $barangTags
 * @property TagDetail[] $tagDetails
 */
class Tag extends CActiveRecord {

    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_tag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('TAG_NAMA, TAG_STATUS', 'required'),
            array('TAG_STATUS', 'numerical', 'integerOnly' => true),
            array('TAG_NAMA', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('TAG_ID, TAG_NAMA, TAG_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'artikeltag' => array(self::HAS_MANY, 'ArtikelTag', 'TAG_ID'),
            'barangtag' => array(self::HAS_MANY, 'BarangTag', 'TAG_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'TAG_ID' => 'Tag ID',
            'TAG_NAMA' => 'Tag Nama',
            'TAG_STATUS' => 'Tag Status',
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

        $criteria->compare('TAG_ID', $this->TAG_ID);
        $criteria->compare('TAG_NAMA', $this->TAG_NAMA, true);
        $criteria->compare('TAG_STATUS', $this->TAG_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tag the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function GetTagID($tag) {
        // Untuk mengecek apa tag yang diinput sudah dimiliki sebelumnya
        $row = self::model()->findByAttributes(array('TAG_NAMA'=>$tag));
        return $row === null ? 0 : $row->TAG_ID;
    }

}
