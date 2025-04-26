=== Jelly Frame ===

Version: 1.2.0
Stable tag: 1.2.0
Requires at least: 6.8
Tested up to: 6.8
Requires PHP: 7.4
License: GNU General Public License v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

兼容 Woocommerce、Elementor、Rank Math

主题采用了Elementor的主题位置功能，当使用Elementor的主题编辑时，会覆盖主题原有的模板。
例如:编辑器设定了Header后，template-parts\header.php文件就不会被执行
因此，该主题只是提供一个默认的样式，用于减少工作量，批量的制作网站。
主题中编写了一些css来覆盖wp与一些插件原有的css，让他们更好看些。
同时设定了一些Elementor小部件的默认样式，减少了后台配置的项目，减轻编辑器的冗余。
一般有颜色的区块均使用--e-global-color-accent变量，按钮，搜索框等。

== Copyright ==

This theme, like WordPress, is distributed under the terms of GPL.

Jelly Fream bundles the following third-party resources:

The theme uses the Remix Icon library
License: Apache-2.0
Source: https://remixicon.com/license

== Changelog ==

= 1.2.0 - 2025-04-24 =
* 新增：增加主题设置项，可以插入 Elementor Template 短代码
* 新增：跳转到内容链接 template-parts\header.php:13
* 新增：使用JS位移Rank Math目录小部件到侧边栏
* 新增：Rank Math FAQ小部件样式
* 调整：functions.php 改为引用其他文件，增加代码可读性
* 调整：为大部分函数编写注释
* 调整：使用searchform.php创建搜索表单，使用get_search_form()调用表单
* 调整：移除wp默认的样式，但不移除 wp-block-library
* 调整：修改前缀jf为jelly