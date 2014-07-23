<?php

class Message {

    public static function _alert($keyword, $params = array()) {
        switch ($keyword) {
            case 'form_ok':
                return 'Data berhasil disimpan.';
            case 'form_invalid':
                return 'Kesalahan input pada form. Isi form dengan benar untuk melanjutkan.';
            case 'system_failed':
                return 'Uups, mohon maaf! Terjadi error. Silahkan coba kembali setelah beberapa saat atau laporkan pada operator kami.';
            case 'cart_update':
                return 'Keranjang berhasil diubah';
            case 'username_exist':
                return 'Username sudah terpakai. Silahkan coba username yang berbeda.';
            case 'username_not_found':
                return 'Username salah. Pastikan Anda menulis username dengan benar.';
            case 'username_ok':
                return 'Username tersedia.';
            case 'register_ok':
                return 'Terima kasih Anda telah mendaftarkan diri sebagai anggota Jayagrosir.net.<br>
                    Silahkan cek inbox/spam email untuk mengaktifkan akun Anda melalui link aktifasi yang telah kami kirimkan.';
            case 'register_ok_email_not_sent':
                return 'Terima kasih Anda telah mendaftarkan diri sebagai anggota Jayagrosir.net.<br>
            		<span class="text-danger">Email aktifasi akun gagal terkirim. Silahkan hubungi admin melalui halaman <a href="/kontak">kontak kami</a></span>';
            case 'email_exist':
                return 'Email sudah terpakai. Silahkan coba email yang berbeda.';
            case 'email_available':
                return 'Email tersedia.';
            case 'email_ok':
                return 'Pesan email berhasil terkirim. Terima kasih sudah menghubungi kami.';
            case 'email_failed':
                return 'Pesan email gagal dikirim. Coba beberapa saat lagi atau laporkan pada operator kami.';
            case 'aktifasi_ok':
                return 'Selamat! Akun Jayagrosir.net milik Anda kini telah aktif.';
            case 'aktifasi_failed':
                return 'Mohom maaf, link aktifasi Anda salah. Silahkan hubungi operator kami untuk mendapat tindak lanjut.';
            case 'aktifasi_denied':
                return 'Akun Anda sudah diaktifasi sebelumnya. Untuk masuk ke halaman pelanggan, silahkan coba login melalui halaman ini.';
            case 'order_ok':
                return 'Barang berhasil ditambahkan pada keranjang';
            case 'order_failed':
                return 'Uups! Terjadi kesalahan pada proses order barang. Silahkan coba kembali beberapa saat';
            case 'order_mail_sent':
                return 'Terima kasih atas order Anda. Pesan konfirmasi pemesanan telah kami kirimkan ke alamat email Anda.';
            case 'konfirmasi_ok':
                return 'Terima kasih atas konfirmasi Anda. Setelah proses verifikasi yang kami lakukan selesai, Anda akan kami hubungi melalui email dan sms.';
            case 'resetpass_ok':
                return 'Password Anda berhasil kami rubah menjadi password baru. Silahkan cek email Anda untuk mendapatkan password baru akun Anda.';
            case 'price_duplicate':
                // $params[0] = adalah column name yang divalidasi
                return 'Duplikasi ' . $params[0] . '!';
            case 'supplier_form_ok':
                // $params[0] = adalah NAMA_PEMILIK
                return 'Terima kasih '.$params[0].', karena telah menawarkan usaha Anda menjadi salah satu calon supplier kami. Kami akan segera menghubungi Anda ketika ada keputusan.';
            default:
                return '';
        }
    }

}
