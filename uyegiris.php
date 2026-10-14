<?php
session_start();
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "uyeler";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Veritabanına bağlanılamadı: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    $kullanici_mail = trim($_POST['kullanici_mail'] ?? '');
    $kullanici_sifre = trim($_POST['kullanici_sifre'] ?? '');

    if (!empty($kullanici_mail) && !empty($kullanici_sifre)) {
        // Güvenli Giriş Sorgusu
        $stmt = $conn->prepare("SELECT * FROM visitor WHERE visitormail = ? AND visitorsifre = ?");
        $stmt->bind_param("ss", $kullanici_mail, $kullanici_sifre);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_mail'] = $user['visitormail'];
            $_SESSION['user_name'] = $user['visitorname'];

            header("Location: anasayfa.html");
            exit();
        } else {
            $mesaj = '<p class="error-message" style="color:red;">Hatalı e-posta veya şifre. Lütfen tekrar deneyin.</p>';
        }
        $stmt->close();
    } else {
        $mesaj = '<p class="error-message" style="color:red;">Lütfen tüm alanları doldurun.</p>';
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Girişi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Kitap Kurdu</h1>
        <nav>
            <ul>
                <li><a href="anasayfa.html">Anasayfa</a></li>
                <li><a href="kitap.php">Kitaplar</a></li>
                <li><a href="uyeol.php">Üye Ol</a></li>
                <li><a href="uyegiris.php">Üye Girişi</a></li>
                <li><a href="sepet.php">Sepetim</a></li>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <h2>Üye Girişi</h2>
        <?php if (!empty($mesaj)) { echo $mesaj; } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="email" name="kullanici_mail" placeholder="E-posta" required><br>
            <input type="password" name="kullanici_sifre" placeholder="Şifre" required><br>
            <input type="submit" value="Giriş Yap">
        </form>
    </section>
    <footer>
        <p>&copy; 2026 Kitap Kurdu</p>
    </footer>
</body>
</html>