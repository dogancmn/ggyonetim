<?php
include 'header.php';
include 'db.php';

// Görev numarasını al
if (!isset($_GET['gorev_no'])) {
    echo "Görev numarası bulunamadı!";
    exit;
}

$gorev_no = $_GET['gorev_no'];

// Görevi veritabanından al
$query = "SELECT * FROM is_gorev_listesi WHERE gorev_no = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $gorev_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Görev bulunamadı.";
    exit;
}

$row = $result->fetch_assoc();
?>

<h2 class="text-center mb-4">Görev Düzenleme</h2>

<!-- Düzenleme Formu -->
<form method="POST" action="update_task.php">
    <input type="hidden" name="gorev_no" value="<?php echo $row['gorev_no']; ?>">

    <div class="mb-3">
        <label for="buro_dosya_no" class="form-label">Büro Dosya No</label>
        <input type="text" class="form-control" id="buro_dosya_no" name="buro_dosya_no" value="<?php echo $row['buro_dosya_no']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="mahkeme_savcilik" class="form-label">Mahkeme/Savcılık</label>
        <input type="text" class="form-control" id="mahkeme_savcilik" name="mahkeme_savcilik" value="<?php echo $row['mahkeme_savcilik']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="dosya_no" class="form-label">Dosya No</label>
        <input type="text" class="form-control" id="dosya_no" name="dosya_no" value="<?php echo $row['dosya_no']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="dosya_teslim_tarihi" class="form-label">Dosya Teslim Tarihi</label>
        <input type="date" class="form-control" id="dosya_teslim_tarihi" name="dosya_teslim_tarihi" value="<?php echo $row['dosya_teslim_tarihi']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="muvekkil" class="form-label">Müvekkil</label>
        <input type="text" class="form-control" id="muvekkil" name="muvekkil" value="<?php echo $row['muvekkil']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="karsi_taraf" class="form-label">Karşı Taraf</label>
        <input type="text" class="form-control" id="karsi_taraf" name="karsi_taraf" value="<?php echo $row['karsi_taraf']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="aciklama" class="form-label">Açıklama</label>
        <textarea class="form-control" id="aciklama" name="aciklama" rows="3" required><?php echo $row['aciklama']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="gorevli" class="form-label">Görevli</label>
        <input type="text" class="form-control" id="gorevli" name="gorevli" value="<?php echo $row['gorevli']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="gorev_durumu" class="form-label">Görev Durumu</label>
        <select class="form-select" name="gorev_durumu" id="gorev_durumu" required>
            <option value="Tamamlandı" <?php echo $row['gorev_durumu'] === 'Tamamlandı' ? 'selected' : ''; ?>>Tamamlandı</option>
            <option value="Tamamlanmadı" <?php echo $row['gorev_durumu'] === 'Tamamlanmadı' ? 'selected' : ''; ?>>Tamamlanmadı</option>
            <option value="İptal" <?php echo $row['gorev_durumu'] === 'İptal' ? 'selected' : ''; ?>>İptal</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Kaydet</button>
</form>

<?php
include 'footer.php';
?>
