<?php

class Expr {

    const LINK_BARANG = 1;
    const LINK_SUBKATEGORI = 2;
    const LINK_KATEGORI = 3;

    public static function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    
    public static function isNoValue($var) {
        return (!isset($var) || empty($var));
    }

    public static function systemDate($clientdate, $limiter = '/') {
        $date = explode($limiter, $clientdate);
        if (count($date) > 1)
            return $date[2] . '-' . $date[1] . '-' . $date[0];
        else
            return $clientdate;
    }

    public static function linkForward($id, $tipe) {
        switch ($tipe) {
            case self::LINK_BARANG:
                $criteria = new CDbCriteria(array(
                    'select' => 'BARANG_LINK',
                    'condition' => 'BARANG_ID=:id AND BARANG_STATUS=:status',
                    'params' => array(':id' => $id, ':status' => Barang::AKTIF),
                ));
                $model = Barang::model()->find($criteria);
                if($model === null)
                    throw new CHttpException(404, 'Halaman tidak ditemukan');
                    
                return $model->BARANG_LINK;
            case self::LINK_SUBKATEGORI:
                $criteria = new CDbCriteria(array(
                    'select' => 'SUBKATEGORI_LINK',
                    'condition' => 'SUBKATEGORI_ID=:id AND SUBKATEGORI_STATUS=:status',
                    'params' => array(':id' => $id, ':status' => Subkategori::AKTIF),
                ));
                $model = Subkategori::model()->find($criteria);
                if($model === null)
                    throw new CHttpException(404, 'Halaman tidak ditemukan');
                
                return $model->SUBKATEGORI_LINK;
            case self::LINK_KATEGORI:
                $criteria = new CDbCriteria(array(
                    'select' => 'KATEGORI_LINK',
                    'condition' => 'KATEGORI_ID=:id AND KATEGORI_STATUS=:status',
                    'params' => array(':id' => $id, ':status' => Kategori::AKTIF),
                ));
                $model = Kategori::model()->find($criteria);
                if($model === null)
                    throw new CHttpException(404, 'Halaman tidak ditemukan');
                
                return $model->KATEGORI_LINK;
            default :
                return '#';
        }
    }

//    public static function linkBackward($link) {
//        return str_replace(Yii::app()->params['var']['link_separator'], ' ', $link);
//    }

    public static function linkBackward($link, $tipe) {
        switch ($tipe) {
            case self::LINK_BARANG:
                $criteria = new CDbCriteria(array(
                    'select' => 'BARANG_ID',
                    'condition' => 'BARANG_LINK=:link AND BARANG_STATUS=:status',
                    'params' => array(':link' => $link, ':status' => Barang::AKTIF),
                ));
                $model = Barang::model()->find($criteria);
                return $model->BARANG_ID;
            case self::LINK_SUBKATEGORI:
                $criteria = new CDbCriteria(array(
                    'select' => 'SUBKATEGORI_ID',
                    'condition' => 'SUBKATEGORI_LINK=:link AND SUBKATEGORI_STATUS=:status',
                    'params' => array(':link' => $link, ':status' => Subkategori::AKTIF),
                ));
                $model = Subkategori::model()->find($criteria);
                return $model->SUBKATEGORI_ID;
            case self::LINK_KATEGORI:
                $criteria = new CDbCriteria(array(
                    'select' => 'KATEGORI_ID',
                    'condition' => 'KATEGORI_LINK=:link AND KATEGORI_STATUS=:status',
                    'params' => array(':link' => $link, ':status' => Kategori::AKTIF),
                ));
                $model = Kategori::model()->find($criteria);
                return $model->KATEGORI_ID;
            default :
                return '#';
        }
    }

    /* Fungsi alternatif dari print_r / var_dump */

    public static function uniqueFileName($nama) {
        return md5($nama . microtime()) . '.' . (end(explode('.', $nama)));
    }

}
