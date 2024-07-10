<?php
session_start();

$errors = [];
$inquiryType = $_SESSION['inquiryType'] ?? '';
$name = $_SESSION['name'] ?? '';
$companyName = $_SESSION['companyName'] ?? '';
$email = $_SESSION['email'] ?? '';
$confirmEmail = $_SESSION['confirmEmail'] ?? '';
$callbackPreference = $_SESSION['callbackPreference'] ?? '';
$inquiry = $_SESSION['inquiry'] ?? '';
$privacyPolicy = $_SESSION['privacyPolicy'] ?? '';

// フォームが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $inquiryType = $_POST['inquiryType'] ?? '';
  $_SESSION['inquiryType'] = $inquiryType;

  $name = $_POST['name'] ?? '';
  $_SESSION['name'] = $name;

  $companyName = $_POST['companyName'] ?? '';
  $_SESSION['companyName'] = $companyName;

  $email = $_POST['email'] ?? '';
  $_SESSION['email'] = $email;

  $confirmEmail = $_POST['confirmEmail'] ?? '';
  $_SESSION['confirmEmail'] = $confirmEmail;

  $callbackPreference = $_POST['callbackPreference'] ?? '';
  $_SESSION['callbackPreference'] = $callbackPreference;

  $inquiry = $_POST['inquiry'] ?? '';
  $_SESSION['inquiry'] = $inquiry;

  // 必須項目の入力・バリデーションチェック
  // お問い合わせ項目
  if (empty($inquiryType)) {
    $errors['inquiryType'] = 'お問い合わせ項目を選択してください。';
  }
  // お名前
  if (empty($name)) {
    $errors['name'] = 'お名前は必須です。';
  } elseif (strlen($name) > 32) {
    $errors['name'] = 'お名前は32文字以内で入力してください。';
  }

  // 会社名
  if (strlen($companyName) > 64) {
    $errors['companyName'] = '会社名は64文字以内で入力してください。';
  }

  // メールアドレス
  if (empty($email)) {
    $errors['email'] = 'メールアドレスは必須です。';
  } elseif (strlen($email) > 64) {
    $errors['email'] = 'メールアドレスは64文字以内で入力してください。';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = '正しいメールアドレスを入力してください。';
  }

  // 確認用メールアドレス
  if ($email !== $confirmEmail) {
    $errors['confirmEmail'] = 'メールアドレスと確認用メールアドレスが一致しません。';
  }

  // お問い合わせ項目
  if (empty($callbackPreference)) {
    $errors['callbackPreference'] = '担当者からの折り返し方法を選択してください。';
  }

  // お問い合わせ内容
  if (empty($inquiry)) {
    $errors['inquiry'] = 'お問い合わせ内容を入力してください。';
  } elseif (strlen($inquiry) > 1000) {
    $errors['inquiry'] = 'お問い合わせ内容は1000文字以内で入力してください。';
  }

  // 個人情報保護方針への同意
  if (isset($_POST['privacyPolicy'])) {
    $_SESSION['privacyPolicy'] = $_POST['privacyPolicy'];
    $privacyPolicy = $_POST['privacyPolicy'];
  } else {
    $_SESSION['privacyPolicy'] = '';
    $privacyPolicy = '';
  }

  // 個人情報保護方針への同意のエラーチェック
  if (empty($privacyPolicy)) {
    $errors['privacyPolicy'] = '個人情報保護方針への同意をお願いいたします。';
  }


  // エラーがなければconfirm.phpへリダイレクト
  if (empty($errors)) {
    header('Location: confirm.php');
    exit;
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

  <!-- Zen Kaku Gothic New Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">

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

  <title>東北松金工業株式会社</title>
</head>


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
      <div class="mb-3">
        <div class="mb-5 d-flex flex-column align-items-center">
          <div class="section-header col-lg-6">
            <h2>お問合せ</h2>
            <h6>― Contact ―</h6>
          </div>
        </div>
        <div class="container row">
          <form action="" method="post">
            <!-- お問合わせ項目 -->
            <div class="form-group col-12 d-lg-flex">
              <label for="inquiryType" class="col-lg-3 mb-2 me-5">お問合わせ項目 <span class="badge text-bg-success">必須</span></label>
              <div class="d-flex flex-column col-lg-8">
                <div class="d-lg-flex col-lg-9">
                  <div class="form-check form-check-block align-items-center col-lg-4">
                    <input class="form-check-input" type="radio" name="inquiryType" id="corporate" value="法人のお客様" <?php echo ($inquiryType === '法人のお客様') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="corporate">法人のお客様</label>
                  </div>
                  <div class="form-check form-check-block align-items-center col-lg-4">
                    <input class="form-check-input" type="radio" name="inquiryType" id="individual" value="個人のお客様" <?php echo ($inquiryType === '個人のお客様') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="individual">個人のお客様</label>
                  </div>
                  <div class="form-check form-check-block align-items-center col-lg-4">
                    <input class="form-check-input" type="radio" name="inquiryType" id="other" value="その他" <?php echo ($inquiryType === 'その他') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="other">その他</label>
                  </div>
                </div>
                <?php if (!empty($errors['inquiryType'])) : ?>
                  <div class="error"><?php echo $errors['inquiryType']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- お名前 -->
            <div class="form-group d-lg-flex mt-3">
              <label for="name" class="col-lg-3 mb-2 me-5">お名前 <span class="badge text-bg-success">必須</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="text" name="name" class="form-control d-block" id="name" placeholder="お名前を入力してください" maxlength="32" value="<?php echo htmlspecialchars($name); ?>">
                <span class="small">（32文字以内）</span>
                <?php if (!empty($errors['name'])) : ?>
                  <div class="error"><?php echo $errors['name']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- 会社名 -->
            <div class="form-group d-lg-flex mt-3">
              <label for="companyName" class="col-lg-3 mb-2 me-5">会社名 <span class="badge text-bg-secondary">任意</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="text" name="companyName" class="form-control d-block" id="companyName" placeholder="会社名を入力してください" maxlength="64" value="<?php echo htmlspecialchars($companyName); ?>">
                <span class="small">（64文字以内）</span>
                <?php if (!empty($errors['companyName'])) : ?>
                  <div class="error"><?php echo $errors['companyName']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- メールアドレス -->
            <div class="form-group d-lg-flex mt-3">
              <label for="email" class="col-lg-3 mb-2 me-5">メールアドレス <span class="badge text-bg-success">必須</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="email" name="email" class="form-control d-block" id="email" placeholder="メールアドレスを入力してください" maxlength="64" value="<?php echo htmlspecialchars($email); ?>">
                <span class="small">（64文字以内）</span>
                <?php if (!empty($errors['email'])) : ?>
                  <div class="error"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- メールアドレス（確認用） -->
            <div class="form-group d-lg-flex mt-3">
              <label for="confirmEmail" class="col-lg-3 mb-2 me-5">メールアドレス（確認用） <span class="badge text-bg-success">必須</span></label>
              <div class="d-flex flex-column col-lg-8">
                <input type="email" name="confirmEmail" class="form-control d-block" id="confirmEmail" placeholder="確認用メールアドレスを入力してください" maxlength="64" value="<?php echo htmlspecialchars($confirmEmail); ?>">
                <span class="small">（上記と同じメールアドレスを入力してください）</span>
                <?php if (!empty($errors['confirmEmail'])) : ?>
                  <div class="error"><?php echo $errors['confirmEmail']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- 担当者からの折り返し方法 -->
            <div class="form-group d-lg-flex mt-3">
              <label class="col-lg-3 mb-2 me-5">担当者からの折り返し方法 <span class="badge text-bg-success">必須</span></label>
              <div class="d-flex flex-column col-lg-8">
                <div class="col-lg-9">
                  <div class="form-check align-items-center form-check-block">
                    <input class="form-check-input" type="radio" name="callbackPreference" id="contactByEmail" value="メールでの連絡希望" <?php echo ($callbackPreference === 'メールでの連絡希望') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="contactByEmail">メールでの連絡希望</label>
                  </div>
                  <div class="form-check align-items-center form-check-block">
                    <input class="form-check-input" type="radio" name="callbackPreference" id="contactByPhone" value="電話での連絡希望" <?php echo ($callbackPreference === '電話での連絡希望') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="contactByPhone">電話での連絡希望</label>
                  </div>
                </div>
                <?php if (!empty($errors['callbackPreference'])) : ?>
                  <div class="error"><?php echo $errors['callbackPreference']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <!-- お問合せ内容 -->
            <div class="form-group d-lg-flex mt-3">
              <label for="inquiry" class="col-lg-3 mb-2 me-5">お問合せ内容 <span class="badge text-bg-success">必須</span></label>
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
                <div class="d-flex flex-column align-items-center col-lg-8">
                  <div class="d-flex">
                    <input type="checkbox" name="privacyPolicy" class="form-check-input" id="privacyPolicy" value="accepted" <?php echo (!empty($privacyPolicy) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="privacyPolicy">「<a href="../privacy-policy/">個人情報保護方針</a>」に同意の上、チェックを入れて送信してください。</label>
                  </div>
                  <?php if (!empty($errors['privacyPolicy'])) : ?>
                    <div class="error"><?php echo $errors['privacyPolicy']; ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- 送信ボタン -->
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-outline-success col-4">確認ページへ</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </section>


  <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</body>

</html>