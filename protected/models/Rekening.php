<?php

/**
 * This is the model class for table "m_rekening".
 *
 * The followings are the available columns in table 'm_rekening':
 * @property integer $REKENING_ID
 * @property string $ATAS_NAMA
 * @property string $REKENING_BANK
 * @property string $REKENING_NO
 * @property integer $REKENING_STATUS
 *
 * The followings are the available model relations:
 * @property Konfirmasi[] $konfirmasis
 */
class Rekening extends CActiveRecord {

    const AKTIF = 1;
    const NONAKTIF = 0;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_rekening';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ATAS_NAMA, REKENING_BANK, REKENING_NO, REKENING_CABANG', 'required'),
            array('REKENING_STATUS', 'numerical', 'integerOnly' => true),
            array('ATAS_NAMA', 'length', 'max' => 50),
            array('REKENING_BANK', 'length', 'max' => 25),
            array('REKENING_NO', 'length', 'max' => 30),
            array('REKENING_CABANG', 'length', 'max' => 127),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('REKENING_ID, ATAS_NAMA, REKENING_BANK, REKENING_NO, REKENING_CABANG, REKENING_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'konfirmasi' => array(self::HAS_MANY, 'Konfirmasi', 'REKENING_ID'),
            'gambar' => array(self::BELONGS_TO, 'Gambar', 'GAMBAR_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'REKENING_ID' => 'Rekening',
            'ATAS_NAMA' => 'Atas Nama',
            'REKENING_BANK' => 'Rekening Bank',
            'REKENING_NO' => 'Rekening No',
            'REKENING_CABANG' => 'Rekening Cabang',
            'REKENING_STATUS' => 'Rekening Status',
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

        $criteria->compare('REKENING_ID', $this->REKENING_ID);
        $criteria->compare('ATAS_NAMA', $this->ATAS_NAMA, true);
        $criteria->compare('REKENING_BANK', $this->REKENING_BANK, true);
        $criteria->compare('REKENING_NO', $this->REKENING_NO, true);
        $criteria->compare('REKENING_CABANG', $this->REKENING_CABANG, true);
        $criteria->compare('REKENING_STATUS', $this->REKENING_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Rekening the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function ListAll() {
        $list = array();
        $model = self::model()->findAllByAttributes(array('REKENING_STATUS'=>self::AKTIF));
        foreach($model as $rek) {
            $list[$rek->REKENING_ID] = "$rek->REKENING_NO - $rek->REKENING_BANK";
        }
        return $list;
    }

}
