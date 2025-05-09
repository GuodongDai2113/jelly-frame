=== Jelly Frame ===

Version: 1.2.3
Stable tag: 1.2.3
Requires at least: 6.8
Tested up to: 6.8
Requires PHP: 7.4
License: GNU General Public License v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

兼容 Woocommerce、Elementor、Rank Math

适用于第三方外包网站，减轻页面编辑工作，固定产品分类页，产品单页，文章分类页，文章页。

更加专注于其他页面的优化工作。

继续优化，代码可复用性，尽可能多的兼容，更好的CSS名称。

== Copyright ==

This theme, like WordPress, is distributed under the terms of GPL.

Jelly Fream bundles the following third-party resources:

The theme uses the Remix Icon library
License: Apache-2.0
Source: https://remixicon.com/license

== TODO ==

1. 无障碍
2. RTL适配
3. 插件兼容
4. 页眉页尾默认模板
5. 管理小部件
6. 更多动画
7. 舒适性提升
8. 用户预测
9. 避免臃肿

== Changelog ==

= 1.2.3 - 2025-05-06 =
* 新增：4个 Elementor 小部件
* 调整：面包屑小部件显示顺序Rank Math->Yoast->Woocommerce

= 1.2.1-开发 - 2025-05-06 =
* 调整：调整类名，使用更加语义化的类名

= 1.2.1-开发 - 2025-04-30 =
* 调整：重新生成theme.min.css文件
* 调整：将大部分固定颜色，圆角修改为变量
* 调整：将css文件放置在dev文件中，然后使用css.py文件合并为theme
* 调整：在页面增加更多的颜色，使用--jelly-color-primary


= 1.2.0 - 2025-04-24 开始 =
* 新增：产品分类内容字段，便与SEO内容的编写
* 新增：增加Woocommerce的样式和修改模板
* 新增：使用Elementor 完成全局表单功能
* 新增：增加主题设置项，可以插入 Elementor Template 短代码
* 新增：跳转到内容链接 template-parts\header.php:13
* 新增：使用JS位移Rank Math目录小部件到侧边栏
* 新增：Rank Math FAQ小部件样式
* 调整：functions.php 改为引用其他文件，增加代码可读性
* 调整：为大部分函数编写注释
* 调整：使用searchform.php创建搜索表单，使用get_search_form()调用表单
* 调整：移除wp默认的样式，但不移除 wp-block-library
* 调整：修改前缀jf为jelly
* 调整：统一使用Rank Math的面包屑功能
* 调整：产品单页相册布局
* 调整：根据详情部分自动增加内容toc