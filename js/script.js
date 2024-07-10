console.log("test");


// TOP HERO SVGアニメーション
new Vivus('house', {
  duration: 500,
  type: 'async',
  animTimingFunction: Vivus.EASE
}, function (obj) {
  obj.el.classList.add('finished'); // アニメーション完了を示すクラスを追加
  document.querySelectorAll('#house path').forEach(function(path) {
      path.style.fill = '#C6AF28'; // アニメーション終了後にfillを適用
  });
});


window.onload = function () {
  // プリローダーアニメーション非表示（存在する場合）
  let preloader = document.getElementById("preloader");
  if (preloader) {
    preloader.style.display = "none";
  }

  // スクロールイベントリスナーを追加
  window.addEventListener("scroll", function () {
    // ヘッダーの透過処理
    const header = document.querySelector("header.fixed-top");
    // ページの上部から300px以内であれば透過させ、それ以外では透過を解除
    if (window.scrollY <= 300) {
      header.classList.add("transparent");
      header.classList.remove("scrolled");
    } else {
      header.classList.remove("transparent");
      header.classList.add("scrolled");
    }

    // フェードインアニメーション関連の処理
    const fadeInElements = document.querySelectorAll(
      ".fade-in-content:not(.visible)"
    );
    fadeInElements.forEach((element) => {
      const elementTop = element.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;
      if (elementTop < windowHeight - 100) {
        // 少し早めにアニメーションが始まるように調整
        element.classList.add("visible");
      }
    });
  });

// Swipper ライブラリの為のScript
const swiper = new Swiper('.swiper-container', {
  loop: true,
  spaceBetween: 10,
  speed: 5000,
  autoplay: {
      delay: 1,
      disableOnInteraction: false,
      // reverseDirection: true,
  },
  allowTouchMove: false,
  breakpoints: {
      320: {
          slidesPerView: 3,
      },
      480: {
          slidesPerView: 3,
      },
      768: {
          slidesPerView: 5,
      },
      1024: {
          slidesPerView: 5,
      },
      1200: {
          slidesPerView: 5,
      }
  }
});

  // スライドショーの初期化と設定
  // const slides = document.querySelectorAll(".slide");
  // let index = 0;

  // function changeSlide() {
  //   slides.forEach((slide) => slide.classList.remove("active"));
    // すべてのスライドから 'active' クラスを削除
    // slides[index].classList.add("active"); // 現在のスライドに 'active' クラスを追加
    // index = (index + 1) % slides.length;
    // 次のスライドのインデックスを計算
  }

  // 5秒ごとにスライドを切り替え
//   setInterval(changeSlide, 5000);
// };
