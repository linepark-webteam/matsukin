console.log("test");


// TOP HERO SVGアニメーション
new Vivus('house', {
  duration: 500,
  type: 'async',
  animTimingFunction: Vivus.EASE
}, function (obj) {
  obj.el.classList.add('finished'); // アニメーション完了を示すクラスを追加
  document.querySelectorAll('#house path').forEach(function(path) {

      // path.style.fill = '#C6AF28';
      // アニメーション終了後にfillを適用
  });
});

// TOP SVG背景アニメーション
        // Vivusインスタンスを作成
        let vivus = new Vivus('my-svg', {
          type: 'delayed',
          duration: 200,
          start: 'manual', // 手動でアニメーションを開始
          dashGap: 20
      });

      // スクロールイベントに基づいて描画を制御
      document.addEventListener('scroll', function() {
          let scrollPosition = window.scrollY;
          let documentHeight = document.documentElement.scrollHeight - window.innerHeight;
          let progress = scrollPosition / documentHeight;

          // Vivusの進行状況を設定
          vivus.setFrameProgress(progress);
      });

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
        // 少し早めにアニメーションが始まるように調整
        element.classList.add("visible");
      }
    });
  });

// Swipperライブラリ(スライドアニメーション)の為のScript
const swiper1 = new Swiper('.swiper-container.top', {
  loop: true,
  spaceBetween: 45,
  speed: 5000,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
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
const swiper2 = new Swiper('.swiper-container.products', {
  loop: true,
  spaceBetween: 25,
  speed: 5000,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  allowTouchMove: false,
  breakpoints: {
    320: {
      slidesPerView: 3.5,
    },
    480: {
      slidesPerView: 3.5,
    },
    768: {
      slidesPerView: 3.5,
    },
    1024: {
      slidesPerView: 3.5,
    },
    1200: {
      slidesPerView: 3.5,
    }
  }
});
const swiper3 = new Swiper('.swiper-container.works', {
  loop: true,
  spaceBetween: 25,
  speed: 5000,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  allowTouchMove: false,
  breakpoints: {
    320: {
      slidesPerView: 3.5,
    },
    480: {
      slidesPerView: 3.5,
    },
    768: {
      slidesPerView: 3.5,
    },
    1024: {
      slidesPerView: 3.5,
    },
    1200: {
      slidesPerView: 3.5,
    }
  }
});
}

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
