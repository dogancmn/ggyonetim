<?php
include 'header.php';
include 'db.php';

// Filtreleme parametrelerini al
$gorevli = $_GET['gorevli'] ?? '';
$durum = $_GET['durum'] ?? '';

// Görevleri filtrele
$query = "SELECT * FROM is_gorev_listesi WHERE 1=1";
if (!empty($gorevli)) {
    $query .= " AND gorevli = '$gorevli'";
}
if (!empty($durum)) {
    $query .= " AND gorev_durumu = '$durum'";
}
$result = $mysqli->query($query);

// Tüm görevli listesi için sorgu
$gorevliListQuery = "SELECT DISTINCT gorevli FROM is_gorev_listesi";
$gorevliListResult = $mysqli->query($gorevliListQuery);
?>

<h2 class="text-center mb-4">İş Görev Listesi</h2>

<!-- "İş Görev Ekle" Butonu -->
<div class="mb-3">
    <a href="is_gorev_ekle.php" class="btn btn-success">İş Görev Ekle</a>
</div>

<!-- Filtreleme Formu -->
<form method="GET" class="row g-3">
    <div class="col-md-4">
        <label for="gorevli" class="form-label">Personel</label>
        <select name="gorevli" id="gorevli" class="form-select">
            <option value="">Tümü</option>
            <?php while ($row = $gorevliListResult->fetch_assoc()): ?>
                <option value="<?php echo $row['gorevli']; ?>" <?php echo $gorevli === $row['gorevli'] ? 'selected' : ''; ?>>
                    <?php echo $row['gorevli']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="col-md-4">
        <label for="durum" class="form-label">Görev Durumu</label>
        <select name="durum" id="durum" class="form-select">
            <option value="">Tümü</option>
            <option value="Tamamlandı" <?php echo $durum === 'Tamamlandı' ? 'selected' : ''; ?>>Tamamlandı</option>
            <option value="Tamamlanmadı" <?php echo $durum === 'Tamamlanmadı' ? 'selected' : ''; ?>>Tamamlanmadı</option>
            <option value="İptal" <?php echo $durum === 'İptal' ? 'selected' : ''; ?>>İptal</option>
        </select>
    </div>
    <div class="col-md-4 align-self-end">
        <button type="submit" class="btn btn-primary w-100">Filtrele</button>
    </div>
</form>

<!-- Görev Tablosu -->
<div class="table-responsive" style="padding-left: 0; padding-right: 0;"> <!-- Kenar boşlukları kaldırıldı -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">Görev No</th>
                <th scope="col">Büro Dosya No</th>
                <th scope="col">Mahkeme/Savcılık</th>
                <th scope="col">Dosya No</th>
                <th scope="col">Dosya Teslim Tarihi</th>
                <th scope="col">Müvekkil</th>
                <th scope="col">Karşı Taraf</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Görevli</th>
                <th scope="col" style="width: 200px;">Görev Durumu</th> <!-- Görev Durumu genişletildi -->
                <th scope="col">İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <!-- Satırın arka plan rengini görev durumuna göre ayarla -->
                    <?php
                        $backgroundColor = '';
                        if ($row['gorev_durumu'] == 'Tamamlandı') {
                            $backgroundColor = 'background-color: green;';
                        } elseif ($row['gorev_durumu'] == 'Tamamlanmadı') {
                            $backgroundColor = 'background-color: red;';
                        }
                    ?>
                    <tr style="<?php echo $backgroundColor; ?>">
                        <td><?php echo $row['gorev_no']; ?></td>
                        <td><?php echo $row['buro_dosya_no']; ?></td>
                        <td><?php echo $row['mahkeme_savcilik']; ?></td>
                        <td><?php echo $row['dosya_no']; ?></td>
                        <td><?php echo $row['dosya_teslim_tarihi']; ?></td>
                        <td><?php echo $row['muvekkil']; ?></td>
                        <td><?php echo $row['karsi_taraf']; ?></td>
                        <td><?php echo $row['aciklama']; ?></td>
                        <td><?php echo $row['gorevli']; ?></td>
                        <td>
                            <form method="POST" action="update_task.php" class="d-inline">
                                <input type="hidden" name="gorev_no" value="<?php echo $row['gorev_no']; ?>">
                                <select name="gorev_durumu" class="form-select">
                                    <option value="Tamamlandı" <?php echo $row['gorev_durumu'] === 'Tamamlandı' ? 'selected' : ''; ?>>Tamamlandı</option>
                                    <option value="Tamamlanmadı" <?php echo $row['gorev_durumu'] === 'Tamamlanmadı' ? 'selected' : ''; ?>>Tamamlanmadı</option>
                                    <option value="İptal" <?php echo $row['gorev_durumu'] === 'İptal' ? 'selected' : ''; ?>>İptal</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success mt-2">Kaydet</button>
                            </form>
                        </td>
                        <td>
                            <!-- Düzenleme Butonu -->
                            <a href="is_gorev_duzenle.php?gorev_no=<?php echo $row['gorev_no']; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                            <!-- Silme Butonu -->
                            <a href="delete_task.php?gorev_no=<?php echo $row['gorev_no']; ?>" class="btn btn-sm btn-danger">Sil</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" class="text-center">Görev bulunamadı.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>
