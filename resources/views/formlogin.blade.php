
<!DOCTYPE html>
<html>
	<head>
		<title>Mantep2 v1.0 | LOG-IN</title>
		<meta charset="utf-8">
		<meta content="ie=edge" http-equiv="x-ua-compatible">
		<meta content="template language" name="keywords">
		<meta content="Maptep2 v1.0" name="author">
		<meta content="Aplikasi Management Properti" name="description">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<link href="favicon.png" rel="shortcut icon">
		<link href="apple-touch-icon.png" rel="apple-touch-icon">
		
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/main.css"/>
        <style>
            .field-error { color: #e33244; }
        </style>
		
	</head>
	<body>
		<div class="auth-wrapper">
			<div class="auth-header">
				<div class="auth-title">Mantep2 v1.0</div>
				<div class="auth-subtitle">MANagement Tata kElola Properti</div>
				<div class="auth-label">Silahkan Login</div>
			</div>
			<div class="auth-body">
                <form class="form" id="form">
				<div class="auth-content">
					<div class="form-group">
						<label>Nama User</label>
						<input class="form-control" placeholder="masukkan user login" type="text" name="txtuser" id="txtuser">
					</div>
					<div class="form-group">
						<label>Kata Sandi</label>
						<input class="form-control" placeholder="masukkan kata sandi" type="password" name="txtpass" id="txtpass">
					</div>
				</div>
				<div class="auth-footer sm-text-center">
					<button type="submit" class="btn btn-primary sm-max">M A S U K</button>
                </div>
                </form>
			</div>
        </div>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/app.js"></script>

        <script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
        <script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
        <script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>
        <script src="scripts/login.js"></script>
	</body>
</html>