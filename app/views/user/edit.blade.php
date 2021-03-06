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
				<div class="row header">
					<div class="col-xs-4"><span class="day">Dia</span></div>
					<div class="col-xs-3"><span class="time_in">Entrada</span></div>
					<div class="col-xs-3"><span class="time_out">Saída</span></div>
				</div>


				<div class="day row">
					<div class="col-xs-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_0', '1', (isset($day_0_time_in) || isset($day_0_time_out))) }} Domingo</label></div>
					</div>
					<div class="col-xs-3 @if ($errors->has('day_0_time_in')) has-error @endif">
						{{Form::text('day_0_time_in', (isset($day_0_time_in) ? substr($day_0_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div> 
					<div class="col-xs-3 @if ($errors->has('day_0_time_out')) has-error @endif">
						{{Form::text('day_0_time_out', (isset($day_0_time_out) ? substr($day_0_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div>
				</div>

				<div class="day row">
					<div class="col-xs-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_1', '1', (isset($day_1_time_in) || isset($day_1_time_out))) }} Segunda-feira</label></div>
					</div>
					<div class="col-xs-3 @if ($errors->has('day_1_time_in')) has-error @endif">
						{{Form::text('day_1_time_in', (isset($day_1_time_in) ? substr($day_1_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div> 
					<div class="col-xs-3 @if ($errors->has('day_1_time_out')) has-error @endif">
						{{Form::text('day_1_time_out', (isset($day_1_time_out) ? substr($day_1_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div>
				</div>
				<div class="day row">
					<div class="col-xs-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_2', '1', (isset($day_2_time_in) || isset($day_2_time_out))) }} Terça-feira</label></div>
					</div>
					<div class="col-xs-3 @if ($errors->has('day_2_time_in')) has-error @endif">
						{{Form::text('day_2_time_in', (isset($day_2_time_in) ? substr($day_2_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div> 
					<div class="col-xs-3 @if ($errors->has('day_2_time_out')) has-error @endif">
						{{Form::text('day_2_time_out', (isset($day_2_time_out) ? substr($day_2_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div>
				</div>
				<div class="day row">
					<div class="col-xs-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_3', '1', (isset($day_3_time_in) || isset($day_3_time_out))) }} Quarta-feira</label></div>
					</div>
					<div class="col-xs-3 @if ($errors->has('day_3_time_in')) has-error @endif">
						{{Form::text('day_3_time_in', (isset($day_3_time_in) ? substr($day_3_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div> 
					<div class="col-xs-3 @if ($errors->has('day_3_time_out')) has-error @endif">
						{{Form::text('day_3_time_out', (isset($day_3_time_out) ? substr($day_3_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div>
				</div>
				<div class="day row">
					<div class="col-xs-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_4', '1', (isset($day_4_time_in) || isset($day_4_time_out))) }} Quinta-feira</label></div>
					</div>
					<div class="col-xs-3 @if ($errors->has('day_4_time_in')) has-error @endif">
						{{Form::text('day_4_time_in', (isset($day_4_time_in) ? substr($day_4_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div> 
					<div class="col-xs-3 @if ($errors->has('day_4_time_out')) has-error @endif">
						{{Form::text('day_4_time_out', (isset($day_4_time_out) ? substr($day_4_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div>
				</div>
				<div class="day row">
					<div class="col-xs-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_5', '1', (isset($day_5_time_in) || isset($day_5_time_out))) }} Sexta-feira</label></div>
					</div>
					<div class="col-xs-3 @if ($errors->has('day_5_time_in')) has-error @endif">
						{{Form::text('day_5_time_in', (isset($day_5_time_in) ? substr($day_5_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div> 
					<div class="col-xs-3 @if ($errors->has('day_5_time_out')) has-error @endif">
						{{Form::text('day_5_time_out', (isset($day_5_time_out) ? substr($day_5_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div>
				</div>
				<div class="day row">
					<div class="col-xs-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_6', '1', (isset($day_6_time_in) || isset($day_6_time_out))) }} Sábado</label></div>
					</div>
					<div class="col-xs-3 @if ($errors->has('day_6_time_in')) has-error @endif">
						{{Form::text('day_6_time_in', (isset($day_6_time_in) ? substr($day_6_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div> 
					<div class="col-xs-3 @if ($errors->has('day_6_time_out')) has-error @endif">
						{{Form::text('day_6_time_out', (isset($day_6_time_out) ? substr($day_6_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}
					</div>
				</div>


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
	{{ Form::open(array('method'=>'DELETE', 'route' => array('user.destroy', $user->id))) }}
		<button type="submit" class="btn btn-round btn-sm danger"><i class="fa fa-trash-o"></i></button>
	{{ Form::close() }}
@stop

@section('script')
	{{ HTML::script('js/app/users.js') }}
@stop