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

// var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon -->
  <link rel="icon" href="../img/favicon-16x16.png" type="image/png" sizes="16x16">
  <link rel="icon" href="../img/favicon-32x32.png" type="image/png" sizes="32x32">
  <link rel="icon" href="../img/favicon-32x32.png" type="image/png" sizes="48x48">
  <!-- AppleIcon -->
  <link rel="apple-touch-icon" href="../img/apple-touch-icon.png" sizes="180x180">

  <!-- Shippori Antique B1 & Zen Kaku Gothic New Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">

  <!-- ↓ リセットCSS -->
  <link rel="stylesheet" href="../css/ress.min.css">

  <!-- ↓ BootStrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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

  <section class="contents-container mx-md-5 mx-3 my-5 py-5">
    <div class="container">
      <div class="col-12">
        <h2 class="page-heading fs-3 fw-bold">お問い合わせ内容の確認</h2>
        <div class="svg-container">
          <svg version="1.1" id="borderHouse" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1024 100" style="enable-background: new 0 0 1024 100" xml:space="preserve">
            <style type="text/css">
              .st0 {
                fill: none;
                stroke: #c6af28;
                stroke-width: 2;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
              }
            </style>
            <g>
              <path id="delayedPath" class="st0" d="M828.04,45.32c2.22-1.02,4.67-0.89,7.04-0.74c2.04,0.12,4.08,0.25,6.12,0.37c0.16,0.01,0.34,0.03,0.45,0.16
                    c0.13,0.15,0.13,0.39,0.13,0.6c-0.04,6.76-0.07,13.52-0.11,20.28c0,0.38-0.03,0.82-0.28,1.06c-0.19,0.18-0.46,0.19-0.71,0.19
                    c-3.7-0.05-7.4-0.1-11.1-0.15c-0.21,0-0.43-0.01-0.6-0.16c-0.21-0.18-0.28-0.52-0.33-0.83c-1.11-6.89-1.29-13.99-0.55-20.96" />
              <path id="normalPath" class="st0" d="M15.73,64.66c394-1,539.33,5.15,602-9c62-14,115-9.82,145.69,0.47c22.25,7.46,24.56-0.29,24.56-0.29
                    c2.14-9,0.84-4.93,2.98-13.93c0.22-0.94,0.47-1.93,1.06-2.61c0.86-0.99,2.19-1.03,3.38-1.01c6.78,0.11,13.55,0.22,20.33,0.33
                    c0.63,0.01,1.34-0.03,1.74-0.61c0.3-0.43,0.32-1.04,0.33-1.61c0.02-1.72,0.05-3.45,0.07-5.17c-1.47-0.4-2.93-0.8-4.4-1.2
                    c6.05-5.09,12.72-9.11,19.74-11.9c0.64-0.25,1.3-0.5,1.97-0.48c0.8,0.02,1.55,0.42,2.29,0.81c6.41,3.41,12.82,6.81,19.24,10.22
                    c-0.31,2.33-3.78,1.15-4.94,3.05c-0.39,0.63-0.42,1.48-0.43,2.26c-0.18,11.25-0.37,22.51-0.55,33.76c0.65-0.10,3.31-0.19,3.96-0.29
                    c1.58-4.11,2.64-8.51,3.14-13c-1.51,2.12-2.04,5.19-1.34,7.85c1.81,0.20,3.37-1.80,3.76-3.93s-0.09-4.34-0.57-6.44
                    c-0.23-1.03-0.71-2.28-1.59-2.23c-0.56,0.03-0.98,0.61-1.31,1.15c-2.07,3.44-3.35,7.88-2.4,11.97s4.68,7.33,8.05,6.06
                    c1.80-4.26,3.04-8.86,3.67-13.58c-2.07,1.69-2.6,5.55-1.09,7.95c3.81-1.43,5.64-7.72,3.41-11.69c-0.85-1.52-2.58-2.68-3.88-1.71
                    c-0.52,0.39-0.85,1.04-1.17,1.67c-1.22,2.42-2.48,5.04-2.37,7.86c0.12,3.26,2,5.98,3.79,8.43c0.39,0.53,0.86,1.11,1.45,1.06
                    c0.40-0.03,2.07-0.05,2.44-0.23c0.99-0.48,2,0,5-1c4.24-1.41,26-15,44.34-11.8c57.06,9.94,64.66,24.8,82.66,23.8" />
            </g>
          </svg>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="section-header col-lg-12 mb-5">
            <h2 class="fs-4 fw-bold">お問い合せ内容の確認</h2>
            <p class="ms-lg-5 mt-3 fs-6 fw-bold">お問い合わせ内容をご確認の上、「送信する」ボタンを押してください。</p>
          </div>

          <form action="sendmail.php" method="post">
          <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']); ?>">

            <div class="mb-4">
              <h3 class="fs-4">お名前</h3>
              <h4 class="session-data fs-5"><?php echo htmlspecialchars($name); ?></h4>
            </div>

            <div class="mb-4">
              <h3 class="fs-4">お名前（フリガナ）</h3>
              <h4 class="session-data fs-5"><?php echo htmlspecialchars($kana); ?></h4>
            </div>

            <div class="mb-4">
              <h3 class="fs-4">会社名</h3>
              <h4 class="session-data fs-5"><?php echo htmlspecialchars($companyName); ?></h4>
            </div>

            <div class="mb-4">
              <h3 class="fs-4">メールアドレス</h3>
              <h4 class="session-data fs-5"><?php echo htmlspecialchars($email); ?></h4>
            </div>

            <div class="mb-4">
              <h3 class="fs-4">お問い合わせ内容</h3>
              <h4 class="session-data fs-5"><?php echo nl2br(htmlspecialchars($inquiry)); ?></h4>
            </div>

            <div class="d-flex justify-content-center">
              <a href="../contact/" class="btn btn-secondary me-3">修正する</a>
              <button type="submit" class="btn btn-primary">送信する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.html'; ?>

  <!-- Bootstrap 5 JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/e7eaec89a2.js" crossorigin="anonymous"></script>
  <!-- Swipper ライブラリ CDN -->
  <!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
  <!-- Vivus(SVG Animation)ライブラリ CDN -->
  <script src="https://cdn.jsdelivr.net/npm/vivus/dist/vivus.min.js"></script>
  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- MyScript -->
  <script src="../js/contact.js"></script>
</body>

</html>