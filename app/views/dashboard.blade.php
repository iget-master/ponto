@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div class="content-wrapper">
		<div class="calendar">
			<ul class="title">
				<li>D</li>
				<li>S</li>
				<li>T</li>
				<li>Q</li>
				<li>Q</li>
				<li>S</li>
				<li>S</li>
			</ul>
		</div>
	</div>
@stop

@section('title')
	Início
@stop

@section('toolbar')
	<a href="/user/create" class="btn btn-round primary" title="Estou entrando"><i class="fa fa-sign-in"></i></a>
	<a href="/user/create" class="btn btn-round primary" title="Estou saindo"><i class="fa fa-sign-out"></i></a>
@stop
