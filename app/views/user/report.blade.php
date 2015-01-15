@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div id="dashboard" class="content-wrapper">
		<div class="row">
			<?php
				if(!isset($month) && !isset($year)){
					$m = date('m');
					$y = date('Y');
				} else{
					$m = $month;
					$y = $year;
				}
			?>

			{{ Form::open(array("action"=>array("UserController@report",$id))) }}
			<div class="form-inline">
				<div class="form-group">
					{{ Form::select("month", array(
						"1" => "Janeiro", 
						"2" => "Fevereiro", 
						"3" => "Março", 
						"4" => "Abril", 
						"5" => "Maio", 
						"6" => "Junho", 
						"7" => "Julho", 
						"8" => "Agosto", 
						"9" => "Setembro", 
						"10" => "Outubro", 
						"11" => "Novembro", 
						"12" => "Dezembro" 
						), $m ,array("class" => "form-control", "style"=>"font-size:16px;"))
					}}
				</div>
				<div class="form-group">
					{{ Form::selectYear("year", date('Y'), 2010, $y , array("class"=>"form-control", "style"=>"font-size:16px;")) }}
				</div>
				<div class="form-group">
					{{ Form::submit("Gerenciar",array("class"=>"btn btn-primary")) }}
				</div>
			</div>
			{{ Form::close() }}
		</div><hr />
		<div class="row">
			<table id="report_table" class="table table-condensed" >
				<thead>
					<th id="report_day">Dia</th>
					<th id="report_time_in">Hora de Entrada</th>
					<th id="report_time_out">Hora de Saída</th>
				</thead>
				<tbody>
				<?php
					if(!isset($month) && !isset($year)){
						$month = date('m');
						$year = date('Y');
					}
				?>
			@for ($i=1;$i<32;$i++)
				<?php 
					$timestamp = strtotime("${year}-${month}-${i}");
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