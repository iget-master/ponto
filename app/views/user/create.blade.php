@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div class="content-wrapper">
			
	{{ Form::open(array('route' => 'user.store', 'id' => 'user')) }}
		<div class='container'>
		<div class='col-md-7'>
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
			<div class="col-md-7">
				<div class="form-group">
					{{ Form::label('email', 'Email:') }}
					{{ Form::text('email', null, array('class' => 'form-control')) }}
					@if ($errors->has('email'))
						{{ $errors->first('email') }}	
					@endif
				</div>
			</div>
			<div class="col-md-5">
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
			<div class="col-md-5">
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
			<div class="col-md-5">
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
			<div id="user-times" class="col-md-5">
				<div class="header">
					<div class="col-lg-4"><span class="day">Dia</span></div>
					<div class="col-lg-3"><span class="time_in" style="margin-left:-5px;">Entrada</span></div>
					<div class="col-lg-3"><span class="time_out" style="margin-left:4px;">Saída</span></div>
				</div>


				<div class="day row">
					<div class="col-lg-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_0', '1') }} Domingo</label></div>
					</div>
					
					@if ($errors->has('day_0_time_in'))
						{{ $errors->first('day_0_time_in') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_0_time_in', (isset($day_0_time_in) ? substr($day_0_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div> 

					@if ($errors->has('day_0_time_out'))
						{{ $errors->first('day_0_time_out') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_0_time_out', (isset($day_0_time_out) ? substr($day_0_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div>
				</div>

				<div class="day row">
					<div class="col-lg-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_1', '1') }} Segunda-feira</label></div>
					</div>
					
					@if ($errors->has('day_1_time_in'))
						{{ $errors->first('day_1_time_in') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_1_time_in', (isset($day_1_time_in) ? substr($day_1_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div> 

					@if ($errors->has('day_1_time_out'))
						{{ $errors->first('day_1_time_out') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_1_time_out', (isset($day_1_time_out) ? substr($day_1_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div>
				</div>

				<div class="day row">
					<div class="col-lg-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_2', '1') }} Terça-feira</label></div>
					</div>
					
					@if ($errors->has('day_2_time_in'))
						{{ $errors->first('day_2_time_in') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_2_time_in', (isset($day_2_time_in) ? substr($day_2_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div> 

					@if ($errors->has('day_2_time_out'))
						{{ $errors->first('day_2_time_out') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_2_time_out', (isset($day_2_time_out) ? substr($day_2_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div>
				</div>

				<div class="day row">
					<div class="col-lg-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_3', '1') }} Quarta-feira</label></div>
					</div>
					
					@if ($errors->has('day_3_time_in'))
						{{ $errors->first('day_3_time_in') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_3_time_in', (isset($day_3_time_in) ? substr($day_3_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div> 

					@if ($errors->has('day_3_time_out'))
						{{ $errors->first('day_3_time_out') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_3_time_out', (isset($day_3_time_out) ? substr($day_3_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div>
				</div>

				<div class="day row">
					<div class="col-lg-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_4', '1') }} Quinta-feira</label></div>
					</div>
					
					@if ($errors->has('day_4_time_in'))
						{{ $errors->first('day_4_time_in') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_4_time_in', (isset($day_4_time_in) ? substr($day_4_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div> 

					@if ($errors->has('day_4_time_out'))
						{{ $errors->first('day_4_time_out') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_4_time_out', (isset($day_4_time_out) ? substr($day_4_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div>
				</div>

				<div class="day row">
					<div class="col-lg-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_5', '1') }} Sexta-feira</label></div>
					</div>
					
					@if ($errors->has('day_5_time_in'))
						{{ $errors->first('day_5_time_in') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_5_time_in', (isset($day_5_time_in) ? substr($day_5_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div> 

					@if ($errors->has('day_5_time_out'))
						{{ $errors->first('day_5_time_out') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_5_time_out', (isset($day_5_time_out) ? substr($day_5_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div>
				</div>

				<div class="day row">
					<div class="col-lg-4">
						<div class="checkbox"><label>{{Form::checkbox('day_check_6', '1') }} Sábado</label></div>
					</div>
					
					@if ($errors->has('day_6_time_in'))
						{{ $errors->first('day_6_time_in') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_6_time_in', (isset($day_6_time_in) ? substr($day_6_time_in,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div> 

					@if ($errors->has('day_6_time_out'))
						{{ $errors->first('day_6_time_out') }}
					@else
						<div class="col-lg-3">
					@endif
						{{Form::text('day_6_time_out', (isset($day_6_time_out) ? substr($day_6_time_out,0,-3) : null), array('class' => 'form-control', 'disabled'=>'true'))}}</div>
				</div>

			</div>
		</div>
	{{ Form::close() }}
	</div>
@stop

@section('title')
	Criar novo usuário
@stop

@section('toolbar')
	<a role="submit" data-form="#user" class="btn btn-round primary"><i class="fa fa-check"></i></a>
	<a href="/user" class="btn btn-round btn-sm warning"><i class="fa fa-arrow-left"></i></a>
@stop
@section('script')
	{{ HTML::script('js/app/users.js') }}
@stop