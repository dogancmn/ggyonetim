<?php
// Veritabanı bağlantısı
$host = 'localhost';
$dbname = 'doganfnt_gunesgunes';
$username = 'doganfnt_gunesgunes';
$password = '01Adana01';

// Veritabanı bağlantısını oluştur
$mysqli = new mysqli($host, $username, $password, $dbname);

// Karakter setini UTF-8 Türkçe uyumlu yapalım
if (!$mysqli->set_charset("utf8mb4")) {
    echo "Karakter seti ayarı yapılırken hata oluştu: " . $mysqli->error;
}

// Bağlantı kontrolü
if ($mysqli->connect_error) {
    die("Veritabanı bağlantı hatası: " . $mysqli->connect_error);
}
?>
