@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div id="dashboard" class="content-wrapper">
		<div class="row">
			<h3>Alteração de Ponto</h3><hr />

			@if(Timetables::getDay(strtotime($date),$id))
			<div class="col-md-3">
				<label>Hora de Entrada:</label> {{ Timetables::getDay(strtotime($date),$id)->time_in }}<br />
				<label>Hora de Saida:</label> {{ Timetables::getDay(strtotime($date),$id)->time_out }}
			</div>
			<div class="col-md-9">
				<h4>Editar Horários</h4>
				{{ Form::open(['route'=>array('report.store','date' => $date,'id'=>$id )]) }}
					<div class="form-group col-md-4">
					{{ Form::label('time_in','Entrada')}}
					{{ Form::text('time_in',substr(Timetables::getDay(strtotime($date),$id)->time_in, 0, -3),array('class'=>'form-control')) }}
					</div>
					<div class="form-group col-md-4">
					{{ Form::label('time_out','Saída')}}
					{{ Form::text('time_out',substr(Timetables::getDay(strtotime($date),$id)->time_out, 0, -3),array('class'=>'form-control')) }}
					</div>
					<div class="form-group col-md-5">
					{{ Form::submit('Editar',array('class'=>'btn btn-primary', 'name'=>'submit')) }}
					{{ Form::submit('Apagar',array('class'=>'btn btn-danger', 'name'=>'submit')) }}
					</div>
				{{ Form::close() }}
			</div>
			@else
			<div class="col-md-3">
				<label>Não há registros nesse dia!</label>
			</div>
			<div class="col-md-9">
				<h4>Adicionar Horário</h4>
				{{ Form::open(['route'=>array('report.store','date' => $date,'id'=>$id )]) }}
					<div class="form-group col-md-4">
					{{ Form::label('time_in','Entrada')}}
					{{ Form::text('time_in',null,array('class'=>'form-control')) }}
					@if ($errors->has('time_in'))
						{{ $errors->first('time_in') }}	
					@endif
					</div>
					<div class="form-group col-md-4">
					{{ Form::label('time_out','Saída')}}
					{{ Form::text('time_out',null,array('class'=>'form-control')) }}
					@if ($errors->has('time_out'))
						{{ $errors->first('time_out') }}	
					@endif
					</div>
					<div class="form-group col-md-5">
					{{ Form::submit('Adicionar',array('class'=>'btn btn-primary', 'name'=>'submit')) }}
					</div>
				{{ Form::close() }}
			</div>
			@endif



		</div>
	</div>
@stop

@section('title')
	Editar Relatório
@stop

@section('script')
	{{ HTML::script('js/app/users.js') }}
@stop