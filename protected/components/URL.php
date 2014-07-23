<?php

class URL {
    
    public static function Gambar($no) {
        switch ($no) {
            case Gambar::URL_TOKO:
                return '/../images/toko/';
            case Gambar::URL_PELANGGAN:
                return '/../images/pelanggan/';
            case Gambar::URL_PRODUK:
                return '/../images/produk/';
            case Gambar::URL_MAIL:
                return '/../images/mail/';
            case Gambar::URL_REKENING:
                return '/../images/toko/rekening/';
            case Gambar::URL_SUBKATEGORI:
            	return '/../images/toko/subkategori/';
            case Gambar::URL_KATEGORI:
            	return '/../images/toko/kategori/';
            case Gambar::URL_LAIN:
                return '/../images/lain/';
            default:
                return '';
        }
    }
}