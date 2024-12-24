<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
    header("Location: login.php");
    exit;
}

$userName = $_SESSION['user'] ?? $_COOKIE['user'];
$userImage = $_SESSION['user_image'] ?? 'assets/images/default.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İŞ YÖNETİM PANELİ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Sol Menü (Navbar) */
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%; /* Sidebar'ın tüm ekran boyutunda olmasını sağlar */
            background-color:rgb(248, 248, 248);
            padding-top: 20px;
            color: black;
            border-right: #333;
            padding-bottom: 20px; /* En altın boş kalmasını engeller */
        }

        /* Logo ve Başlık */
        .sidebar .logo-container {
            text-align: center; /* Logoyu merkeze yerleştir */
            margin-bottom: 20px; /* Başlık ile logo arasında boşluk */
        }

        .sidebar img {
            max-width: 150px;
            height: auto;
        }

        .sidebar h1 {
            color: #333;
            font-size: 20px;
            margin-top: 10px;
            color: black;
        }

        /* Solbuton Sınıfı */
        .sidebar .solbuton {
            color: white; /* Yazı siyah */
            background-color: #990000; /* Buton siyah */
            padding: 10px 20px;
            text-decoration: none;
            display: block;
            font-size: 18px;
            border-radius: 1px;
            margin: 10px 0;
            text-align: left;
        }

        /* Solbuton Hover Durumu */
        .sidebar .solbuton:hover {
            background-color:hsl(0, 100.00%, 22.50%); /* Koyu kırmızı */
            color: white; /* Yazı beyaz olacak */
        }

        /* "Ana Menü" Butonu En Üstte ve Aynı Stil */
        .sidebar .ana-menu {
            color: white;
            background-color: #990000;
            padding: 10px 20px;
            text-decoration: none;
            display: block;
            font-size: 18px;
            border-radius: 1px;
            margin-top: 20px; /* En üste yerleştir */
            text-align: center;
        }

        .sidebar .ana-menu:hover {
            background-color: black; /* Koyu kırmızı */
            
            color: white;
        }

        /* Menü Bağlantıları */
        .sidebar .navbar-brand {
            color: white;
            font-size: 24px;
            padding-left: 20px;
        }

        .sidebar a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            font-size: 18px;
            border-bottom: 1px solid #444;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        /* Sabit Çıkış Yap Butonu */
        .sidebar .btn-custom {
            background-color: #b30000; /* Koyu kırmızı */
            color: white;
            border-radius: 1px;
            padding: 10px 30px;
            text-transform: uppercase;
            font-weight: bold;
            position: absolute;
            bottom: 20px; /* Butonu en alta yerleştir */
            left: 50%;
            transform: translateX(-50%); /* Ortalamak için */
            width: 180px;
            text-decoration: none;
        }

        .sidebar .btn-custom:hover {
            background-color: #990000;
            color: white;
        }

        /* Sağdaki içerik kısmı */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Responsive tasarım için menüyü mobilde gizle */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sol Menü -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="resimler/logo.png" alt="Logo"> <!-- Logo en üste yerleştirildi -->
            <h1>İŞ YÖNETİM PANELİ</h1> <!-- Başlık Logo Altında -->
        </div>
        <a href="index.php" class="solbuton"><i class="fas fa-home"></i> ANA MENÜ</a> <!-- Ana Menü Butonu en üstte -->
<a href="dashboard.php" class="solbuton"><i class="fas fa-tasks"></i> İŞ GÖREV LİSTESİ</a> <!-- Solbuton sınıfı eklendi -->
<a href="durusma_listesi.php" class="solbuton"><i class="fas fa-calendar-day"></i> DURUŞMA LİSTESİ</a> <!-- Ana Menü Butonu en üstte -->
<a href="dava_listesi.php" class="solbuton"><i class="fas fa-gavel"></i> DAVA LİSTESİ</a> <!-- Ana Menü Butonu en üstte -->
<a href="personel_yonetim.php" class="solbuton"><i class="fas fa-users-cog"></i> PERSONEL YÖNETİMİ</a> <!-- Solbuton sınıfı eklendi -->
<a href="logout.php" class="btn-custom"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a> <!-- Sabit Çıkış Butonu -->

    </div>

    <!-- Sağdaki İçerik -->
    <div class="content">
        <!-- Burada ana içerik olacak -->
