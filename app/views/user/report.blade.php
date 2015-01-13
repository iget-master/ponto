@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div id="dashboard" class="content-wrapper">
		<div class="row">
			<h2>{{ date('M') }} / {{ date('Y') }}</h2>
		</div>
		<div class="row">
			<table id="report_table" class="table table-condensed" >
				<thead>
					<th id="report_day">Dia</th>
					<th id="report_time_in">Hora de Entrada</th>
					<th id="report_time_out">Hora de Saída</th>
				</thead>
				<tbody>
				<?php
					$month = date('m');
					$current_year = date('Y');
				?>
			@for ($i=1;$i<32;$i++)
				<?php 
					$timestamp = strtotime("${current_year}-${month}-${i}");
					$time = Timetables::getDay($timestamp,$id);
						if(!is_null($time)){
							$time_in = substr($time->time_in, 0, -3);
							$time_out = substr($time->time_out, 0, -3);
						} else{
							$time_in = $time_out = "";
						}
				 ?>

				<tr>
					<td>{{ $i }}</td>
					<td>{{ $time_in }}</td>
					<td>{{ $time_out }}</td>
				</tr>
			@endfor
				</tbody>
			</table>

		</div>
	</div>
@stop

@section('title')
	Relatórios
@stop

@section('toolbar')
	<a href="/user/create" class="btn btn-round primary"><i class="fa fa-plus"></i></a>
    {{ Form::open(array('method'=>'DELETE', 'id'=>'delete_users', 'route' => array('user.multiple_destroy'))) }}
		<button type="submit" class="btn btn-round btn-sm btn-bulk danger"><i class="fa fa-trash-o"></i></button>
	{{ Form::close() }}
@stop

@section('script')
	{{ HTML::script('js/app/users.js') }}
@stop