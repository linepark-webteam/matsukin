<?php
session_start();

// CSRFトークンの生成と保存
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

$errors = [];
$name = $_SESSION['name'] ?? '';
$kana = $_SESSION['kana'] ?? '';
$companyName = $_SESSION['companyName'] ?? '';
$email = $_SESSION['email'] ?? '';
$confirmEmail = $_SESSION['confirmEmail'] ?? '';
$inquiry = $_SESSION['inquiry'] ?? '';
$privacyPolicy = $_SESSION['privacyPolicy'] ?? '';

// フォーム送信処理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // 各フィールドの値をセッションに保存
  $name = $_POST['name'] ?? '';
  $_SESSION['name'] = $name;
  $kana = $_POST['kana'] ?? '';
  $_SESSION['kana'] = $kana;
  $companyName = $_POST['companyName'] ?? '';
  $_SESSION['companyName'] = $companyName;
  $email = $_POST['email'] ?? '';
  $_SESSION['email'] = $email;
  $confirmEmail = $_POST['confirmEmail'] ?? '';
  $_SESSION['confirmEmail'] = $confirmEmail;
  $inquiry = $_POST['inquiry'] ?? '';
  $_SESSION['inquiry'] = $inquiry;
  $privacyPolicy = $_POST['privacyPolicy'] ?? '';
  $_SESSION['privacyPolicy'] = $privacyPolicy;

  // エラーがある場合に最初のエラーフィールドIDを保存
  $firstErrorField = '';

  // 各フィールドのエラーチェック
  if (empty($name)) {
    $errors['name'] = '<span class="text-danger fs-6">お名前は必須です。</span>';
    $firstErrorField = $firstErrorField ?: 'name';
  } elseif (strlen($name) > 32) {
    $errors['name'] = '<span class="text-danger fs-6">お名前は32文字以内で入力してください。</span>';
    $firstErrorField = $firstErrorField ?: 'name';
  }

  if (empty($kana)) {
    $errors['kana'] = '<span class="text-danger fs-6">お名前（フリガナ）は必須です。</span>';
    $firstErrorField = $firstErrorField ?: 'kana';
  } elseif (strlen($kana) > 32) {
    $errors['kana'] = '<span class="text-danger fs-6">お名前（フリガナ）は32文字以内で入力してください。</span>';
    $firstErrorField = $firstErrorField ?: 'kana';
  }

  if (strlen($companyName) > 64) {
    $errors['companyName'] = '<span class="text-danger fs-6">会社名は64文字以内で入力してください。</span>';
    $firstErrorField = $firstErrorField ?: 'companyName';
  }

  if (empty($email)) {
    $errors['email'] = '<span class="text-danger fs-6">メールアドレスは必須です。</span>';
    $firstErrorField = $firstErrorField ?: 'email';
  } elseif (strlen($email) > 64) {
    $errors['email'] = '<span class="text-danger fs-6">メールアドレスは64文字以内で入力してください。</span>';
    $firstErrorField = $firstErrorField ?: 'email';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = '<span class="text-danger fs-6">正しいメールアドレスを入力してください。</span>';
    $firstErrorField = $firstErrorField ?: 'email';
  }

  if ($email !== $confirmEmail) {
    $errors['confirmEmail'] = '<span class="text-danger fs-6">メールアドレスと確認用メールアドレスが一致しません。</span>';
    $firstErrorField = $firstErrorField ?: 'confirmEmail';
  }

  if (empty($inquiry)) {
    $errors['inquiry'] = '<span class="text-danger fs-6">お問い合わせ内容を入力してください。</span>';
    $firstErrorField = $firstErrorField ?: 'inquiry';
  } elseif (strlen($inquiry) > 1000) {
    $errors['inquiry'] = '<span class="text-danger fs-6">お問い合わせ内容は1000文字以内で入力してください。</span>';
    $firstErrorField = $firstErrorField ?: 'inquiry';
  }

  // プライバシーポリシーの同意確認
  if (isset($_POST['privacyPolicy']) && $_POST['privacyPolicy'] == 'accepted') {
    $_SESSION['privacyPolicy'] = 'accepted';
    $privacyPolicy = 'accepted';
  } else {
    $_SESSION['privacyPolicy'] = 'not_accepted';
    $privacyPolicy = 'not_accepted';
    $errors['privacyPolicy'] = '<span class="text-danger fs-6">個人情報保護方針への同意をお願いいたします。</span>';
    $firstErrorField = $firstErrorField ?: 'privacyPolicy';
  }

  // CSRFトークンの検証を追加
  if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    $errors['token'] = 'CSRF検証エラー。もう一度お試しください。';
  }


  // 最初のエラーが発生したフィールドにフォーカスするためのIDをセッションに保存
  if ($firstErrorField) {
    $_SESSION['errorField'] = $firstErrorField;
  }

  // エラーがなければ次のページへリダイレクト
  if (empty($errors)) {
    header('Location: confirm.php');
    unset($_SESSION['errorField']);  // エラーフィールドをセッションから削除
    exit;
  } else {
    $_SESSION['errorField'] = $firstErrorField;  // エラーがある場合のみセット
  }
}
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- ↓ BootStrapのスタイルを上書き -->
  <link rel="stylesheet" href="../css/mybootstrap.css">

  <link rel="stylesheet" href="../css/common.css">
  <!-- ↓ アニメーション用のスタイルシート -->
  <link rel="stylesheet" href="../css/animation.css">

  <link rel="stylesheet" href="../css/contact.css">

  <title>お問い合わせ</title>
