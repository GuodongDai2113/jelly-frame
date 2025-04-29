(function ($) {
  "use strict";

  class Theme {
    constructor() {
      this.initProgressBar();
      this.initScrollTopButton();
      this.initRankMathTocBlock();
      this.initShareButtons();
      this.initCategoriesScroll();
      this.initTableWidthTrouble();
      this.initWoocommerceContent();
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
        if (window.innerWidth > 768) {
          toc.appendTo(jellyPostSidebar);
        } else {
          toc.css({ position: "relative", top: "unset" });
        }
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
      const categoriesList = $(".categories-list");
      const activeItem = categoriesList.find("li.active");
      if (activeItem.length) {
        const listHeight = categoriesList.outerHeight();
        const listScrollHeight = categoriesList.get(0).scrollHeight;
        const itemOffset =
          activeItem.position().top - activeItem.outerHeight() * 2 - 10;
        if (listScrollHeight > listHeight) {
          categoriesList.animate({ scrollTop: itemOffset }, 500);
        }
      }
    }

    initTableWidthTrouble() {
      $(
        ".woocommerce-Tabs-panel--description table, .jelly-container-content table"
      ).each(function () {
        if (!$(this).parent().hasClass("jelly-content-table")) {
          $(this).wrap('<div class="jelly-content-table"></div>');
        }
      });
    }

    initWoocommerceContent() {
      // 读取#tab-description中的所有<h2>元素

      $(".jelly-product-content h2").each(function (index) {
        // 获取<h2>的文本内容
        let text = $(this).text().trim();

        if (text.toLowerCase() === "description") {
          return; // 跳过当前循环
        }

        // 将文本内容转换为小写，并将空格替换为连字符
        let id = text.toLowerCase().replace(/\s+/g, "-");

        // 为<h2>设置id
        $(this).attr("id", id);

        // 创建对应的<li>链接
        let li = `
            <li>
                <a href="#${id}">
                    ${text}
                </a>
            </li>
        `;

        // 将<li>链接添加到.woocommerce-tabs wc-tabs中
        $(".jelly-product-toc").append(li);
      });

      // 设置第一个<li>为激活状态
      // $(".woocommerce-tabs.wc-tabs li:first")
      //   .addClass("active")
      //   .find("a")
      //   .attr("aria-selected", "true")
      //   .attr("tabindex", "0");
    }
  }

  $(document).ready(() => {
    new Theme();
  });

  console.log("Theme Developer:JellyDai");
  console.log("Email:d@jellydai.com");
})(jQuery);
