<?php
session_start();
include 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    if (!empty($email) && !empty($password)) {
        $queryAdmin = "SELECT * FROM admin WHERE admin_email = ? AND admin_sifre = ?";
        $stmtAdmin = $mysqli->prepare($queryAdmin);
        $stmtAdmin->bind_param('ss', $email, $password);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();

        $queryUser = "SELECT * FROM user WHERE user_mail = ? AND user_sifre = ?";
        $stmtUser = $mysqli->prepare($queryUser);
        $stmtUser->bind_param('ss', $email, $password);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

        if ($resultAdmin->num_rows > 0) {
            $user = $resultAdmin->fetch_assoc();
            $_SESSION['user'] = $user['admin_ad'];
            $_SESSION['user_image'] = '';
            $timeout = $remember ? 600 * 60 * 60 : 48 * 60 * 60;
            setcookie('user', $user['admin_ad'], time() + $timeout, '/');
            header("Location: index.php");
            exit;
        } elseif ($resultUser->num_rows > 0) {
            $user = $resultUser->fetch_assoc();
            $_SESSION['user'] = $user['user_ad'];
            $_SESSION['user_image'] = $user['user_resim'];
            $timeout = $remember ? 600 * 60 * 60 : 48 * 60 * 60;
            setcookie('user', $user['user_ad'], time() + $timeout, '/');
            header("Location: index.php");
            exit;
        } else {
            $error = 'E-posta veya şifre yanlış!';
        }
    } else {
        $error = 'Tüm alanları doldurun!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Giriş Yap</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Beni Hatırla</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
        </form>
    </div>
</body>
</html>
