@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div class="content-wrapper">
		<div class="calendar">
			<p class="month">DEZEMBRO</p>
			<ul class="weekdays">
				<li>DOM</li>
				<li>SEG</li>
				<li>TER</li>
				<li>QUA</li>
				<li>QUI</li>
				<li>SEX</li>
				<li>SAB</li>
			</ul>
			<ul class="week">
				<li class="disabled">30</li>
				<li>1</li>
				<li>2</li>
				<li>3</li>
				<li>4</li>
				<li>5</li>
				<li>6</li>
			</ul>
			<ul class="week">
				<li>7</li>
				<li>8</li>
				<li>9</li>
				<li>10</li>
				<li>11</li>
				<li>12</li>
				<li>13</li>
			</ul>
			<ul class="week">
				<li>14</li>
				<li>15</li>
				<li>16</li>
				<li>17</li>
				<li>18</li>
				<li>19</li>
				<li>20</li>
			</ul>
			<ul class="week">
				<li>21</li>
				<li>22</li>
				<li>23</li>
				<li>24</li>
				<li>25</li>
				<li>26</li>
				<li>27</li>
			</ul>
			<ul class="week">
				<li>28</li>
				<li>29</li>
				<li>30</li>
				<li>31</li>
				<li class="disabled">1</li>
				<li class="disabled">2</li>
				<li class="disabled">3</li>
			</ul>
			<ul class="week">
				<li class="disabled">4</li>
				<li class="disabled">5</li>
				<li class="disabled">6</li>
				<li class="disabled">7</li>
				<li class="disabled">8</li>
				<li class="disabled">9</li>
				<li class="disabled">10</li>
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
