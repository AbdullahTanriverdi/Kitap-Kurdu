<?php
include 'islem.php'; // islem.php dosyasını dahil ediyoruz
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Ol</title>
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
        <h2>Üye Ol</h2>
        <?php if (!empty($mesaj)) { echo $mesaj; } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="kullanici_adi" placeholder="Kullanıcı Adı" required><br>
            <input type="email" name="kullanici_mail" placeholder="E-posta" required><br>
            <input type="password" name="kullanici_sifre" placeholder="Şifre" required><br>
            <input type="submit" value="Üye Ol">
        </form>
    </section>
    <footer>
        <p>&copy; 2026 Kitap Kurdu</p>
    </footer>
</body>
</html>
