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

  <title>お問い合わせ受付完了</title>
</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html'; ?>

  <section class="contents-container mx-md-5 mx-3 my-5 py-5">
    <div class="container">
      <div class="col-12">
        <h2 class="fs-3 fw-bold">お問い合わせ受付完了</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="section-header col-lg-12 my-5">
            <h2 class="fs-4 fw-bold">お問い合わせありがとうございます！</h2>
            <!-- <p class="ms-lg-5 mt-3 fs-6 fw-bold">お問い合わせありがとうございます。</p> -->
          </div>
          <div>
            <div class="d-flex flex-column align-items-center">
              <p>お問い合わせを受け付けました。担当者が確認の後、ご連絡いたします。返信がない場合は、恐れ入りますが再度ご連絡をお願いいたします。</p>
              <p>また、自動返信メールを送信しておりますので、ご確認ください。もしメールが届かない場合は、迷惑メールフォルダをご確認いただくか、入力いただいたメールアドレスが正しいかご確認ください。</p>
            </div>
          </div>
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
  <!-- MyScript -->
  <script src="../js/contact.js"></script>
</body>

</html>