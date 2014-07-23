<?php

class MyFormatter extends CFormatter {

    public static function formatRemoveDash($value, $subs = '') {
        return str_replace('-', $subs, $value);
    }

    public static function formatOrderID($value) {
        $digit = '';
        $counter = 0;
        $format = array(1, 3, 3, 4, 3); // 14 digit
        foreach ($format as $set) {
            $digit .= (substr($value, $counter, $set) . '-');
            $counter+=$set;
        }

        return rtrim($digit, '-');
    }

    public static function formatAngka($value) {
        return number_format($value, 0, ',', '.');
    }

    public static function formatUang($value) {
        return "<span class='matauang'>Rp. </span><span class='totaluang'>" . number_format($value, 0, ',', '.') . "</span>";
    }

    public static function formatHargaSatuan($normal, $sale, $satuan) {
        if (is_null($sale) || empty($sale))
            return '<div class="acc-price">' . self::formatUang($normal) . '/ ' . $satuan . '</div>';
        else
            return '<div class="rej-price">' . self::formatUang($normal) . '/ ' . $satuan . '</div>' .
                    '<div class="acc-price">' . self::formatUang($sale) . '/ ' . $satuan . '</div>';
    }

    public static function formatHarga($normal, $sale) {
        if (is_null($sale) || empty($sale))
            return '<div class="acc-price">' . self::formatUang($normal) . '</div>';
        else
            return '<div class="rej-price">' . self::formatUang($normal) . '</div>' .
                    '<div class="acc-price">' . self::formatUang($sale) . '</div>';
    }

    public static function formatKelamin($value) {
        if ($value == 'L')
            return 'Pria';
        else
            return 'Wanita';
    }

    public static function formatTanggal($value) {
        if ($value != NULL) {
            $date = explode('-', $value);
            $bulan = '';
            switch ($date[1]) {
                case '01':
                    $bulan = 'Januari';
                    break;
                case '02':
                    $bulan = 'Februari';
                    break;
                case '03':
                    $bulan = 'Maret';
                    break;
                case '04':
                    $bulan = 'April';
                    break;
                case '05':
                    $bulan = 'Mei';
                    break;
                case '06':
                    $bulan = 'Juni';
                    break;
                case '07':
                    $bulan = 'Juli';
                    break;
                case '08':
                    $bulan = 'Agustus';
                    break;
                case '09':
                    $bulan = 'September';
                    break;
                case '10':
                    $bulan = 'Oktober';
                    break;
                case '11':
                    $bulan = 'Nopember';
                    break;
                case '12':
                    $bulan = 'Desember';
                    break;
            }

            return substr($date[2], 0, 2) . ' ' . $bulan . ' ' . $date[0];
        }
    }

    public static function formatTanggalWaktu($value) {
        $date = explode('-', $value);
        $bulan = '';
        switch ($date[1]) {
            case '01':
                $bulan = 'Januari';
                break;
            case '02':
                $bulan = 'Februari';
                break;
            case '03':
                $bulan = 'Maret';
                break;
            case '04':
                $bulan = 'April';
                break;
            case '05':
                $bulan = 'Mei';
                break;
            case '06':
                $bulan = 'Juni';
                break;
            case '07':
                $bulan = 'Juli';
                break;
            case '08':
                $bulan = 'Agustus';
                break;
            case '09':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'Nopember';
                break;
            case '12':
                $bulan = 'Desember';
                break;
        }

        return substr($date[2], 0, 2) . ' ' . $bulan . ' ' . $date[0] . ' ' . date('H:i', strtotime($value)) . ' WIB';
    }

    public static function formatStatusPesanan($value) {
        $kata = OrderStatus::model()->find('ORDER_STATUS_ID=' . $value)->ORDER_STATUS_NAMA;
        switch ($value) {
            case 1 : // Batal
                return '<div class="label label-default">' . $kata . '</div>';
            case 2: // Pending
                return '<div class="label label-warning">' . $kata . '</div>';
            case 3: // Menunggu konfirmasi pembayaran
                return '<div class="label label-danger">' . $kata . '</div>';
            case 4: // Persiapan kirim
                return '<div class="label label-primary">' . $kata . '</div>';
            case 5: // Terkirim
                return '<div class="label label-info">' . $kata . '</div>';
            case 6: // Telah diterima
                return '<div class="label label-success">' . $kata . '</div>';
        }
    }

    public static function formatStatusKonfirmasi($value) {
        switch ($value) {
            case Konfirmasi::TOLAK:
                return '<div class="label label-danger">Ditolak</div>';
            case Konfirmasi::PENDING:
                return '<div class="label label-warning">Pending</div>';
            case Konfirmasi::OK:
                return '<div class="label label-success">Diterima</div>';
        }
    }

    public static function formatKustomisasi($value) {
        switch ($value) {
            case 0:
                return '<div class="label label-primary">Tidak bisa</div>';
            case 1:
                return '<div class="label label-danger">Bisa</div>';
        }
    }

    public static function formatStokStatus($value) {
        switch ($value) {
            case 0:     // habis
                return '<div class="label label-default"><i class="exclamation"></i> Habis</div>';
            case 1:     // < 20 biji
                return '<div class="label label-danger">&lt 20 biji</div>';
            case 2:     // 20 - 100 biji
                return '<div class="label label-warning">20 - 100</div>';
            case 3:     // 101 - 200 biji
                return '<div class="label label-info">101 - 200</div>';
            case 4:     // > 200 biji
                return '<div class="label label-primary">&gt 200</div>';
            default:
                return '<div class="label label-success">Banyak</div>';
        }
    }

