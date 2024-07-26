// ページタイトルのすぐ下のSVGの位置を動的に調整
$(document).ready(function() {
  function adjustSvg() {
    const screenWidth = $(window).width();
    const h2Height = $('.fs-3.fw-bold').outerHeight();
    let additionalOffset;
    let scaleValue;

    // スクリーン幅に応じて位置とスケールを調整
    if (screenWidth < 375) {
      additionalOffset = -10;
      scaleValue = 1.5; // 最小サイズのデバイス用のスケール
    } else if (screenWidth < 430) {
      additionalOffset = -10;
      scaleValue = 1.3; // 小さいデバイス用のスケール
    } else if (screenWidth < 576) {
      additionalOffset = -10;
      scaleValue = 1.4; // さらに大きいデバイス用のスケール
    } else if (screenWidth < 768) {
      additionalOffset = -10;
      scaleValue = 1.1; // 中間サイズのデバイス用のスケール
    } else if (screenWidth < 992) {
      additionalOffset = 0;
      scaleValue = 1.3; // 大きいデバイス用のスケール
    } else if (screenWidth < 1200) {
      additionalOffset = 5;
      scaleValue = 1.3; // より大きいデバイス用のスケール
    } else if (screenWidth < 1400) {
      additionalOffset = 15;
      scaleValue = 1.05; // さらに大きいデバイス用のスケール
    } else {
      additionalOffset = 18;
      scaleValue = 1.1; // 最も大きいデバイス用のスケール
    }

    // CSSプロパティを動的に設定
    $('.svg-container').css({
      'top': -(h2Height + additionalOffset) + 'px',
      'transform': `scale(${scaleValue})`
    });
  }

  // 初期ロード時とウィンドウサイズ変更時に位置とスケールを調整
  adjustSvg();
  $(window).resize(adjustSvg);
});

//
// 上記のSVGを徐々に描画するアニメーション
$(document).ready(function() {
  // SVG全体のアニメーションをVivusで初期化
  const svgAnimation = new Vivus('borderHouse', {
    duration: 200,
    start: 'manual',
    type: 'oneByOne',
    animTimingFunction: Vivus.EASE
  });

  // Vivusアニメーションの再生
  svgAnimation.play();

  // delayedPathのアニメーションをAnime.jsで遅延して開始
  setTimeout(() => {
    // Anime.jsを使って、delayedPathのstrokeDashoffsetをアニメーションする
    anime({
      targets: '#delayedPath',
      strokeDashoffset: [anime.setDashoffset, 0], // 初期状態から0までアニメーション
      easing: 'easeInOutSine',  // イージング関数
      duration: 1500,  // アニメーションの持続時間
      begin: function(anim) {
        // アニメーション開始時に透明度を1に設定
        document.getElementById('delayedPath').style.opacity = 1;
      }
    });
  }, 2000); // 2秒後に遅延アニメーションを実行
});

