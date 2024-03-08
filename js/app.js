console.log('test');

window.onload = function() {
  // プリローダーアニメーション非表示（存在する場合）
  let preloader = document.getElementById('preloader');
  if (preloader) {
    preloader.style.display = 'none';
  }

  // スライドショーの初期化と設定
  const slides = document.querySelectorAll('.slide');
  let index = 0;

  function changeSlide() {
    slides.forEach(slide => slide.classList.remove('active')); // すべてのスライドから 'active' クラスを削除
    slides[index].classList.add('active'); // 現在のスライドに 'active' クラスを追加
    index = (index + 1) % slides.length; // 次のスライドのインデックスを計算
  }

  // 5秒ごとにスライドを切り替え
  setInterval(changeSlide, 5000);

  // フェードインアニメーション関連の処理
  const fadeInElements = document.querySelectorAll('.fade-in-content');

  function triggerFadeIn() {
    fadeInElements.forEach(element => {
      const elementTop = element.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;

      if (elementTop < windowHeight) {
        element.classList.add('visible');
      }
    });
  }

  // ページ読み込み時にフェードインアニメーションを適用
  triggerFadeIn();

  // スクロールイベント時にフェードインアニメーションを再適用
  window.addEventListener('scroll', triggerFadeIn);
};
