<?php
session_start();

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
$inquiryType = $_SESSION['inquiryType'] ?? '';
$name = $_SESSION['name'] ?? '';
$companyName = $_SESSION['companyName'] ?? '';
$email = $_SESSION['email'] ?? '';
$callbackPreference = $_SESSION['callbackPreference'] ?? '';
$inquiry = $_SESSION['inquiry'] ?? '';

// PHPMailerを使用してメールを送信
$mail = new PHPMailer(true);

try {
    // PHPMailerの設定
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('noreply@midori-hoken.com', '株式会社みどり総合保険事務所');
    $mail->addAddress($email, $name);
    $mail->isHTML(true); // HTML形式のメール
    $mail->Subject = 'お問い合わせありがとうございます';

    // メール本文の設定
    $mail->Body = "以下の内容でお問い合わせを受け付けました。<br><br>" .
        "お問い合わせ項目：" . htmlspecialchars($inquiryType) . "<br>" .
        "お名前：" . htmlspecialchars($name) . "<br>" .
        "会社名：" . htmlspecialchars($companyName) . "<br>" .
        "メールアドレス：" . htmlspecialchars($email) . "<br>" .
        "担当者からの折り返し方法：" . htmlspecialchars($callbackPreference) . "<br>" .
        "お問い合わせ内容：<br>" . nl2br(htmlspecialchars($inquiry));

    $mail->send();

    // 送信元メールアドレスと名前を設定
    $mail->setFrom('info@midori-hoken.com', 'HP問い合わせフォーム');
    // 指定したアドレスに送るメール
    $mail->clearAddresses();
    $mail->addAddress('ko.nagai.0801@gmail.com', '管理者');
    $mail->addAddress('l77mmidori@nifty.com', '管理者');
    $mail->Subject = '新しいお問い合わせがあります';
    $mail->Body = "新しいお問い合わせがあります。<br><br>" .
        "お問い合わせ項目：" . htmlspecialchars($inquiryType) . "<br>" .
        "お名前：" . htmlspecialchars($name) . "<br>" .
        "会社名：" . htmlspecialchars($companyName) . "<br>" .
        "メールアドレス：" . htmlspecialchars($email) . "<br>" .
        "担当者からの折り返し方法：" . htmlspecialchars($callbackPreference) . "<br>" .
        "お問い合わせ内容：<br>" . nl2br(htmlspecialchars($inquiry));

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