    public static function formatStatusAlamat($value) {
        switch ($value) {
            case AlamatPengiriman::ALAMAT_AKTIF_NONPERMANEN:
                return '<div class="label label-info">Aktif</div>';
            case AlamatPengiriman::ALAMAT_PERMANEN:
                return '<div class="label label-success">Permanen</div>';
            case AlamatPengiriman::ALAMAT_AKTIF_NONAKUN:
                return '<div class="label label-warning">Tanpa Akun</div>';
            case AlamatPengiriman::ALAMAT_NONAKTIF:
                return '<div class="label label-default">Non-Aktif</div>';
        }
    }

    public static function formatTipeWaktu($value) {
        switch ($value) {
            case SatuanWaktu::TIPE_WAKTU:
                return '<div class="label label-primary">Waktu</div>';
            case SatuanWaktu::TIPE_TANGGAL:
                return '<div class="label label-success">Kalender</div>';
        }
    }

    public static function formatWilayahKota($value) {
        switch ($value) {
            case Kota::WIL_KOTA:
                return '<div class="label label-warning">Kota</div>';
            case Kota::WIL_KAB:
                return '<div class="label label-success">Kabupaten</div>';
        }
    }

    public static function formatEkspedisiTipe($value) {
        switch ($value) {
            case Ekspedisi::EKSP_TEMP:
                return '<div class="label label-danger">Temporary</div>';
            case Ekspedisi::EKSP_KONV:
                return '<div class="label label-primary">Konvensional</div>';
            case Ekspedisi::EKSP_NON_KONV:
                return '<div class="label label-success">Non Konvensional</div>';
        }
    }

    public static function formatStatusAktif($value) {
        if ($value == 1)
            return '<span class="label label-info">Aktif</span>';
        else
            return '<span class="label label-warning">Non aktif</span>';
    }

    public static function formatStatusPelanggan($value) {
        switch ($value) {
            case Pelanggan::PUNYA_AKUN:
                return '<div class="label label-success"><i class="fa fa-lock"></i></div>';
            case Pelanggan::NO_AKUN:
                return '<div class="label label-danger"><i class="fa fa-unlock"></i></div>';
        }
    }

    public static function formatTipeBarang($value) {
        switch ($value) {
            case Barang::TIPE_PER:
                return '<span class="label label-info">Per Satu Barang</span>';
            case Barang::TIPE_PAKET:
                return '<span class="label label-success">Paket</span>';
        }
    }

    public static function formatJson1ToTable($value) {
        $array = CJSON::decode($value);
        $table = '<table class="table table-view">';
        foreach ($array as $att => $spek) {
            $table .= "<tr><th> $att </th><td> $spek </td></tr>";
        }
        
        return $table . '</table>';
    }

//    public static function formatHitungTotal($value) {
//        $total = 0;
//        $order = Order::model()->findByPk($value);
//        $detail = OrderDetail::model()->findAllByAttributes(array('ORDER_ID'=>$value));
//        foreach ($detail as $item)
//            $total+=($item->HARGA_BELI*$item->JUMLAH);
//        return self::formatUang($total+$order->BIAYA_KIRIM);
//    }
//    
//    public static function formatEkspedisi($value) {
//        $kata = Ekspedisi::model()->find('EKSPEDISI_ID='.$value)->EKSPEDISI_NAMA;
//        switch ($value) {
//            case 1 : // -
//                return '<i>Belum ditentukan</i>';
//            default:
//                return $kata;
//        }
//    }

    public static function formatRegisteredStatus($value) {
        if ($value == Registered::AKTIF)
            return '<div class="label label-success">Aktif</div>';
        else if ($value == Registered::NONAKTIF)
            return '<div class="label label-danger">Non Aktif</div>';
    }

    public static function formatToJSON($value, $row_delimiter = ';', $col_delimiter = '|') {
        if(!Expr::isJson($value)) {
            $list = array();
            $value = trim(strip_tags($value), " ;");
            if (!empty($value)) {
                $perrow = explode($row_delimiter, $value);
                foreach ($perrow as $row) {
                    $col = explode($col_delimiter, $row);
                    $list[$col[0]] = isset($col[1]) ? $col[1] : '-';
                }
            }
            
            $value = CJSON::encode($list);
        }

        return $value;
    }

    public static function formatFromJson($value, $row_delimiter = ';', $col_delimiter = '|') {
        $array = CJSON::decode($value);
        $string = '';
        if (!empty($array)) {
            foreach ($array as $name => $value) {
                $string .= ($name . $col_delimiter) . ($value . $row_delimiter);
            }
        }

        return rtrim($string, $row_delimiter);
    }

    public static function formatThumbnaili($value) {
        $gambar = Gambar::model()->findByPk($value);
        return CHtml::link(CHtml::image(Yii::app()->baseUrl . $gambar->GAMBAR_NAMA, "", array("class" => "img-thumbnail-i")), Yii::app()->baseUrl . $gambar->GAMBAR_NAMA, array("class" => "fancy"));
    }

    public static function formatThumbnails($value) {
        $gambar = Gambar::model()->findByPk($value);
        return CHtml::link(CHtml::image(Yii::app()->baseUrl . $gambar->GAMBAR_NAMA, "", array("class" => "img-thumbnail-s")), Yii::app()->baseUrl . $gambar->GAMBAR_NAMA, array("class" => "fancy"));
    }

}
?>