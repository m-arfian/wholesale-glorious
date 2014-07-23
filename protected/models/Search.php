<?php

class Search extends CFormModel {
    
    public function rules() {
        return array();
    }

    public function attributeLabels() {
        return array();
    }

    public function searchBarang($key) {
        
        $criteria = Barang::DistinctRowMultiQuery();
        $criteria->addSearchCondition('BARANG_NAMA', trim($key), true, 'AND', 'LIKE');

        return new CActiveDataProvider('Barang', array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

}

?>