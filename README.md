
# MarkdownManager

> A personal markdown docs management system and online editor based on PHP and Editor.md&amp;WizEditor

MarkdownManager是一个基于PHP项目的个人markdown文档管理平台，可以管理自己的markdown文档,增加或删除文档并提供在线编辑功能，提供了身份口令验证，输入密码后可以编辑markdown文件，游客只可以浏览markdown，没有修改权限

# 特点

* 跨平台，多终端同步
* 提供基于MathJex的Tex数学公式支持
* 支持流程图、时序图创建
* 权限控制，只有作者可以修改编辑文档，游客只能浏览
* 支持本地图片上传

# 部署说明
本项目基于php,绿色项目，无其他数据库依赖，配置好php环境即可安装部署

1. 安装并配置apache 参考 `linux安装lamp` http://wiki.ubuntu.org.cn/index.php?title=Apache&redirect=no#.E5.AE.89.E8.A3.85LAMP
2. 将项目md.tar解压后拖入web root下
3. 修改./userControl/control.php中的用户名username和密码password，为私密密码
4. 安装完成

# 依赖说明

* php 7
* Apache 2.4
* editor.md
* Wiz.editor
* Bootstrap 3.0
