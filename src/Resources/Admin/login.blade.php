<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Login </title>
    <link rel="shortcut icon" href="{{asset('logo.ico')}}"/>
    <link rel="stylesheet" href="{{asset('vendor/csm/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/csm/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/csm/css/font-awesome.css')}}">  
</head>
<body>
  <div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('images/bg-admin.jpg')}}');">
		<div class="wrap-login100 p-t-190 p-b-30">
			<form class="login100-form validate-form" method="post" action="{{route('admin.login')}}">
				@csrf
				<div class="login100-form-logo p-b-30">
					<img src="{{asset('images/logo_admin.png')}}" alt=""/> 
				</div>
				<div class="login100-form-logo p-b-30">
					<h5 style="font-size:18px; color: #fff; text-align:center;">Đăng nhập hệ thống quản trị website {!!env('APP_NAME')!!} </h5>
				</div>
				<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
					<input class="input100 {{$errors->has('username') ? ' is-invalid' : ''}}" type="text" name="username" required value="{{ old('username') }}" placeholder="Tên đăng nhập">
					<span class="focus-input100"></span>
					<span class="symbol-input100"><i class="fa fa-user"></i></span>
				</div>
				@if ($errors->has('username'))
						<span class="invalid-feedback">
						<strong>{{ $errors->first('username') }}</strong>
						</span>
				@endif
				<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
					<input class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Mật khẩu">
					<span class="focus-input100"></span>
					<span class="symbol-input100"><i class="fa fa-lock"></i></span>
					@if ($errors->has('password'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
				<div class="container-login100-form-btn p-t-10">
					<button class="login100-form-btn">Đăng nhập</button>
				</div>
			</form>
		</div>		
    </div>
  </div>
  @if(Session::has('Flass_Message'))
    <script Language='JavaScript'>
      alert('{!!Session::get('Flass_Message')!!}');
    </script>
  @endif
</body>
</html>
