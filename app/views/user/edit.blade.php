@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div class="content-wrapper">
			
	{{ Form::model($user, ['method'=>'PATCH', 'route'=>['user.update', $user->id], 'id'=>'user']) }}
		<div class="row">
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('name', 'Nome:') }}
							{{ Form::text('name', null, array('class' => 'form-control')) }}
							@if ($errors->has('name'))
								{{ $errors->first('name') }}	
							@endif
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('surname', 'Sobrenome:') }}
							{{ Form::text('surname', null, array('class' => 'form-control')) }}
							@if ($errors->has('surname'))
								{{ $errors->first('surname') }}	
							@endif
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							{{ Form::label('email', 'Email:') }}
							{{ Form::text('email', null, array('class' => 'form-control')) }}
							@if ($errors->has('email'))
								{{ $errors->first('email') }}	
							@endif
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('level', 'Email:') }}
							{{ Form::select('level', array('1' => 'Funcionário', '2' => 'Gerente'), null, array('class' => 'form-control')) }}
							@if ($errors->has('level'))
								{{ $errors->first('level') }}	
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="checkbox">
						    <label>
								<input type="checkbox" role="toggle" data-target="#password-container"> Alterar senha
						    </label>
						</div>
					</div>
				</div>
				<div id="password-container" class="hide">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('password', 'Senha:') }}
								{{ Form::password('password', array('class' => 'form-control')) }}
								@if ($errors->has('password'))
									{{ $errors->first('password') }}	
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('password_confirmation', 'Confirme a senha:') }}
								{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
								@if ($errors->has('password_confirmation'))
									{{ $errors->first('password_confirmation') }}	
								@endif
							</div>
						</div>
					</div>
				</div>				
			</div>
			<div id="user-times" class="col-md-5">
				<div class="header">
					<span class="day">Dia</span>
					<span class="time_in">Entrada</span>
					<span class="time_out">Saída</span>
				</div>
				<div class="day"><div class="checkbox"><label>{{Form::checkbox('day_check_0', '1') }} Domingo</label></div> {{Form::text('day_0_time_in', (isset($day_0_time_in) ? $day_0_time_in : null), array('class' => 'form-control', 'disabled'=>'true'))}} {{Form::text('day_0_time_out', (isset($day_0_time_out) ? $day_0_time_out : null), array('class' => 'form-control', 'disabled'=>'true'))}} </div>
				<div class="day"><div class="checkbox"><label>{{Form::checkbox('day_check_1', '1') }} Segunda-feira</label></div> {{Form::text('day_1_time_in', (isset($day_1_time_in) ? $day_1_time_in : null), array('class' => 'form-control', 'disabled'=>'true'))}} {{Form::text('day_1_time_out', (isset($day_1_time_out) ? $day_1_time_out : null), array('class' => 'form-control', 'disabled'=>'true'))}} </div>
				<div class="day"><div class="checkbox"><label>{{Form::checkbox('day_check_2', '1') }} Terça-feira</label></div> {{Form::text('day_2_time_in', (isset($day_2_time_in) ? $day_2_time_in : null), array('class' => 'form-control', 'disabled'=>'true'))}} {{Form::text('day_2_time_out', (isset($day_2_time_out) ? $day_2_time_out : null), array('class' => 'form-control', 'disabled'=>'true'))}} </div>
				<div class="day"><div class="checkbox"><label>{{Form::checkbox('day_check_3', '1') }} Quarta-feira</label></div> {{Form::text('day_3_time_in', (isset($day_3_time_in) ? $day_3_time_in : null), array('class' => 'form-control', 'disabled'=>'true'))}} {{Form::text('day_3_time_out', (isset($day_3_time_out) ? $day_3_time_out : null), array('class' => 'form-control', 'disabled'=>'true'))}} </div>
				<div class="day"><div class="checkbox"><label>{{Form::checkbox('day_check_4', '1') }} Quinta-feira</label></div> {{Form::text('day_4_time_in', (isset($day_4_time_in) ? $day_4_time_in : null), array('class' => 'form-control', 'disabled'=>'true'))}} {{Form::text('day_4_time_out', (isset($day_4_time_out) ? $day_4_time_out : null), array('class' => 'form-control', 'disabled'=>'true'))}} </div>
				<div class="day"><div class="checkbox"><label>{{Form::checkbox('day_check_5', '1') }} Sexta-feira</label></div> {{Form::text('day_5_time_in', (isset($day_5_time_in) ? $day_5_time_in : null), array('class' => 'form-control', 'disabled'=>'true'))}} {{Form::text('day_5_time_out', (isset($day_5_time_out) ? $day_5_time_out : null), array('class' => 'form-control', 'disabled'=>'true'))}} </div>
				<div class="day"><div class="checkbox"><label>{{Form::checkbox('day_check_6', '1') }} Sábado</label></div> {{Form::text('day_6_time_in', (isset($day_6_time_in) ? $day_6_time_in : null), array('class' => 'form-control', 'disabled'=>'true'))}} {{Form::text('day_6_time_out', (isset($day_6_time_out) ? $day_6_time_out : null), array('class' => 'form-control', 'disabled'=>'true'))}} </div>
			</div>
		</div>
	{{ Form::close() }}
	</div>
@stop

@section('title')
	Modificar usuário
@stop

@section('toolbar')
	<a role="submit" data-form="#user" class="btn btn-round primary"><i class="fa fa-check"></i></a>
	<a href="/user" class="btn btn-round btn-sm warning"><i class="fa fa-arrow-left"></i></a>
	<a class="btn btn-round btn-sm danger"><i class="fa fa-trash-o"></i></a>
@stop

@section('script')
	{{ HTML::script('js/app/users.js') }}
@stop