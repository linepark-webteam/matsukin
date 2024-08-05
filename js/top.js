// ユーティリティ関数
const util = {
  splitTextIntoSpans: (element) => {
    const text = element.textContent;
    element.innerHTML = "";
    text.split("").forEach((char) => {
      const span = document.createElement("span");
      span.textContent = char === " " ? "\u00A0" : char;
      span.classList.add("letter");
      element.appendChild(span);
    });
  },
  throttle: (func, limit) => {
    let inThrottle;
    return function() {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    }
  },
  getScreenWidth: () => $(window).width(),
  isElementInViewport: (el) => {
    const rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  },
};

// アニメーション関連の関数
const animations = {
  vivus: (id, options) => {
    return new Vivus(id, {
      duration: 200,
      type: options.type || "oneByOne",
      animTimingFunction: Vivus.EASE,
      start: options.start || "autostart",
      onReady: options.onReady,
      onEnd: options.onEnd,
    });
  },
  text: () => {
    const textElements = document.querySelectorAll(".animate-text");
    textElements.forEach((element, index) => {
      util.splitTextIntoSpans(element);
      anime.timeline({ loop: false }).add({
        targets: element.querySelectorAll(".letter"),
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 750,
        delay: (el, i) => 50 * (i + 1),
        offset: index * 1000,
      });
    });
  },
  topHeroSvg: () => {
    animations.vivus("house", {
      type: "async",
      start: "inViewport",
      onReady: (obj) => obj.el.classList.add("ready"),
      onEnd: (obj) => {
        obj.el.classList.add("finished");
        if (document.querySelector("#house").classList.contains("ready")) {
          anime({
            targets: "#house path",
            translateX: () => anime.random(-10, 10) + "px",
            translateY: () => anime.random(-10, 10) + "px",
            easing: "linear",
            duration: 1000,
            direction: "alternate",
            loop: true,
          });
        }
      },
    });
  },
  backgroundSvg: () => {
    let duration = util.getScreenWidth() < 992 ? 10 : 200;
    let vivus = animations.vivus("background-svg", {
      type: "sync",
      start: "manual",
    });

    let animeInstance = anime({
      targets: "#background-svg path",
      translateX: () => anime.random(-5, 5) + "px",
      translateY: () => anime.random(-5, 5) + "px",
      easing: "easeInOutSine",
      duration: 500,
      direction: "alternate",
      loop: true,
      autoplay: false,
    });

    let animationStarted = false;
    let observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting && !animationStarted) {
            vivus.play();
            animeInstance.play();
            animationStarted = true;
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1 }
    );

    observer.observe(document.getElementById("background-svg"));

    window.addEventListener("resize", () => {
      let newDuration = util.getScreenWidth() < 992 ? 10 : 200;
      if (newDuration !== duration) {
        duration = newDuration;
        if (!animationStarted) {
          vivus.reset().setDuration(duration);
        }
      }
    });
  },
  fadeIn: () => {
    const fadeElements = document.querySelectorAll(".u-fade-in:not(.fade-in)");
    const viewportHeight = window.innerHeight;

    fadeElements.forEach((element) => {
      const rect = element.getBoundingClientRect();
      if (rect.top <= viewportHeight) {
        requestAnimationFrame(() => {
          element.classList.add("fade-in");
        });
      }
    });
  },
};

// Swiper初期化
const initializeSwipers = () => {
  const swiperConfigs = {
    top: {
      spaceBetween: 50,
      breakpoints: {
        320: { slidesPerView: 2.5 },
        480: { slidesPerView: 2.5 },
        600: { slidesPerView: 3.5 },
        768: { slidesPerView: 3.5 },
        1024: { slidesPerView: 4 },
        1200: { slidesPerView: 5 },
      },
    },
    products: {
      spaceBetween: 25,
      breakpoints: {
        320: { slidesPerView: 1.5 },
        480: { slidesPerView: 2 },
        600: { slidesPerView: 3 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 3.5 },
        1200: { slidesPerView: 4.5 },
      },
    },
    works: {
      spaceBetween: 25,
      breakpoints: {
        320: { slidesPerView: 1.5 },
        480: { slidesPerView: 2 },
        600: { slidesPerView: 3 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 3.5 },
        1200: { slidesPerView: 4.5 },
      },
    },
  };

  Object.entries(swiperConfigs).forEach(([key, config]) => {
    new Swiper(`.swiper-container.${key}`, {
      loop: true,
      speed: 5000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      allowTouchMove: true,
      ...config,
    });
  });
};

// SVG調整関数
const adjustSvg = () => {
  const screenWidth = util.getScreenWidth();
  const h2Height = $(".fs-3.fw-bold").outerHeight();
  let additionalOffset, scaleValue;

  if (screenWidth < 375) {
    [additionalOffset, scaleValue] = [-10, 1.5];
  } else if (screenWidth < 430) {
    [additionalOffset, scaleValue] = [-10, 1.3];
  } else if (screenWidth < 576) {
    [additionalOffset, scaleValue] = [-10, 1.4];
  } else if (screenWidth < 768) {
    [additionalOffset, scaleValue] = [-10, 1.1];
  } else if (screenWidth < 992) {
    [additionalOffset, scaleValue] = [0, 1.3];
  } else if (screenWidth < 1200) {
    [additionalOffset, scaleValue] = [5, 1.3];
  } else if (screenWidth < 1400) {
    [additionalOffset, scaleValue] = [15, 1.05];
  } else {
    [additionalOffset, scaleValue] = [18, 1.1];
  }

  $(".svg-container").css({
    top: -(h2Height + additionalOffset) + "px",
    transform: `scale(${scaleValue})`,
  });
};

// ヘッダーの透過・不透過トグル
const updateHeaderTransparency = () => {
  const header = $("header.fixed-top");
  $(window).scrollTop() > 50
    ? header.removeClass("transparent").addClass("opaque")
    : header.addClass("transparent").removeClass("opaque");
};

// プリローダーアニメーション
window.onload = () => {
  let preloader = document.getElementById("preloader");
  if (preloader) {
    preloader.style.display = "none";
  }
};

// 初期化
$(document).ready(() => {
  adjustSvg();
  animations.topHeroSvg();
  animations.text();
  animations.backgroundSvg();
  animations.fadeIn(); // 初回のフェードイン処理
  initializeSwipers();
  updateHeaderTransparency();

  $(window).on('resize', util.throttle(adjustSvg, 100));
  $(window).on('scroll', util.throttle(() => {
    updateHeaderTransparency();
    animations.fadeIn();
  }, 100));

  // ウィンドウのリサイズ時にもフェードイン処理を実行
  $(window).on('resize', util.throttle(animations.fadeIn, 100));
});