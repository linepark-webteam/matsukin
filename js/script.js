console.log("test");

// TOP HERO SVGアニメーション
console.log("test");

// Vivusの描画と同時にAnime.jsのアニメーションを開始
function startVivusAnimation() {
  // Vivusインスタンスを作成
  new Vivus("house", {
    duration: 200,
    type: "async",
    animTimingFunction: Vivus.EASE,
    start: "inViewport", // ページに入った時にアニメーションを開始
    onReady: function (obj) {
      // 描画開始時にAnime.jsのアニメーションを開始
      anime({
        targets: "#house path",
        translateX: function () {
          return anime.random(-10, 10) + "px";
        },
        translateY: function () {
          return anime.random(-10, 10) + "px";
        },
        easing: "linear",
        duration: 1000,
        direction: "alternate",
        loop: true,
      });
    },
    onEnd: function (obj) {
      obj.el.classList.add("finished"); // アニメーション完了を示すクラスを追加
    },
  });
}

document.addEventListener("DOMContentLoaded", startVivusAnimation);

// TOPページ SVG背景アニメーション
// 初期設定
let duration = window.innerWidth < 992 ? 10 : 200;

// Vivusインスタンスを作成
let vivus = new Vivus("my-svg", {
  type: "delayed",
  duration: duration,
  start: "auto", // アニメーションを開始（手動か自動か）
  dashGap: 20,
});

// Anime.jsのアニメーション設定
let animeInstance = anime({
  targets: "#my-svg path",
  translateX: function () {
    return anime.random(-5, 5) + "px";
  },
  translateY: function () {
    return anime.random(-5, 5) + "px";
  },
  easing: "easeInOutSine",
  duration: 1000,
  direction: "alternate",
  loop: true,
  autoplay: true, // 自動再生オン
});

// スクロールイベントに基づいて描画を制御
document.addEventListener("scroll", function () {
  let scrollPosition = window.scrollY;
  let documentHeight =
    document.documentElement.scrollHeight - window.innerHeight;
  let progress = scrollPosition / documentHeight;

  // Vivusの進行状況を設定
  vivus.setFrameProgress(progress);

  // Anime.jsのアニメーションを再生
  animeInstance.play();
});

// ウィンドウサイズ変更時のリスナーを追加して、必要に応じて再設定
window.addEventListener("resize", function () {
  let newDuration = window.innerWidth < 992 ? 10 : 200;
  if (newDuration !== duration) {
    duration = newDuration;
    // Vivusインスタンスを再作成して設定を更新
    vivus = new Vivus("my-svg", {
      type: "delayed",
      duration: duration,
      start: "manual", // 手動でアニメーションを開始
      dashGap: 20,
    });

    // スクロールイベントに基づいて描画を制御
    document.addEventListener("scroll", function () {
      let scrollPosition = window.scrollY;
      let documentHeight =
        document.documentElement.scrollHeight - window.innerHeight;
      let progress = scrollPosition / documentHeight;

      // Vivusの進行状況を設定
      vivus.setFrameProgress(progress);

      // Anime.jsのアニメーションを再生
      animeInstance.play();
    });
  }
});

// テキストを一文字ずつ表示するアニメーション
// テキストを一文字ずつ分割してspanタグで囲む
function splitTextIntoSpans(element) {
  const text = element.textContent;
  element.innerHTML = '';
  text.split('').forEach((char) => {
    const span = document.createElement('span');
    span.textContent = char === ' ' ? '\u00A0' : char; // 半角スペースを &nbsp; に置き換える
    span.classList.add('letter');
    element.appendChild(span);
  });
}

// アニメーションを適用する
function animateText() {
  const textElements = document.querySelectorAll('.animate-text');

  textElements.forEach((element, index) => {
    splitTextIntoSpans(element);

    anime.timeline({loop: false})
      .add({
        targets: element.querySelectorAll('.letter'),
        opacity: [0, 1],
        easing: 'easeInOutQuad',
        duration: 750,
        delay: (el, i) => 50 * (i + 1),
        offset: index * 1000 // 各要素のアニメーションの開始をずらす
      });
  });
}

// ページが読み込まれたときにアニメーションを開始
document.addEventListener('DOMContentLoaded', animateText);


// プリローダーアニメーション
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
        element.classList.add("visible");
      }
    });
  });

  // Swipperライブラリ(スライドアニメーション)の為のScript
  const swiper1 = new Swiper(".swiper-container.top", {
    loop: true,
    spaceBetween: 50,
    speed: 5000,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    allowTouchMove: true,
    breakpoints: {
      320: {
        slidesPerView: 2.5,
      },
      480: {
        slidesPerView: 2.5,
      },
      600: {
        slidesPerView: 3.5,
      },
      768: {
        slidesPerView: 3.5,
      },
      1024: {
        slidesPerView: 4,
      },
      1200: {
        slidesPerView: 5,
      },
    },
  });

  const swiper2 = new Swiper(".swiper-container.products", {
    loop: true,
    spaceBetween: 25,
    speed: 5000,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    allowTouchMove: true,
    breakpoints: {
      320: {
        slidesPerView: 1.5,
      },
      480: {
        slidesPerView: 2,
      },
      600: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 3.5,
      },
      1024: {
        slidesPerView: 3.5,
      },
      1200: {
        slidesPerView: 4.5,
      },
    },
  });
  const swiper3 = new Swiper(".swiper-container.works", {
    loop: true,
    spaceBetween: 25,
    speed: 5000,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    allowTouchMove: true,
    breakpoints: {
      320: {
        slidesPerView: 1.5,
      },
      480: {
        slidesPerView: 2,
      },
      600: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 3.5,
      },
      1024: {
        slidesPerView: 3.5,
      },
      1200: {
        slidesPerView: 4.5,
      },
    },
  });
};

// スライドショーの初期化と設定
// const slides = document.querySelectorAll(".slide");
// let index = 0;

// function changeSlide() {
//   slides.forEach((slide) => slide.classList.remove("active"));
// すべてのスライドから 'active' クラスを削除
// slides[index].classList.add("active"); // 現在のスライドに 'active' クラスを追加
// index = (index + 1) % slides.length;
// 次のスライドのインデックスを計算
// }

// 5秒ごとにスライドを切り替え
//   setInterval(changeSlide, 5000);
// };
