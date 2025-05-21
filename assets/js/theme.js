(function ($) {
  "use strict";

  /**
   * 主题类
   *
   * @author JellyDai <d@jellydai.com>
   */
  class Theme {
    constructor() {
      this.initProgressBar();
      this.initScrollTopButton();
      this.initRankMathTocBlock();
      this.initShareButtons();
      this.initCategoriesScroll();
      this.initTableWidthTrouble();
      this.initWoocommerceContent();
      this.initPrimaryMenu();
      this.initFloatButtons();
      this.initCookieBanner();
    }

    /**
     * 初始化回到顶部进度条
     *
     * @since 1.0.0
     */
    initProgressBar() {
      const progressPath = document.querySelector(
        ".totop-button .progress-circle path"
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

    /**
     * 初始化回到顶部按钮
     *
     * @since 1.0.0
     */
    initScrollTopButton() {
      const offset = 50;
      const duration = 100;
      const $totopButton = $(".totop-button");

      $(window).on("scroll", () => {
        if ($(window).scrollTop() > offset) {
          $totopButton.addClass("active-progress");
        } else {
          $totopButton.removeClass("active-progress");
        }
      });

      $totopButton.on(
        "click",
        debounce((event) => {
          event.preventDefault();
          $("html, body").animate({ scrollTop: 0 }, duration);
        }, 300)
      ); // 设置 300ms 的防抖延迟
    }

    /**
     * 初始化 Rank Math TOC
     *
     * @since 1.1.0
     */
    initRankMathTocBlock() {
      const jellyPostSidebar = $(".sidebar");
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

            // 使用 scrollTop 滚动到目标位置，并在完成后执行动画
            $("html, body").animate({ scrollTop: offset }, 500);
          }

          // 手动更新 URL
          history.pushState({}, "", targetId);
        });
      }
    }

    /**
     * 初始化分享按钮
     *
     * @since 1.1.0
     */
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

    /**
     * 初始化分类滚动
     *
     * @since 1.1.0
     */
    initCategoriesScroll() {
      const categoriesList = $(".categories-list");
      const activeItem = categoriesList.find("li.active");
      if (activeItem.length) {
        const listHeight = categoriesList.outerHeight();
        const listScrollHeight = categoriesList.get(0).scrollHeight;
        const itemOffset =
          activeItem.position().top - activeItem.outerHeight() * 3 + 3;
        if (listScrollHeight > listHeight) {
          categoriesList.animate({ scrollTop: itemOffset }, 500);
        }
      }
    }

    /**
     * 初始化表格宽度问题
     *
     * @since 1.1.0
     */
    initTableWidthTrouble() {
      $(".content table").each(function () {
        if (!$(this).parent().hasClass("content-table")) {
          $(this).wrap('<div class="content-table"></div>');
        }
      });
    }

    initWoocommerceContent() {
      // 读取#tab-description中的所有<h2>元素

      $(".product .content h2").each(function (index) {
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
        $(".product-table-of-content").append(li);
      });
      $(".product-table-of-content").on("click", "a", function (event) {
        event.preventDefault(); // 阻止默认跳转行为

        const targetId = $(this).attr("href"); // 获取锚点 ID
        const targetElement = $(targetId); // 获取目标元素

        // 移除当前列表中所有 active 类
        $(this).parent().siblings().removeClass("active");
        // 为当前点击项的父元素添加 active 类
        $(this).parent().addClass("active");

        if (targetElement.length) {
          const offset = targetElement.offset().top - 120;

          $("html, body").animate({ scrollTop: offset }, 500);
        }

        history.pushState({}, "", targetId); // 手动更新 URL
      });
    }

    initPrimaryMenu() {
      // 桌面端：检测子菜单是否超出右边界，如果是则向左展开
      $(".primary-menu li").hover(function () {
        const $submenu = $(this).children(".sub-menu");
        if ($submenu.length && $(window).width() > 1240) {
          $submenu.removeClass("open-left").css({
            visibility: "hidden",
            display: "block",
          });

          const rect = $submenu[0].getBoundingClientRect();
          const overflowRight = rect.right > $(window).width();

          if (overflowRight) {
            $submenu.addClass("open-left");
          }

          $submenu.css({ visibility: "", display: "" });
        }
      });

      // 打开移动端菜单
      $(".menu-toggle").on("click", function () {
        $(".primary-menu").addClass("active");
        $(".menu-overlay").addClass("active");
      });

      // 关闭移动端菜单
      $(".menu-close, .menu-overlay").on("click", function () {
        $(".primary-menu").removeClass("active");
        $(".menu-overlay").removeClass("active");
        $(".primary-menu li").removeClass("submenu-open");
      });

      // 移动端：点击菜单项展开子菜单（阻止默认跳转）
      $(".primary-menu li.menu-item-has-children > a").on(
        "click",
        function (e) {
          const $parentLi = $(this).parent("li");

          if ($(window).width() <= 1240) {
            if (!$parentLi.hasClass("submenu-open")) {
              e.preventDefault();

              // 关闭其他子菜单
              $parentLi
                .siblings(".menu-item-has-children")
                .removeClass("submenu-open");

              // 打开当前子菜单
              $parentLi.addClass("submenu-open");
            } else {
              // 第二次点击允许跳转
              return true;
            }
          }
        }
      );

      // 窗口尺寸变化时清理移动端状态
      $(window).on("resize", function () {
        if ($(window).width() > 1240) {
          $(".primary-menu").removeClass("active");
          $(".menu-overlay").removeClass("active");
          $(".primary-menu li.menu-item-has-children").removeClass(
            "submenu-open"
          );
        }
      });
    }

    initFloatButtons() {
      const $floatButtons = $("#floatButtons");
      if ($floatButtons.length > 0) {
        if ($floatButtons.children().length === 1) {
          $floatButtons.remove();
        } else {
          const closeButton = $("#floatButtonClose");

          // 检查 sessionStorage 状态
          if (sessionStorage.getItem("floatButtonsClosed") === "true") {
            $floatButtons.addClass("buttons-close");
          }

          closeButton.on("click", function () {
            $floatButtons.toggleClass("buttons-close");

            // 更新 sessionStorage 状态
            sessionStorage.setItem(
              "floatButtonsClosed",
              $floatButtons.hasClass("buttons-close")
            );
          });
        }
      }
    }

    initCookieBanner() {
      // 如果用户已经接受或拒绝过，保持隐藏
      if (
        localStorage.getItem("cookie-consent") === "accepted" ||
        localStorage.getItem("cookie-consent") === "rejected"
      ) {
        return;
      }

      const $banner = $(".cookie-banner");
      // 否则显示 banner
      $banner.css("display", "flex").hide().slideDown(300);

      // 监听按钮点击事件
      $(".cookie-banner .accept-button").on("click", () => {
        localStorage.setItem("cookie-consent", "accepted");
        $banner.slideUp(); // 滑动隐藏
      });

      $(".cookie-banner .reject-button").on("click", () => {
        localStorage.setItem("cookie-consent", "rejected");
        $banner.slideUp();
      });
    }
  }

  function debounce(func, delay) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => func.apply(this, args), delay);
    };
  }

  $(document).ready(() => {
    new Theme();
    console.log("Document Ready!");
    console.log("Developer:JellyDai");
    console.log("Email:d@jellydai.com");
  });
  
})(jQuery);
