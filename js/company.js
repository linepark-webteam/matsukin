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


//
// 上記のSVGを徐々に描画するアニメーション

// SVG全体のアニメーション
$(window).on('load', function() {
  // ここでSVGアニメーションの設定
  new Vivus('borderHouse', {
    duration: 200,
    type: 'oneByOne',
    animTimingFunction: Vivus.EASE
  });

  adjustSvg();
  $(window).resize(adjustSvg);
});

document.addEventListener("DOMContentLoaded", () => {
  animateText();
});
// テキストを一文字ずつ表示するアニメーション
function splitTextIntoSpans(element) {
  const text = element.textContent;
  element.innerHTML = "";
  text.split("").forEach((char) => {
    const span = document.createElement("span");
    span.textContent = char === " " ? "\u00A0" : char;
    span.classList.add("letter");
    element.appendChild(span);
  });
}

function animateText() {
  const textElements = document.querySelectorAll(".animate-text");
  textElements.forEach((element, index) => {
    splitTextIntoSpans(element);
    anime.timeline({ loop: false }).add({
      targets: element.querySelectorAll(".letter"),
      opacity: [0, 1],
      easing: "easeInOutQuad",
      duration: 750,
      delay: (el, i) => 50 * (i + 1),
      offset: index * 1000,
    });
  });
}

});
