<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>統義玻璃行政資訊</title>
    <!-- Required Stylesheets -->
    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('/css/fileinput.min.css') }}">

    <!-- Required Javascript -->
    <script src="{{ url('/script/jquery-3.1.0.min.js') }}"></script>
	<script src="{{ url('/script/fileupload/plugins/canvas-to-blob.min.js') }}"></script>
	<script src="{{ url('/script/fileupload/plugins/sortable.min.js') }}"></script>
	<script src="{{ url('/script/fileupload/plugins/purify.min.js') }}"></script>
	<script src="{{ url('/script/fileinput.min.js') }}"></script>
	<script src="{{ url('/script/fileupload/themes/fa/theme.js') }}"></script>
	<script src="{{ url('/script/fileupload/locales/zh-TW.js') }}"></script>
	<script src="{{ url('/script/bootstrap.min.js') }}"></script>
	<script src="{{ url('/script/jquery.form.min.js') }}"></script>
	<script src="{{ url('/script/vue.js') }}"></script>
	<script src="{{ url('/script/moment-with-locales.min.js') }}"></script>
	<script>
		window.baseurl = "{{ url('/') }}"
	</script>
</head>
<body style="padding-top: 70px;">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand">統義玻璃行政資訊</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="nav-bar">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/nav/manage.laborLaw') }}">管理部</a></li>
					<li><a href="{{ url('/production/today') }}">生產部</a></li>
					<li><a href="">環安室</a></li>
					<!--
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">管理部<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">勞工法令</a></li>
							<li><a href="#">工作規則</a></li>
							<li><a href="#">人事及獎懲公告</a></li>
							<li><a href="#">法律園地</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">生產部<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">當日生產線一覽</a></li>
							<li><a href="#">瓶號生產資料查詢</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">環安室<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">SA8000社會責任標準</a></li>
							<li><a href="#">勞工安全衛生管理</a></li>
							<li><a href="#">ISO9001品質管理</a></li>
							<li><a href="#">緊急應變計畫管理</a></li>
							<li><a href="#">消防管理</a></li>
						</ul>
					</li>
					-->
				</ul>
				<ul class="nav navbar-nav navbar-right">
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	
	<div class="container">
		<div class="content" id="app">
			@yield('content')
		</div>
	</div>
	<!--<script src="{{ asset('js/app.js') }}"></script>-->
</body>
</html>