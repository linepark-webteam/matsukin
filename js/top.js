console.log("test");

// TOP HERO SVGアニメーション
function startVivusAnimation() {
  new Vivus("house", {
    duration: 200,
    type: "async",
    animTimingFunction: Vivus.EASE,
    start: "inViewport",
    onReady: function (obj) {
      obj.el.classList.add("ready");
    },
    onEnd: function (obj) {
      obj.el.classList.add("finished");
      if (document.querySelector("#house").classList.contains("ready")) {
        requestAnimationFrame(() => {
          anime({
            targets: "#house path",
            translateX: () => anime.random(-10, 10) + "px",
            translateY: () => anime.random(-10, 10) + "px",
            easing: "linear",
            duration: 1000,
            direction: "alternate",
            loop: true,
          });
        });
      }
    },
  });
}

document.addEventListener("DOMContentLoaded", () => {
  startVivusAnimation();
  animateText();
  initializeSwipers();
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
// Swipperスライダー
// スライダーの初期化
function initializeSwipers() {
  const swiperTop = new Swiper(".swiper-container.top", {
    loop: true,
    spaceBetween: 50,
    speed: 5000,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    allowTouchMove: true,
    breakpoints: {
      320: { slidesPerView: 2.5 },
      480: { slidesPerView: 2.5 },
      600: { slidesPerView: 3.5 },
      768: { slidesPerView: 3.5 },
      1024: { slidesPerView: 4 },
      1200: { slidesPerView: 5 },
    },
  });

  const swiperProducts = new Swiper(".swiper-container.products", {
    loop: true,
    spaceBetween: 25,
    speed: 5000,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    allowTouchMove: true,
    breakpoints: {
      320: { slidesPerView: 1.5 },
      480: { slidesPerView: 2 },
      600: { slidesPerView: 3 },
      768: { slidesPerView: 3.5 },
      1024: { slidesPerView: 3.5 },
      1200: { slidesPerView: 4.5 },
    },
  });

  const swiperWorks = new Swiper(".swiper-container.works", {
    loop: true,
    spaceBetween: 25,
    speed: 5000,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    allowTouchMove: true,
    breakpoints: {
      320: { slidesPerView: 1.5 },
      480: { slidesPerView: 2 },
      600: { slidesPerView: 3 },
      768: { slidesPerView: 3.5 },
      1024: { slidesPerView: 3.5 },
      1200: { slidesPerView: 4.5 },
    },
  });
}

// ページが読み込まれたときにアニメーションを開始
document.addEventListener("DOMContentLoaded", animateText);

// スクロールイベントに基づいて描画を制御
let scrollThrottleTimer = false;
document.addEventListener("scroll", function () {
  if (!scrollThrottleTimer) {
    scrollThrottleTimer = true;
    requestAnimationFrame(() => {
      let scrollPosition = window.scrollY;
      let documentHeight =
        document.documentElement.scrollHeight - window.innerHeight;
      let progress = scrollPosition / documentHeight;
      vivus.setFrameProgress(progress);
      animeInstance.play();
      scrollThrottleTimer = false;
    });
  }
});

// TOPページ SVG背景アニメーション
// 初期設定
let duration = window.innerWidth < 992 ? 10 : 200;

// Vivusインスタンスを作成
let vivus = new Vivus("background-svg", {
  type: "delayed",
  duration: duration,
  start: "manual", // 手動でアニメーションを開始
  dashGap: 20,
});

// Anime.jsのアニメーション設定
let animeInstance = anime({
  targets: "#background-svg path",
  translateX: () => anime.random(-5, 5) + "px",
  translateY: () => anime.random(-5, 5) + "px",
  easing: "easeInOutSine",
  duration: 1000,
  direction: "alternate",
  loop: true,
  autoplay: true, // 自動再生をオフにする
});

// IntersectionObserverの設定
let observer = new IntersectionObserver(
  (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Vivusアニメーションを開始
        vivus.play();

        // Anime.jsアニメーションを開始
        animeInstance.play();

        // 一度アニメーションを開始したら、それ以上監視不要なのでobserverを停止
        observer.unobserve(entry.target);
      }
    });
  },
  {
    threshold: 0.5, // 50%の要素が見えた時にトリガー
  }
);

// 監視対象を指定
observer.observe(document.getElementById("background-svg"));

// ウィンドウサイズ変更時のリスナーを追加して、必要に応じて再設定
window.addEventListener("resize", function () {
  let newDuration = window.innerWidth < 992 ? 10 : 200;
  if (newDuration !== duration) {
    duration = newDuration;
    vivus.reset().setDuration(duration).play(1); // Vivusをリセットして新しいdurationを設定後、再生
  }
});

// プリローダーアニメーション
window.onload = function () {
  let preloader = document.getElementById("preloader");
  if (preloader) {
    preloader.style.display = "none";
  }
};
