<?php
include 'header.php';
include 'db.php';

// Son görev numarasını al
$query = "SELECT gorev_no FROM is_gorev_listesi ORDER BY gorev_no DESC LIMIT 1";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$gorev_no = $row ? $row['gorev_no'] + 1 : 1; // Eğer tablo boşsa 1'den başla

?>

<h2 class="text-center mb-4">İş Görev Ekle</h2>

<!-- Ekleme Formu -->
<form method="POST" action="insert_task.php">
    <!-- Görev numarasını hidden olarak ekleyelim, disabled olacak -->
    <div class="mb-3">
        <label for="gorev_no" class="form-label">Görev No</label>
        <input type="text" class="form-control" id="gorev_no" name="gorev_no" value="<?php echo $gorev_no; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="buro_dosya_no" class="form-label">Büro Dosya No</label>
        <input type="text" class="form-control" id="buro_dosya_no" name="buro_dosya_no" required>
    </div>

    <div class="mb-3">
        <label for="mahkeme_savcilik" class="form-label">Mahkeme/Savcılık</label>
        <input type="text" class="form-control" id="mahkeme_savcilik" name="mahkeme_savcilik" required>
    </div>

    <div class="mb-3">
        <label for="dosya_no" class="form-label">Dosya No</label>
        <input type="text" class="form-control" id="dosya_no" name="dosya_no" required>
    </div>

    <div class="mb-3">
        <label for="dosya_teslim_tarihi" class="form-label">Dosya Teslim Tarihi</label>
        <input type="date" class="form-control" id="dosya_teslim_tarihi" name="dosya_teslim_tarihi" required>
    </div>

    <div class="mb-3">
        <label for="muvekkil" class="form-label">Müvekkil</label>
        <input type="text" class="form-control" id="muvekkil" name="muvekkil" required>
    </div>

    <div class="mb-3">
        <label for="karsi_taraf" class="form-label">Karşı Taraf</label>
        <input type="text" class="form-control" id="karsi_taraf" name="karsi_taraf" required>
    </div>

    <div class="mb-3">
        <label for="aciklama" class="form-label">Açıklama</label>
        <textarea class="form-control" id="aciklama" name="aciklama" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="gorevli" class="form-label">Görevli</label>
        <input type="text" class="form-control" id="gorevli" name="gorevli" required>
    </div>

    <div class="mb-3">
        <label for="gorev_durumu" class="form-label">Görev Durumu</label>
        <select class="form-select" name="gorev_durumu" id="gorev_durumu" required>
            <option value="Tamamlandı">Tamamlandı</option>
            <option value="Tamamlanmadı">Tamamlanmadı</option>
            <option value="İptal">İptal</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Kaydet</button>
</form>

<?php
include 'footer.php';
?>
