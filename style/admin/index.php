<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>后台管理系统</title>

	<link href="themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
	<link href="uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
	<!--[if IE]>
	<link href="themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
	<![endif]-->

	<!--[if lt IE 9]><script src="js/speedup.js" type="text/javascript"></script>
	<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script><![endif]-->
	<!--[if gte IE 9]><!--><script src="js/jquery-2.1.4.min.js" type="text/javascript"></script><!--<![endif]-->

	<script src="js/jquery.cookie.js" type="text/javascript"></script>
	<script src="js/jquery.validate.js" type="text/javascript"></script>
	<script src="js/jquery.bgiframe.js" type="text/javascript"></script>
	<script src="xheditor/xheditor-1.2.2.min.js" type="text/javascript"></script>
	<script src="xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
	<script src="uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

	<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
	<script type="text/javascript" src="chart/raphael.js"></script>
	<script type="text/javascript" src="chart/g.raphael.js"></script>
	<script type="text/javascript" src="chart/g.bar.js"></script>
	<script type="text/javascript" src="chart/g.line.js"></script>
	<script type="text/javascript" src="chart/g.pie.js"></script>
	<script type="text/javascript" src="chart/g.dot.js"></script>


	<!--	<script src="js/dwz.core.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.util.date.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.validate.method.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.barDrag.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.drag.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.tree.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.accordion.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.ui.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.theme.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.switchEnv.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.alertMsg.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.contextmenu.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.navTab.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.tab.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.resize.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.dialog.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.dialogDrag.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.sortDrag.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.cssTable.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.stable.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.taskBar.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.ajax.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.pagination.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.database.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.datepicker.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.effects.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.panel.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.checkbox.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.history.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.combox.js" type="text/javascript"></script>-->
	<!--	<script src="js/dwz.print.js" type="text/javascript"></script>-->


	<script src="bin/dwz.min.js" type="text/javascript"></script>

	<script src="js/dwz.regional.zh.js" type="text/javascript"></script>

	<script type="text/javascript" charset="utf-8" src="../system/ueditor/ueditor.config.js"></script>

	<script type="text/javascript" charset="utf-8" src="../system/ueditor/lang/zh-cn/zh-cn.js"></script>

	<!--	引入传输公共函数-->
	<script src="js/common.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(function(){
			DWZ.init("dwz.frag.xml", {
				loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
				statusCode:{ok:200, error:300, timeout:301}, //【可选】
				pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
				keys: {statusCode:"statusCode", message:"message"}, //【可选】
				ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
				debug:false,	// 调试模式 【true|false】
				callback:function(){
					initEnv();
					$("#themeList").theme({themeBase:"themes"}); // themeBase 相对于index页面的主题base路径
				}
			});
		});

	</script>
</head>

