<?php
include 'db.php';

// Silinecek görevin numarasını al
if (isset($_GET['gorev_no'])) {
    $gorev_no = $_GET['gorev_no'];

    // Silme sorgusunu oluştur
    $query = "DELETE FROM is_gorev_listesi WHERE gorev_no = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $gorev_no);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Başarıyla silindiyse dashboard.php'ye yönlendir
    } else {
        echo "Silme işlemi sırasında bir hata oluştu!";
    }
} else {
    echo "Görev numarası bulunamadı!";
}
?>
