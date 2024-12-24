<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen verileri al
    $gorev_no = $_POST['gorev_no'];
    $gorev_durumu = $_POST['gorev_durumu'];

    // Veriyi veritabanına güncelle
    $query = "UPDATE is_gorev_listesi SET gorev_durumu = ? WHERE gorev_no = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $gorev_durumu, $gorev_no);

    if ($stmt->execute()) {
        // Başarıyla kaydedildiyse dashboard'a yönlendir
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Görev durumu güncellenirken bir hata oluştu!";
    }
}
?>
