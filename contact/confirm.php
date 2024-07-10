<?php
session_start();

// セッション変数が設定されていないか確認（直接アクセスをチェック）
if (empty($_SESSION['name']) || empty($_SESSION['email'])) {
  // セッション変数が設定されていない場合は、./contact/ へリダイレクト
  header('Location: ../contact/');
  exit;
}

// セッションからデータを取得
$inquiryType = $_SESSION['inquiryType'] ?? '';
$name = $_SESSION['name'] ?? '';
$companyName = $_SESSION['companyName'] ?? '';
$email = $_SESSION['email'] ?? '';
$confirmEmail = $_SESSION['confirmEmail'] ?? '';
$callbackPreference = $_SESSION['callbackPreference'] ?? '';
$inquiry = $_SESSION['inquiry'] ?? '';
$privacyPolicy = $_SESSION['privacyPolicy'] ?? '';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<meta name="keywords" content="みどり保険, 相模原, 保険, 濱島一志, 神奈川">
  <title>お問い合わせ｜株式会社みどり総合保険事務所</title>
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-K07XZCD6JK"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-K07XZCD6JK');
</script>

<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

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
          <h5>お問い合わせ項目</h5>
          <h4><?php echo htmlspecialchars($inquiryType); ?></h4>
        </div>

        <div class="mb-4">
          <h5>お名前</h5>
          <h4><?php echo htmlspecialchars($name); ?></h4>
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
          <h5>担当者からの折り返し方法</h5>
          <h4><?php echo htmlspecialchars($callbackPreference); ?></h4>
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