</head>


<body>

  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html';
  ?>

  <section class="contact-container mx-md-5 mx-3 my-5 py-5">
    <div class="container">
      <div class="col-12">
        <h2 class="fs-3 fw-bold">お問い合わせ</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="section-header col-lg-12 my-5">
            <h2 class="fs-4 fw-bold">お問合せフォーム</h2>
            <p class="ms-lg-5 mt-3 fs-6 fw-bold">弊社に関するご質問、商品やサービスなどお気軽にお問い合わせください。</p>
          </div>

          <form action="" method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="hidden" id="errorField" value="<?php echo htmlspecialchars($_SESSION['errorField'] ?? ''); ?>">

            <!-- お名前 -->
            <div class="form-group d-lg-flex justify-content-center mt-3">
              <label for="name" class="col-lg-6 fs-4 fw-bold mb-2">お名前 <span class="text-danger fs-4 fw-bold">*</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="text" name="name" class="form-control d-block" id="name" placeholder="お名前を入力してください" maxlength="32" value="<?php echo htmlspecialchars($name); ?>">
                <span class="small">（32文字以内）</span>
                <?php if (!empty($errors['name'])) : ?>
                  <div class="error"><?php echo $errors['name']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- お名前（フリガナ） -->
            <div class="form-group d-lg-flex justify-content-center mt-3">
              <label for="kana" class="col-lg-6 fs-5 fw-bold mb-2">お名前（フリガナ）<span class="text-danger fs-3 fw-bold">*</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="text" name="kana" class="form-control d-block" id="kana" placeholder="フリガナを入力してください" maxlength="32" value="<?php echo htmlspecialchars($kana); ?>">
                <span class="small">（32文字以内）</span>
                <?php if (!empty($errors['kana'])) : ?>
                  <div class="error"><?php echo $errors['kana']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- 会社名 -->
            <div class="form-group d-lg-flex justify-content-center mt-3">
              <label for="companyName" class="col-lg-6 fs-4 fw-bold mb-2">会社名</label>
              <div class="d-flex flex-column col-lg-8">
                <input type="text" name="companyName" class="form-control d-block" id="companyName" placeholder="会社名を入力してください" maxlength="64" value="<?php echo htmlspecialchars($companyName); ?>">
                <span class="small">（64文字以内）</span>
                <?php if (!empty($errors['companyName'])) : ?>
                  <div class="error"><?php echo $errors['companyName']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- メールアドレス -->
            <div class="form-group d-lg-flex justify-content-center mt-3">
              <label for="email" class="col-lg-6 fs-4 fw-bold mb-2">メールアドレス<span class="text-danger fs-4 fw-bold">*</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="email" name="email" class="form-control d-block" id="email" placeholder="メールアドレスを入力してください" maxlength="64" value="<?php echo htmlspecialchars($email); ?>">
                <span class="small">（64文字以内）</span>
                <?php if (!empty($errors['email'])) : ?>
                  <div class="error"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- メールアドレス（確認用） -->
            <div class="form-group d-lg-flex justify-content-center mt-3">
              <label for="confirmEmail" class="col-lg-6 fs-6 fw-bold mb-2">メールアドレス（確認）<span class="text-danger fs-4 fw-bold">*</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="email" name="confirmEmail" class="form-control d-block" id="confirmEmail" placeholder="確認用メールアドレスを入力してください" maxlength="64" value="<?php echo htmlspecialchars($confirmEmail); ?>">
                <span class="small">（上記と同じメールアドレスを入力してください）</span>
                <?php if (!empty($errors['confirmEmail'])) : ?>
                  <div class="error"><?php echo $errors['confirmEmail']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- お問合せ内容 -->
            <div class="form-group d-lg-flex justify-content-center mt-3">
              <label for="inquiry" class="col-lg-6 fs-4 fw-bold mb-2">お問い合わせ内容<span class="text-danger fs-4 fw-bold">*</span></label>
              <div class="d-flex flex-column col-lg-8">
                <textarea name="inquiry" class="form-control" id="inquiry" rows="10" placeholder="お問い合わせ内容を入力してください" maxlength="1000"><?php echo htmlspecialchars($inquiry); ?></textarea>
                <span class="small">（1000文字以内）</span>
                <?php if (!empty($errors['inquiry'])) : ?>
                  <div class="error"><?php echo $errors['inquiry']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- 「個人情報保護方針」 -->
            <div class="form-group my-5">
              <div class="form-check d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center col-lg-12">
                  <div class="d-flex">
                    <input type="checkbox" name="privacyPolicy" class="form-check-input fs-6 fw-bold" id="privacyPolicy" value="accepted" <?php echo (!empty($_SESSION['privacyPolicy']) && $_SESSION['privacyPolicy'] == 'accepted' ? 'checked' : ''); ?>>
                    <label class="form-check-label fs-6 fw-bold" for="privacyPolicy">「個人情報保護方針」に同意の上、チェックを入れて送信してください。</label>
                  </div>
                  <?php if (!empty($errors['privacyPolicy'])) : ?>
                    <div class="error"><?php echo $errors['privacyPolicy']; ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- 送信ボタン -->
            <div class="row">
              <div class="d-flex justify-content-center col-12">
                <button type="submit" class="btn btn-outline-primary col-md-4 col-8 px-lg-3 px-1  py-3"><span class="fs-lg-6 fs-6 fw-bold">入力内容を確認する</span></button>
              </div>
            </div>
          </form>

        </div>
      </div>

  </section>


  <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

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