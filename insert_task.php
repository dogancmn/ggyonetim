<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen verileri al
    $gorev_no = $_POST['gorev_no'];
    $buro_dosya_no = $_POST['buro_dosya_no'];
    $mahkeme_savcilik = $_POST['mahkeme_savcilik'];
    $dosya_no = $_POST['dosya_no'];
    $dosya_teslim_tarihi = $_POST['dosya_teslim_tarihi'];
    $muvekkil = $_POST['muvekkil'];
    $karsi_taraf = $_POST['karsi_taraf'];
    $aciklama = $_POST['aciklama'];
    $gorevli = $_POST['gorevli'];
    $gorev_durumu = $_POST['gorev_durumu'];

    // Veriyi veritabanına ekle
    $query = "INSERT INTO is_gorev_listesi (gorev_no, buro_dosya_no, mahkeme_savcilik, dosya_no, dosya_teslim_tarihi, muvekkil, karsi_taraf, aciklama, gorevli, gorev_durumu) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('isssssssss', $gorev_no, $buro_dosya_no, $mahkeme_savcilik, $dosya_no, $dosya_teslim_tarihi, $muvekkil, $karsi_taraf, $aciklama, $gorevli, $gorev_durumu);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Başarıyla kaydedildiyse dashboard'a yönlendir
        exit;
    } else {
        echo "Görev eklenirken bir hata oluştu!";
    }
}
?>
