<!DOCTYPE html>
<html lang="en" ng-app="app" ng-controller="MainCtrl">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Portal de trueques" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">

	<title>Kambalache</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	<link rel="stylesheet" href="assets/css/skins/yellow.css">

	<script src="assets/js/angular/angular.min.js"></script>
	<script src="assets/js/angular/angular-route.min.js"></script>

	<script src="assets/js/app/app.js"></script>
	<script src="assets/js/app/app.controllers.js"></script>
	<script src="assets/js/app/app.routes.js"></script>
	<script src="assets/js/app/app.services.js"></script>

	<script src="assets/js/app/services/session_service.js"></script>
	<script src="assets/js/app/services/auth_service.js"></script>
	<script src="assets/js/app/services/httpInterceptor_service.js"></script>
	<script src="assets/js/app/services/notifications_service.js"></script>

	<script src="assets/js/app/controllers/main_controller.js"></script>

	<script src="assets/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body">

	<div class="page-container horizontal-menu">


		<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

			<div class="navbar-inner">

				<!-- logo -->
				<div class="navbar-brand">
					<a href="#">
						<img src="assets/images/kambalache-logo-icon.png" width="55" alt="" />
					</a>
				</div>


				<!-- main menu -->

				<ul class="navbar-nav">
					<li>
						<a href="#">
							<i class="entypo-search"></i>
							<span class="title">Busca</span>
						</a>
					</li>
					<li class="has-sub">
						<a href="#">
							<i class="entypo-infinity"></i>
							<span class="title">Intercambia</span>
						</a>
						<ul>
							<li>
								<a href="#">
									<i class="entypo-box"></i>
									<span class="title">Mis Productos</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="entypo-clipboard"></i>
									<span class="title">Mis Ofertas</span>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="entypo-user"></i>
							<span class="title">Mi Perfil</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="entypo-help"></i>
							<span class="title">Ayuda</span>
						</a>
					</li>
				</ul>


				<!-- Logged In View -->
				<ul class="nav navbar-right pull-right" ng-show="session.isAuthed()">

				<li class="dropdown">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="entypo-globe"></i>
						<span class="badge badge-warning">3</span>
					</a>

					<!-- dropdown menu (messages) -->
					<ul class="dropdown-menu">
						<li class="top">
							<p class="small">
								Tienes <strong>3</strong> nuevas notificaciones.
							</p>
						</li>

						<li>
							<ul class="dropdown-menu-list scroller">
								<li class="unread notification-success">
									<a href="#">
										<i class="entypo-user-add pull-right"></i>

										<span class="line">
											<strong>Nueva notificación 1</strong>
										</span>

										<span class="line small">
											Hace 30 segundos
										</span>
									</a>
								</li>

								<li class="unread notification-secondary">
									<a href="#">
										<i class="entypo-heart pull-right"></i>

										<span class="line">
											<strong>Nueva notificación 2</strong>
										</span>

										<span class="line small">
											Hace dos minutos
										</span>
									</a>
								</li>

								<li class="notification-primary">
									<a href="#">
										<i class="entypo-user pull-right"></i>

										<span class="line">
											<strong>Nueva notificación 3</strong>
										</span>

										<span class="line small">
											Hace 3 horas
										</span>
									</a>
								</li>

								<li class="notification-danger">
									<a href="#">
										<i class="entypo-cancel-circled pull-right"></i>

										<span class="line">
											Notificación antigüa 1
										</span>

										<span class="line small">
											Hace 9 horas
										</span>
									</a>
								</li>

								<li class="notification-info">
									<a href="#">
										<i class="entypo-info pull-right"></i>

										<span class="line">
											Notificación antigüa 2
										</span>

										<span class="line small">
											Ayer a las 10:30AM
										</span>
									</a>
								</li>

								<li class="notification-warning">
									<a href="#">
										<i class="entypo-rss pull-right"></i>

										<span class="line">
											Notificación antigüa 3
										</span>

										<span class="line small">
											La semana pasada
										</span>
									</a>
								</li>
							</ul>
						</li>

						<li class="external">
							<a href="#">Ver todas las notificaciones</a>
						</li>					</ul>

					</li>

					<!-- raw links -->
					<li class="dropdown">

						<li class="sep"></li>

						<li>
							<a>
							<i class="entypo-user"></i>{{session.user.first_name + ' ' + session.user.last_name}}
							</a>
						</li>

						<li class="sep"></li>

						<li>
							<a class="pointer" ng-click="session.logOut()">
								Salir <i class="entypo-logout right"></i>
							</a>
						</li>


						<!-- mobile only -->
						<li class="visible-xs">

							<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
							<div class="horizontal-mobile-menu visible-xs">
								<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
									<i class="entypo-menu"></i>
								</a>
							</div>

						</li>

					</ul>

					<!-- Logged Out View -->
					<ul class="nav navbar-right pull-right" ng-hide="session.isAuthed()">
						<li>
							<a class="pointer" ng-click="session.logOut()" data-toggle="modal" data-target=".login-modal">
								<i class="entypo-login"></i>Ingresar
							</a>
						</li>

						<li class="sep"></li>

						<li>
							<a class="pointer" ng-click="session.logOut()">
								Crear Cuenta<i class="entypo-user-add right"></i>
							</a>
						</li>
					</ul>

				</div>

			</header>
			<div class="main-content">

				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="view-content">
								<div ng-view>

								</div>
							</div>
							<footer class="main">

								&copy; 2017 <strong>Kambalache</strong>

							</footer>
						</div>
					</div>
				</div>

			</div>

			<!-- logIn modal -->
			<div class="modal fade login-modal" role="dialog" tabindex="-1" style="display: none;">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Ingresar a Kambalache</h4>
						</div>
						<div class="modal-body">
							<span class="text-danger col-md-offset-3" ng-show="loginError">Correo/Clave Invalidos!</span>
							<br>
							<div>
								 <input type="text" class="form-control login-input" placeholder="Correo Electrónico" ng-model="loginEmail" required>
								 <br>
								  <input type="password" class="form-control login-input" placeholder="Contraseña" ng-model="loginPassword" required>
							 </div>
							 <br>
							 <object class="col-md-offset-5 login-loader" ng-class="!loginLoading ? 'loader-hidden' : 'loader-visible'" type="image/svg+xml" data="assets/images/loader.svg"></object>
							 <br>
							 <br>
							 <span class="col-md-offset-3">¿Olvidaste tu contraseña?</span>
							 <br>
						 </div>
						 <div class="modal-footer">
							 <button type="button" class="btn btn-success" ng-click="doLogin()" ng-disabled="loginLoading">Ingresar</button>
							 <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
						 </div>
					 </div>
				 </div>
			 </div>

			<!-- Bottom scripts (common) -->
			<script src="assets/js/gsap/TweenMax.min.js"></script>
			<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
			<script src="assets/js/bootstrap.js"></script>
			<script src="assets/js/joinable.js"></script>
			<script src="assets/js/resizeable.js"></script>
			<script src="assets/js/neon-api.js"></script>


			<!-- Imported scripts on this page -->
			<script src="assets/js/neon-chat.js"></script>


			<!-- JavaScripts initializations and stuff -->
			<script src="assets/js/neon-custom.js"></script>


			<!-- Demo Settings -->
			<script src="assets/js/neon-demo.js"></script>

		</body>
		</html>
