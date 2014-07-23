<?php

/**
 * This is the model class for table "faq".
 *
 * The followings are the available columns in table 'faq':
 * @property integer $FAQ_ID
 * @property string $FAQ_TANYA
 * @property string $FAQ_JAWAB
 * @property integer $FAQ_SECTION
 * @property integer $FAQ_STATUS
 */
class Faq extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'faq';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('FAQ_TANYA, FAQ_JAWAB, FAQ_SECTION', 'required'),
            array('FAQ_SECTION, FAQ_STATUS', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('FAQ_ID, FAQ_TANYA, FAQ_JAWAB, FAQ_SECTION, FAQ_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'FAQ_ID' => 'Faq',
            'FAQ_TANYA' => 'Faq Tanya',
            'FAQ_JAWAB' => 'Faq Jawab',
            'FAQ_SECTION' => 'Faq Section',
            'FAQ_STATUS' => 'Faq Status',
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

        $criteria->compare('FAQ_ID', $this->FAQ_ID);
        $criteria->compare('FAQ_TANYA', $this->FAQ_TANYA, true);
        $criteria->compare('FAQ_JAWAB', $this->FAQ_JAWAB, true);
        $criteria->compare('FAQ_SECTION', $this->FAQ_SECTION);
        $criteria->compare('FAQ_STATUS', $this->FAQ_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Faq the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
