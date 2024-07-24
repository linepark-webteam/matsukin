<?php
session_start();

// CSRFトークンの検証
if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    // CSRFトークンが一致しない場合、リダイレクト
    header('Location: ../contact/'); // contactページのindex.php（可能であれば適切なエラーページ）にリダイレクト
    exit;
}

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer//src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer//src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// セッションデータの確認
if (empty($_SESSION['name']) || empty($_SESSION['email'])) {
    header('Location: ../contact/');
    exit;
}

// セッションからデータを取得
$name = $_SESSION['name'] ?? '';
$kana = $_SESSION['kana'] ?? '';
$companyName = $_SESSION['companyName'] ?? '';
$email = $_SESSION['email'] ?? '';
$inquiry = $_SESSION['inquiry'] ?? '';

// PHPMailerを使用してメールを送信
$mail = new PHPMailer(true);

try {
    // PHPMailerの設定
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('ko.nagai.0801@gmail.com', '東北松金工業株式会社');
    $mail->addAddress($email, $name);
    $mail->isHTML(true); // HTML形式のメール
    $mail->Subject = '【東北松金工業株式会社】お問い合わせありがとうございます';

    // メール本文の設定
    $mail->Body = "以下の内容でお問い合わせを受け付けました。<br><br>" .
        "お名前：" . htmlspecialchars($name) . "<br>" .
        "お名前（フリガナ）：" . htmlspecialchars($kana) . "<br>" .
        "会社名：" . htmlspecialchars($companyName) . "<br>" .
        "メールアドレス：" . htmlspecialchars($email) . "<br>" .
        "お問い合わせ内容：<br>" . nl2br(htmlspecialchars($inquiry)).
        "<br><br>このメールはシステムからの自動送信です。ご返信いただいてもお答えできかねますので、ご了承ください。";

    $mail->send();

    // 送信元メールアドレスと名前を設定
    $mail->setFrom('ko.nagai.0801@gmail.com', 'HP問い合わせフォーム');
    // 指定したアドレスに送るメール
    $mail->clearAddresses();
    $mail->addAddress('ko.nagai.0801@gmail.com', '管理者');
    // $mail->addAddress('＊＊＊＊＊', '管理者');
    $mail->Subject = 'HPよりお問い合わせを受け付けました';
    $mail->Body = "新しいお問い合わせがあります。<br><br>" .
        "お名前：" . htmlspecialchars($name) . "<br>" .
        "お名前（フリガナ）：" . htmlspecialchars($kana) . "<br>" .
        "会社名：" . htmlspecialchars($companyName) . "<br>" .
        "メールアドレス：" . htmlspecialchars($email) . "<br>" .
        "お問い合わせ内容：<br>" . nl2br(htmlspecialchars($inquiry)).
        "<br><br>このメールはシステムからの自動送信です。このメールに直接返信はせず、上記「メールアドレス：」記載のアドレス宛に返信してください。";

    $mail->send();

    // セッションの破棄
    session_unset();
    session_destroy();

    // 完了ページやメッセージにリダイレクト
    header('Location: thanks.php');
    exit;
} catch (Exception $e) {
    echo "メッセージは送信できませんでした。Mailer Error: {$mail->ErrorInfo}";
}
