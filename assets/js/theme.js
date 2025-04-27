(function ($) {
  "use strict";

  class Theme {
    constructor() {
      this.initProgressBar();
      this.initScrollTopButton();
      this.initRankMathTocBlock();
      this.initShareButtons();
      this.initCategoriesScroll();
    }

    initProgressBar() {
      const progressPath = document.querySelector(
        ".jelly-totop .progress-circle path"
      );
      if (!progressPath) return;

      const pathLength = progressPath.getTotalLength();
      progressPath.style.transition = progressPath.style.WebkitTransition =
        "none";
      progressPath.style.strokeDasharray = `${pathLength} ${pathLength}`;
      progressPath.style.strokeDashoffset = pathLength;

      progressPath.getBoundingClientRect(); // 强制重绘以触发过渡
      progressPath.style.transition = progressPath.style.WebkitTransition =
        "stroke-dashoffset 10ms linear";

      const updateProgress = () => {
        const scroll = $(window).scrollTop();
        const height = $(document).height() - $(window).height();
        const progress = pathLength - (scroll * pathLength) / height;
        progressPath.style.strokeDashoffset = progress;
      };

      updateProgress();
      $(window).on("scroll", updateProgress);
    }

    initScrollTopButton() {
      const offset = 50;
      const duration = 550;
      const $totopButton = $(".jelly-totop");

      $(window).on("scroll", () => {
        if ($(window).scrollTop() > offset) {
          $totopButton.addClass("active-progress");
        } else {
          $totopButton.removeClass("active-progress");
        }
      });

      $totopButton.on("click", (event) => {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, duration);
        return false;
      });
    }
    initRankMathTocBlock() {
      const jellyPostSidebar = $(".jelly-container-sidebar");
      const toc = $("div.wp-block-rank-math-toc-block");
      if (jellyPostSidebar.length && toc.length) {
        toc.appendTo(jellyPostSidebar);
  
        // 为 toc 中的每个锚文本添加点击事件处理程序
        toc.on("click", "a", function (event) {
          event.preventDefault(); // 阻止默认的跳转行为
  
          const targetId = $(this).attr("href"); // 获取锚点的目标 ID
          const targetElement = $(targetId); // 获取目标元素
  
          if (targetElement.length) {
            // 计算滚动到目标元素的偏移量，留出 120px 的间距
            const offset = targetElement.offset().top - 120;
  
            // 使用 animate 方法实现平滑滚动
            $("html, body").animate({ scrollTop: offset }, 500);
          }
  
          // 手动更新 URL
          history.pushState({}, "", targetId);
        });
      }
    }

    initShareButtons() {
      const shareButtons = {
        twitter: {
          url: "https://twitter.com/intent/tweet",
          params: {
            text: document.title,
            url: window.location.href,
          },
        },
        facebook: {
          url: "https://www.facebook.com/sharer/sharer.php",
          params: {
            u: window.location.href,
          },
        },
        linkedin: {
          url: "https://www.linkedin.com/shareArticle",
          params: {
            title: document.title,
            summary: "",
            source: window.location.href,
            url: window.location.href,
          },
        },
      };

      $(".share-toggle").on("click", function (event) {
        event.preventDefault();
        const network = $(this).attr("id");
        if (shareButtons[network]) {
          const params = new URLSearchParams(shareButtons[network].params);
          const shareUrl = `${shareButtons[network].url}?${params.toString()}`;
          window.open(shareUrl, "_blank", "width=600,height=400");
        }
      });
    }

    initCategoriesScroll() {
      const categoriesList = $('.categories-list');
      const activeItem = categoriesList.find('li.active');
      if (activeItem.length) {
        const listHeight = categoriesList.outerHeight();
        const listScrollHeight = categoriesList.get(0).scrollHeight;
        const itemOffset = activeItem.position().top - (activeItem.outerHeight() * 2) - 10;
        if (listScrollHeight  > listHeight) {
          categoriesList.animate({ scrollTop: itemOffset }, 500);
        }
      }
    }
  }

  $(document).ready(() => {
    new Theme();
  });

  console.log("Theme Developer:JellyDai");
  console.log("Email:d@jellydai.com");
})(jQuery);
