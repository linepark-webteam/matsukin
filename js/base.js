$(document).ready(function() {
  function adjustSvg() {
    const screenWidth = $(window).width();
    const h2Height = $('.fs-3.fw-bold').outerHeight();
    let additionalOffset;
    let scaleValue;

    // スクリーン幅に応じて位置とスケールを調整
    if (screenWidth < 375) {
      additionalOffset = -10;
      scaleValue = 1.5;
    } else if (screenWidth < 430) {
      additionalOffset = -10;
      scaleValue = 1.3;
    } else if (screenWidth < 576) {
      additionalOffset = -10;
      scaleValue = 1.4;
    } else if (screenWidth < 768) {
      additionalOffset = -10;
      scaleValue = 1.1;
    } else if (screenWidth < 992) {
      additionalOffset = 0;
      scaleValue = 1.3;
    } else if (screenWidth < 1200) {
      additionalOffset = 5;
      scaleValue = 1.3;
    } else if (screenWidth < 1400) {
      additionalOffset = 15;
      scaleValue = 1.05;
    } else {
      additionalOffset = 18;
      scaleValue = 1.1;
    }

    // CSSプロパティを動的に設定
    $('.svg-container').css({
      'top': -(h2Height + additionalOffset) + 'px',
      'transform': `scale(${scaleValue})`
    });
  }

  // SVGアニメーション
  function initSvgAnimation() {
    new Vivus('borderHouse', {
      duration: 200,
      type: 'oneByOne',
      animTimingFunction: Vivus.EASE
    });
  }

  // テキストアニメーション
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

  // ヘッダーの透過・不透過トグル
  function updateHeaderTransparency() {
    const header = $('header.fixed-top');
    if ($(window).scrollTop() > 50) {
      header.removeClass('transparent').addClass('opaque');
    } else {
      header.addClass('transparent').removeClass('opaque');
    }
  }

  // 初期化と各種イベントリスナーの設定
  adjustSvg();
  initSvgAnimation();
  animateText();
  updateHeaderTransparency();

  $(window).on('resize', adjustSvg);
  $(window).on('scroll', updateHeaderTransparency);
});