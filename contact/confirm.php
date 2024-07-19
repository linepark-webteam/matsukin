<?php
session_start();

// セッション変数が設定されていないか確認（直接アクセスをチェック）
if (empty($_SESSION['name']) || empty($_SESSION['email'])) {
  // セッション変数が設定されていない場合は、./contact/ へリダイレクト
  header('Location: ../contact/');
  exit;
}

// セッションからデータを取得
$name = $_SESSION['name'] ?? '';
$kana = $_SESSION['kana'] ?? '';
$companyName = $_SESSION['companyName'] ?? '';
$email = $_SESSION['email'] ?? '';
$confirmEmail = $_SESSION['confirmEmail'] ?? '';
$inquiry = $_SESSION['inquiry'] ?? '';
$privacyPolicy = $_SESSION['privacyPolicy'] ?? '';

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ↓↓↓↓ 完成後に作成 ↓↓↓↓ -->
  <!-- ↓ サイト説明文 -->
  <meta name="description" content="">
  <!-- ↓ 検索キーワード -->
  <meta name="keywords" content="">
  <meta property="og:type" content="website">
  <meta property="og:title" content="東北松金工業株式会社">
  <meta property="og:description" content="＊">

  <!-- Favicon -->
  <link rel="icon" href="./img/favicon-16x16.png" type="image/png" sizes="16x16">
  <link rel="icon" href="./img/favicon-32x32.png" type="image/png" sizes="32x32">
  <link rel="icon" href="./img/favicon-32x32.png" type="image/png" sizes="48x48">
  <!-- AppleIcon -->
  <link rel="apple-touch-icon" href="./img/apple-touch-icon.png" sizes="180x180">

  <!-- Shippori Antique B1 & Zen Kaku Gothic New Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">

  <!-- ↓ リセットCSS -->
  <link rel="stylesheet" href="../css/ress.min.css">

  <!-- ↓ BootStrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- ↓ BootStrapのスタイルを上書き -->
  <link rel="stylesheet" href="../css/mybootstrap.css">

  <link rel="stylesheet" href="../css/common.css">
  <!-- ↓ アニメーション用のスタイルシート -->
  <link rel="stylesheet" href="../css/animation.css">

  <link rel="stylesheet" href="../css/contact.css">

  <title>お問い合わせ内容の確認</title>
</head>


<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html'; ?>

  <section class="hero mb-5">
    <div class="image-section position-relative masked">
      <img src="../img/contact1.webp" class="d-block w-100" alt="Image 1">
      <div class="position-absolute top-50 start-50 translate-middle text-white">
        <div class="hero-fixed-text d-flex flex-column align-items-center justify-content-center">
          <h3>Contact</h3>
          <h2>お問い合わせ</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5 py-5">
    <div class="container">
      <div class="mb-4">
        <div class="mb-5 d-flex flex-column align-items-center">
          <div class="section-header col-lg-6">
            <h2>お問合せ</h2>
            <h6>― Contact ―</h6>
          </div>
        </div>

    <form action="sendmail.php" method="post">

        <div class="mb-4">
          <h5>お名前</h5>
          <h4><?php echo htmlspecialchars($name); ?></h4>
        </div>

        <div class="mb-4">
          <h5>お名前（フリガナ）</h5>
          <h4><?php echo htmlspecialchars($kana); ?></h4>
        </div>

        <div class="mb-4">
          <h5>会社名</h5>
          <h4><?php echo htmlspecialchars($companyName); ?></h4>
        </div>

        <div class="mb-4">
          <h5>メールアドレス</h5>
          <h4><?php echo htmlspecialchars($email); ?></h4>
        </div>

        <div class="mb-4">
          <h5>お問い合わせ内容</h5>
          <h4><?php echo nl2br(htmlspecialchars($inquiry)); ?></h4>
        </div>

        <div class="d-flex justify-content-center">
          <a href="../contact/" class="btn btn-secondary me-3">修正する</a>
            <button type="submit" class="btn btn-primary">送信する</button>
        </div>
    </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>