const swiper = new Swiper('.swiper', {
      // Optional parameters
      slidesOffsetAfter: 2.2,
      slidesOffsetBefore: 2.2,
      slidesPerView: 1.3,
      spaceBetween: 20,
      loop: true,
      breakpoints: {
            // when window width is >= 320px
            768: {
                  slidesPerView: 2.3,

            }
      }
      // If we need pagination
      // pagination: {
      // 	el: '.swiper-pagination',
      // },

      // Navigation arrows
      // navigation: {
      // 	nextEl: '.swiper-button-next',
      // 	prevEl: '.swiper-button-prev',
      // },

      // And if we need scrollbar
      // scrollbar: {
      // 	el: '.swiper-scrollbar',
      // },
});

const swiper_cats = new Swiper('.swiper-cats', {
      // Optional parameters
      slidesOffsetAfter: 0,
      slidesOffsetBefore: 0,
      slidesPerView: 2.3,
      spaceBetween: 10,

      loop: true,
      breakpoints: {
            // when window width is >= 320px
            768: {
                  slidesPerView: 6,

            }
      }
});

document.body.addEventListener('click', function () {
      document.getElementById("main").style.cssText = "margin: 0;"
}, true);

function closedSidebar() {
      document.getElementById("main").style.cssText = "margin: 0;";

}

function openedSidebar() {
      const mediaQuery = window.matchMedia('(min-width: 768px)')
      if (mediaQuery.matches) {
            document.getElementById("main").style.cssText = "margin: 0 -260px 0 0;";
      } else {
            document.getElementById("main").style.cssText = "margin: 0 -750px 0 0;";
      }
}



// const pullToRefresh = document.querySelector('.pull-to-refresh');
// let touchstartY = 0;
// document.addEventListener('touchstart', e => {
//       touchstartY = e.targetTouches[0].pageY;
// });
// document.addEventListener('touchmove', e => {
//       const touchY = e.targetTouches[0].pageY;
//       const touchDiff = touchY - touchstartY;
//       if (touchDiff > 0 && window.scrollY === 0) {
//             pullToRefresh.classList.add('visible');
//             e.preventDefault();
//       }
// });
// document.addEventListener('touchend', e => {
//       if (pullToRefresh.classList.contains('visible')) {
//             pullToRefresh.classList.remove('visible');
//             location.reload();
//       }
// });