<body>
<div id="layout">
	<div id="header">
		<div class="headerNav">
			<a class="logo" href="">标志</a>
			<ul class="nav">
				<li id="switchEnvBox"><a href="javascript:">（<span>北京</span>）切换城市</a>
					<ul>
						<li><a href="sidebar_1.html">北京</a></li>
						<li><a href="sidebar_2.html">上海</a></li>
						<li><a href="sidebar_2.html">南京</a></li>
						<li><a href="sidebar_2.html">深圳</a></li>
						<li><a href="sidebar_2.html">广州</a></li>
						<li><a href="sidebar_2.html">天津</a></li>
						<li><a href="sidebar_2.html">杭州</a></li>
					</ul>
				</li>
				<li><a href="donation.html" target="dialog" height="400" title="捐赠 & DWZ学习视频">捐赠</a></li>
				<li><a href="changepwd.html" target="dialog" width="600">设置</a></li>
				<li><a href="http://www.cnblogs.com/dwzjs" target="_blank">博客</a></li>
				<li><a href="http://weibo.com/dwzui" target="_blank">微博</a></li>
				<li><a href="login.html">退出</a></li>
			</ul>
			<ul class="themeList" id="themeList">
				<li theme="default"><div class="selected">蓝色</div></li>
				<li theme="green"><div>绿色</div></li>
				<!--<li theme="red"><div>红色</div></li>-->
				<li theme="purple"><div>紫色</div></li>
				<li theme="silver"><div>银色</div></li>
				<li theme="azure"><div>天蓝</div></li>
			</ul>
		</div>

		<!-- navMenu -->

	</div>

	<div id="leftside">
		<div id="sidebar_s">
			<div class="collapse">
				<div class="toggleCollapse"><div></div></div>
			</div>
		</div>
		<div id="sidebar">
			<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

			<div class="accordion" fillSpace="sidebar">
				<div class="accordionHeader">
					<h2><span>Folder</span>系统管理</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder">
						<li><a>接口管理</a>
							<ul>
								<li><a href="../index.php/admin/test/index" target="navTab" rel="index_jiekou" external="true">接口测试</a></li>
								<li><a href="../index.php/admin/test/manger" target="navTab" rel="manger_jiekou">接口管理</a></li>
							</ul>
						</li>
					</ul>
					<ul class="tree treeFolder">
						<li><a href="../index.php/gii" target="navTab" rel="index_gii" external="true">gii管理</a></li>
					</ul>
					<ul class="tree treeFolder">
						<li><a>信息管理</a>
							<ul>
								<li><a href="../index.php/admin/news/addnews" target="navTab" rel="news_addnews">添加文章</a></li>
								<li><a href="../index.php/admin/news/newstype" target="navTab" rel="news_newstype">文章类别</a></li>
								<li><a href="../index.php/admin/news/newslist" target="navTab" rel="news_newslist">文章列表</a></li>
								<li><a href="../index.php/admin/news/daohang" target="navTab" rel="news_daohang">网站导航</a></li>
							</ul>
						</li>
					</ul>
					<ul class="tree treeFolder">
						<li><a>附件管理</a>
							<ul>
								<li><a href="../index.php/admin/uploads/manger" target="navTab" rel="manger_uploads">附件管理</a></li>
							</ul>
						</li>
					</ul>
					<ul class="tree treeFolder">
						<li><a>后台导航管理</a>
							<ul>
								<li><a href="../index.php/admin/admindaohang/add" target="navTab" rel="add_daohang">添加导航</a></li>
								<li><a href="../index.php/admin/admindaohang/list" target="navTab" rel="list_daohang">管理导航</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>项目管理</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder">
						<li><a>e专递</a>
							<ul>
								<li><a href="http://localhost" target="navTab" rel="ezd1_1" external="true">首页（本地)</a></li>
								<li><a href="http://localhost/adminlogin" target="navTab" rel="ezd1_2" external="true">后台（本地)</a></li>
								<li><a href="http://localhost/index.php/test?pi1415926535897932384626" target="navTab" rel="ezd1_3" external="true">接口（本地)</a></li>
								<li><a href="http://localhost/index.php/gii" target="navTab" rel="ezd1_4" external="true">gii（本地)</a></li>
								<li><a href="http://localhost/index.php/mobileorder" target="navTab" rel="ezd1_5" external="true">手机下单（本地)</a></li>


								<li><a href="http://www.ezd-express.com" target="navTab" rel="ezd2_1" external="true">首页（正式)</a></li>
								<li><a href="http://www.ezd-express.com/adminlogin" target="navTab" rel="ezd2_2" external="true">后台（正式)</a></li>
								<li><a href="http://www.ezd-express.com/index.php/test?pi1415926535897932384626" target="navTab" rel="ezd2_3" external="true">接口（正式)</a></li>
								<li><a href="http://www.ezd-express.com/index.php/mobileorder" target="navTab" rel="ezd2_5" external="true">手机下单（正式)</a></li>


								<li><a href="http://www.ezd-express.com/ceshi/esdphp" target="navTab" rel="ezd3_1" external="true">首页（测试)</a></li>
								<li><a href="http://www.ezd-express.com/ceshi/esdphp/adminlogin" target="navTab" rel="ezd3_2" external="true">后台（测试)</a></li>
								<li><a href="http://www.ezd-express.com/ceshi/esdphp/index.php/test?pi1415926535897932384626" target="navTab" rel="ezd3_3" external="true">接口（测试)</a></li>
								<li><a href="http://www.ezd-express.com/ceshi/esdphp/index.php/mobileorder" target="navTab" rel="ezd3_5" external="true">手机下单（测试)</a></li>
							</ul>
						</li>
						<li><a>网站项目</a>
							<ul>
								<li><a href="http://www.yqtyy.com" target="navTab" rel="web_yqtyy" external="true">石材吧</a></li>
								<li><a href="http://www.unvco.com" target="navTab" rel="web_unvco" external="true">大学生联盟</a></li>
								<li><a href="http://www.zadz888.com" target="navTab" rel="web_zadz888" external="true">中安大宗</a></li>
								<li><a href="http://www.jxhxdz.com" target="navTab" rel="web_jxhxdz" external="true">海峡交易所</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>收藏链接</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder">

					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>系统搭建</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder">
						<li><a>thinkphp</a>
							<ul>
								<li><a href="../index.php/admin/news/newsview?uid=11" target="navTab" rel="dajian_thinkphp" external="true">thinkphp搭建前阅读</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>后台开发功能组件</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder">
						<li><a>常用的功能函数</a>
							<ul>
								<li><a href="../index.php/admin/news/newsview?uid=9" target="navTab" rel="weixin_getWxServerIp" external="true">常用的php功能函数</a></li>
							</ul>
						</li
					</ul>
					<ul class="tree treeFolder">
						<li><a>微信公众号开发</a>
							<ul>
								<li><a href="../index.php/admin/weixin/setWeixin" target="navTab" rel="weixin_setWeixin">微信的基本设置</a></li>
								<li><a href="../txtlog/wxlog.txt" target="navTab" rel="weixin_setWeixin" external="true">微信的log记录</a></li>
								<li><a href="../index.php/admin/weixin/gettoken" target="dialog" rel="weixin_gettoken">获取微信token</a></li>
								<li><a href="../index.php/admin/weixin/getWxServerIp" target="dialog" rel="weixin_getWxServerIp">获取微信服务器IP</a></li>
								<li><a href="../index.php/admin/news/newsview?uid=1" target="dialog" rel="weixin_getWxServerIp">服务器响应微信</a></li>
								<li><a href="../index.php/admin/weixin/caidan" target="dialog" rel="weixin_caidan">生成微信菜单</a></li>
								<li><a href="../index.php/admin/weixin/caidan1" target="navTab" rel="weixin_caidan1">生成微信菜单（自定义）</a></li>
								<li><a href="../index.php/admin/news/newsview?uid=10" target="navTab" rel="weixin_login1" external="true">微信公众号登陆机制</a></li>
							</ul>
						</li>
					</ul>
					<ul class="tree treeFolder">
						<li><a>银联支付</a>
							<ul>
								<li><a href="../demo/unionpay/index_01_gateway.php" target="navTab" rel="unionpay_wangguan1" external="true">银联网关支付示例</a></li>
								<li><a href="../index.php/admin/news/newsview?uid=8" target="dialog" rel="unionpay_wangguan2" width="800" height="500">银联支付配置须知</a></li>
								<li><a href="../demo/test_unionpay" target="navTab" rel="unionpay_wangguan3" external="true">银联网关支付测试支付</a></li>
								<li><a href="https://open.unionpay.com/ajweb/account/testPara" target="navTab" rel="unionpay_wangguan4" external="true">银联商家技术服务网址</a></li>
								<li><a href="https://merchant.unionpay.com/portal/pages/subsystem.jsp" target="navTab" rel="unionpay_wangguan5" external="true">中国银联商户服务系统</a></li>
								<li><a href="https://merchant.unionpay.com/join/product/detail?id=1" target="navTab" rel="unionpay_wangguan5" external="true">商户服务电子化入网平台</a></li>
								<li><a href="https://merchant.unionpay.com/join/product#PC在线收款产品" target="navTab" rel="unionpay_web1" external="true">银联商户入网平台</a></li>
							</ul>
						</li>
					</ul>
					<ul class="tree treeFolder">
						<li><a>百度地图开发</a>
							<ul>
								<li><a href="http://lbsyun.baidu.com/index.php?title=jspopular" target="navTab" rel="unionpay_web1" external="true">百度地图web API</a></li>
								<li><a href="http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-geocoding" target="navTab" rel="unionpay_web1" external="true">百度地图开放平台</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>界面组件</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder">
						<li><a href="tabsPage.html" target="navTab">主框架面板</a>
							<ul>
								<li><a href="main.html" target="navTab" rel="main">我的主页</a></li>
								<li><a href="http://www.baidu.com" target="navTab" rel="page1">页面一(外部链接)</a></li>
								<li><a href="demo/baidu_map.html" target="navTab" rel="external" external="true" title="需要设置external属性为true">地图(external="true")</a></li>
								<li><a href="demo_page1.html" target="navTab" rel="page1" fresh="false">替换页面一</a></li>
								<li><a href="demo_page2.html" target="navTab" rel="page2">页面二</a></li>
								<li><a href="demo_page4.html" target="navTab" rel="page3" title="页面三（自定义标签名）">页面三</a></li>
								<li><a href="demo_page4.html" target="navTab" rel="page4" fresh="false">测试页面(fresh="false")</a></li>
								<li><a href="w_editor.html" target="navTab">表单提交会话超时</a></li>
								<li><a href="demo/common/ajaxTimeout.html" target="navTab">navTab会话超时</a></li>
								<li><a href="demo/common/ajaxTimeout.html" target="dialog">dialog会话超时</a></li>
								<li><a href="index_menu.html" target="_blank">横向导航条</a></li>
							</ul>
						</li>

						<li><a>常用组件</a>
							<ul>
								<li><a href="w_panel.html" target="navTab" rel="w_panel">面板</a></li>
								<li><a href="w_tabs.html" target="navTab" rel="w_tabs">选项卡面板</a></li>
								<li><a href="w_dialog.html" target="navTab" rel="w_dialog">弹出窗口</a></li>
								<li><a href="w_alert.html" target="navTab" rel="w_alert">提示窗口</a></li>
								<li><a href="w_list.html" target="navTab" rel="w_list">CSS表格容器</a></li>
								<li><a href="demo_page1.html" target="navTab" rel="w_table">表格容器</a></li>
								<li><a href="w_removeSelected.html" target="navTab" rel="w_table">表格数据库排序+批量删除</a></li>
								<li><a href="w_tree.html" target="navTab" rel="w_tree">树形菜单</a></li>
								<li><a href="w_accordion.html" target="navTab" rel="w_accordion">滑动菜单</a></li>
								<li><a href="w_editor.html" target="navTab" rel="w_editor">编辑器</a></li>
								<li><a href="w_datepicker.html" target="navTab" rel="w_datepicker">日期控件</a></li>
								<li><a href="demo/database/db_widget.html" target="navTab" rel="db">suggest+lookup+主从结构</a></li>
								<li><a href="demo/database/treeBringBack.html" target="navTab" rel="db">tree查找带回</a></li>
								<li><a href="demo/sortDrag/1.html" target="navTab" rel="sortDrag">单个sortDrag示例</a></li>
								<li><a href="demo/sortDrag/2.html" target="navTab" rel="sortDrag">多个sortDrag示例</a></li>
								<li><a href="demo/sortDrag/form.html" target="navTab" rel="sortDrag">可拖动表单示例</a></li>
							</ul>
						</li>

						<li><a>表单组件</a>
							<ul>
								<li><a href="w_validation.html" target="navTab" rel="w_validation">表单验证</a></li>
								<li><a href="w_button.html" target="navTab" rel="w_button">按钮</a></li>
								<li><a href="w_textInput.html" target="navTab" rel="w_textInput">文本框/文本域</a></li>
								<li><a href="w_combox.html" target="navTab" rel="w_combox">下拉菜单</a></li>
								<li><a href="w_checkbox.html" target="navTab" rel="w_checkbox">多选框/单选框</a></li>
								<li><a href="demo_upload.html" target="navTab" rel="demo_upload">iframeCallback表单提交</a></li>
								<li><a href="w_uploadify.html" target="navTab" rel="w_uploadify">uploadify多文件上传</a></li>
							</ul>
						</li>
						<li><a>组合应用</a>
							<ul>
								<li><a href="demo/pagination/layout1.html" target="navTab" rel="pagination1">局部刷新分页1</a></li>
								<li><a href="demo/pagination/layout2.html" target="navTab" rel="pagination2">局部刷新分页2</a></li>
							</ul>
						</li>
						<li><a>图表</a>
							<ul>
								<li><a href="chart/test/barchart.html" target="navTab" rel="chart">柱状图(垂直)</a></li>
								<li><a href="chart/test/hbarchart.html" target="navTab" rel="chart">柱状图(水平)</a></li>
								<li><a href="chart/test/linechart.html" target="navTab" rel="chart">折线图</a></li>
								<li><a href="chart/test/linechart2.html" target="navTab" rel="chart">曲线图</a></li>
								<li><a href="chart/test/linechart3.html" target="navTab" rel="chart">曲线图(自定义X坐标)</a></li>
								<li><a href="chart/test/piechart.html" target="navTab" rel="chart">饼图</a></li>
							</ul>
						</li>
						<li><a href="dwz.frag.xml" target="navTab" external="true">dwz.frag.xml</a></li>
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>典型页面</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder treeCheck">
						<li><a href="demo_page1.html" target="navTab" rel="demo_page1">查询我的客户</a></li>
						<li><a href="demo_page1.html" target="navTab" rel="demo_page2">表单查询页面</a></li>
						<li><a href="demo_page4.html" target="navTab" rel="demo_page4">表单录入页面</a></li>
						<li><a href="demo_page5.html" target="navTab" rel="demo_page5">有文本输入的表单</a></li>
						<li><a href="javascript:;">有提示的表单输入页面</a>
							<ul>
								<li><a href="javascript:;">页面一</a></li>
								<li><a href="javascript:;">页面二</a></li>
							</ul>
						</li>
						<li><a href="javascript:;">选项卡和图形的页面</a>
							<ul>
								<li><a href="javascript:;">页面一</a></li>
								<li><a href="javascript:;">页面二</a></li>
							</ul>
						</li>
						<li><a href="javascript:;">选项卡和图形切换的页面</a></li>
						<li><a href="javascript:;">左右两个互动的页面</a></li>
						<li><a href="javascript:;">列表输入的页面</a></li>
						<li><a href="javascript:;">双层栏目列表的页面</a></li>
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>流程演示</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree">
						<li><a href="newPage1.html" target="dialog" rel="dlg_page">列表</a></li>
						<li><a href="newPage1.html" target="dialog" rel="dlg_page2">列表</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="container">
		<div id="navTab" class="tabsPage">
			<div class="tabsPageHeader">
				<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
					<ul class="navTab-tab">
						<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
					</ul>
				</div>
				<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
				<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
				<div class="tabsMore">more</div>
			</div>
			<ul class="tabsMoreList">
				<li><a href="javascript:;">我的主页</a></li>
			</ul>
			<div class="navTab-panel tabsPageContent layoutBox">
				<div class="page unitBox">
					<div class="accountInfo">
						<div class="alertInfo">
							<p><a href="https://code.csdn.net/dwzteam/dwz_jui/tree/master/doc" target="_blank" style="line-height:19px"><span>

									</span></a></p>
							<p><a href="http://pan.baidu.com/s/18Bb8Z" target="_blank" style="line-height:19px">

								</a></p>
						</div>
					</div>
					<div class="pageFormContent" layoutH="80" style="margin-right:230px">




					</div>
				</div>

			</div>
		</div>
	</div>

</div>

<div id="footer">后台综合管理系统</div>

</body>
</html>