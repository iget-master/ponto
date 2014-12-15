<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSS are placed here -->
    {{ HTML::style('http://fonts.googleapis.com/css?family=Roboto:300,700,400') }}
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}
    {{ HTML::style('css/app.css') }}
</head>
<body>
	<div class="container-fluid">
		<div id="login-container" class="col-md-4 col-md-offset-4">
				@if (Session::get('alert'))
					<div class="alert alert-{{ Session::get('alert')["type"] }}">
						{{ Session::get('alert')["message"] }}
					</div>
				@endif

				{{ Form::open(array('route' => 'session.store')) }}
					<div class="form-group">
						{{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::label('password', 'Senha:') }}
						{{ Form::password('password', array('class' => 'form-control')) }}
					</div>
					{{ Form::button('<i class="fa fa-check"></i> Entrar', array('type'=>'submit', 'class' => 'btn btn-primary pull-right')) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>

	<!-- Scripts are placed here -->
    {{ HTML::script('//code.jquery.com/jquery-2.1.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>