<?php

/**
 * This is the model class for table "barang_tag".
 *
 * The followings are the available columns in table 'barang_tag':
 * @property integer $BARANG_TAG_ID
 * @property integer $BARANG_ID
 * @property integer $TAG_ID
 *
 * The followings are the available model relations:
 * @property Barang $bARANG
 * @property MTag $tAG
 */
class BarangTag extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'barang_tag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('BARANG_ID, TAG_ID', 'required'),
            array('BARANG_ID, TAG_ID', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('BARANG_TAG_ID, BARANG_ID, TAG_ID', 'safe', 'on' => 'search'),
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
            'tag' => array(self::BELONGS_TO, 'Tag', 'TAG_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'BARANG_TAG_ID' => 'Barang Tag',
            'BARANG_ID' => 'Barang',
            'TAG_ID' => 'Tag',
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

        $criteria->compare('BARANG_TAG_ID', $this->BARANG_TAG_ID);
        $criteria->compare('BARANG_ID', $this->BARANG_ID);
        $criteria->compare('TAG_ID', $this->TAG_ID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BarangTag the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function GetMetaTag($bid) {
        $csv = '';
        $tags = self::model()->findAllByAttributes(array('BARANG_ID' => $bid));
        foreach ($tags as $tag) {
            $csv .= $tag->tag->TAG_NAMA . ', ';
        }
        
        return rtrim($csv, ', ');
    }

}
