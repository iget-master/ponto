@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div id="dashboard" class="content-wrapper">
		<div class="row">
			<div class="col-md-3">
				<div class="calendar">
					<p class="month">{{ $calendar["month_name"] }}</p>
					<ul class="weekdays">
						<li>DOM</li>
						<li>SEG</li>
						<li>TER</li>
						<li>QUA</li>
						<li>QUI</li>
						<li>SEX</li>
						<li>SAB</li>
					</ul>
					@for ($i = 0; $i < 6; $i++)
						<ul class="week">
					    @for ($j = $i*7; $j < (($i*7)+7); $j++)
					    	<li class="{{ $calendar["days"][$j]["class"] }}">
					    		{{ date("j", $calendar["days"][$j]["date"]) }}
					    	</li>
					    @endfor
						</ul>
					@endfor
				</div>
			</div>
			<div class="col-md-9">
				<div class="block-row clearfix">
					<div class="block">
						<p class="title">{{ $statistics["dias_trabalhados"] }}</p>
						<p class="subtitle">Dias trabalhados</p>
					</div>
					<div class="block">
						<p class="title">{{ $statistics["faltas"] }}</p>
						<p class="subtitle">Faltas</p>
					</div>
				</div>
				<div class="block-row clearfix">
					<div class="block">
						<p class="title">{{ $statistics["atrasos"] }}</p>
						<p class="subtitle">Atrasos</p>
					</div>
					<div class="block">
						<p class="title">{{ $statistics["pontualidade"] }}%</p>
						<p class="subtitle">Pontualidade</p>
					</div>
				</div>
				<div class="block-row clearfix">
					<div class="block">
						<p class="title">{{ round(($statistics["dias_trabalhados"] / $statistics["dias"]) * 100) }}% </p>
						<p class="subtitle">Presença</p>
					</div>
					<!-- <div class="block">
						<p class="title">3</p>
						<p class="subtitle">Faltas</p>
					</div> -->
				</div>
			</div>
		</div>
	</div>
@stop

@section('title')
	Início
@stop

@section('toolbar')
	@if (is_null($timetable = Timetables::getToday()))
		<a href="/arrival" class="btn btn-round primary" title="Estou entrando"><i class="fa fa-sign-in"></i></a>
	@elseif (is_null($timetable->time_out))
		<a href="/departure" class="btn btn-round primary" title="Estou saindo"><i class="fa fa-sign-out"></i></a>
	@endif
@stop
