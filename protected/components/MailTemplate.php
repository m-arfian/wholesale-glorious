<?php

class MailTemplate {
    
    public static function order_confirmation($order /*model*/) {
        $oid = MyFormatter::formatOrderID($order->ORDER_ID);
        $detail = CJSON::decode($order->getOrderDetail());
        // $pelanggan = $order->alamat->pelanggan->NAMA;
        $pelanggan = $order->ORDER_ID;
        
        $tabel = "<table border='1'><tr><th>No.</th><th>Nama Barang</th><th>Jumlah satuan</th><th>Harga/satuan</th><th>Subtotal</th></tr>";
        foreach($detail as $det) {
            $tabel .= "<tr><td>$det[no]</td><td>$det[nama]</td><td>$det[jml] $det[sat]</td>".
                "<td>".MyFormatter::formatUang($det['hrg'])."</td><td>".MyFormatter::formatUang($det['subt'])."</td></tr>";
        }
        $tabel .= "<tr><th colspan=4 style='text-align:center'>Total</th><td style='text-align:center'>".$order->getTotal()."</td></tr>";
        $tabel .= "<tr><th colspan=4 style='text-align:center'><i>Jasa Ekspedisi - ".$order->ekspedisi->EKSPEDISI_NAMA."</i></th><td style='text-align:center'><i>".Order::NO_VALUE_0."</i></td></tr>";
        $tabel .= "<tr><th colspan=4 style='text-align:center'>GRAND TOTAL</th><td style='text-align:center'>".$order->getGrandTotal()."</td></tr>";
        $tabel .= "</table>";
        
        return ("
            <p>Halo $pelanggan,</p>
            <p>Terima kasih telah melakukan pemesanan barang kami melalui Jayagrosir.net.<br/>
            Berikut merupakan Order ID Anda beserta sejumlah barang yang Anda pesan:</p>
            <p>Order ID: $oid<br/>
                $tabel</p>
            <p>Informasi biaya pengiriman dan GRAND TOTAL akan segera kami sampaikan melalui halaman cek order, email dan/atau SMS.
            Mohon simpan Order ID Anda untuk keperluan komunikasi lebih lanjut mengenai pemesanan Anda.
            Silahkan cek status order Anda melalui halaman ".CHtml::link('cek order', 'www.jayagrosir.net/cek-pemesanan')."</p>
        ");
    }
    
    public static function sign_up_ok($regid, $plainpass) {
        $delimiter = Yii::app()->params['var']['aktifasi_delimiter'];
        $registered = Registered::model()->findByPk($regid);
        $linkaktivasi = "http://www.jayagrosir.net/pelanggan/default/aktifasi/link/".$registered->REGISTERED_ID.$delimiter.md5($plainpass).$delimiter.$registered->PELANGGAN_ID;
        
        return ("
            <p>Halo ".$registered->pelanggan->NAMA.",</p>
            <p>Terima kasih telah bergabung bersama kami.<br/>
            Berikut merupakan Username dan Password akun Anda</p>
            <p>Username: $registered->USERNAME<br/>
                Password: $plainpass</p>
            <p>Saat ini akun Anda masih dalam keadaan nonaktif, silahkan klik pada link aktifasi berikut untuk mengaktifkan akun Anda<br/>
            $linkaktivasi </p>
        ");
    }
    
    public static function reset_password($user, $pass, $nama) {
    	return ("
    		<p>Halo $nama,</p>
    		<p>Anda telah melakukan reset password akun Jayagrosir.net<br/>
    		Berikut merupakan username dan password Anda yang baru.</p>
    		<p>Username: $user<br/>Password: $pass</p>
    		<p>Mohon untuk username dan password disimpan dengan baik.</p>
    	");
    }
    
}
?>
