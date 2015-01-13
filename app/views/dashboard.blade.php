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
			<div class="col-md-4">
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
						<p class="title">{{ $statistics["presenca"] }}% </p>
						<p class="subtitle">Presença</p>
					</div>
					<!-- <div class="block">
						<p class="title">3</p>
						<p class="subtitle">Faltas</p>
					</div> -->
				</div>
			</div>
			<div class="col-md-4" align="center">
				<canvas id="example" width="300px" height="300px">Testando o relogio</canvas>
				<?php 
					if(Timetables::getToday()){
						if($timeIn = Timetables::getToday()->time_in){
							$timeIn_h = substr($timeIn, 0, -6);
							$timeIn_m = substr($timeIn, -5,-3);
							$timeIn_s = substr($timeIn, -2);
						} else{
							$timeIn_h = "hrs";
							$timeIn_m = "min";
							$timeIn_s = "sec";
						}
						if($timeOut = Timetables::getToday()->time_out){
							$timeOut_h = substr($timeOut, 0, -6);
							$timeOut_m = substr($timeOut, -5, -3);
							$timeOut_s = substr($timeOut, -2);
						} else{
							$timeOut_h = "hrs";
							$timeOut_m = "min";
							$timeOut_s = "sec";
						}
					} else{
						$timeIn_h = "hrs";
						$timeIn_m = "min";
						$timeIn_s = "sec";

						$timeOut_h = "hrs";
						$timeOut_m = "min";
						$timeOut_s = "sec";
					}

				?>
				    	
				<script type="application/x-javascript">
					draw();
				    function draw() {
				        //Fetch the current time
				        var now=new Date();
				        var hrs=now.getHours();
				        var min=now.getMinutes();
				        var sec=now.getSeconds();

				        var timeIn_s = {{$timeIn_s}};
					    var timeIn_m = {{$timeIn_m}};
					    var timeIn_h = {{$timeIn_h}};
					
				        var timeOut_s = {{$timeOut_s}};
					    var timeOut_m = {{$timeOut_m}};
					    var timeOut_h = {{$timeOut_h}};

					    console.log(timeIn_s, timeIn_m ,timeIn_h);
					    console.log(timeOut_s, timeOut_m ,timeOut_h);

				      	var canvas = document.getElementById('example');
				        var c2d=canvas.getContext('2d');
						c2d.moveTo(150,150);
						c2d.arc(150,150,120,0,90);
						c2d.lineTo(150,150);
						c2d.stroke();

						c2d.clearRect(0,0,300,300);


				        c2d.font="Bold 20px Arial";
				        c2d.textBaseline="middle";
				        c2d.textAlign="center";
				        c2d.lineWidth=1;
				        c2d.save();
				        //Inner bezel
				        c2d.restore();
				        c2d.strokeStyle="#263238";
				        c2d.lineWidth=5;
				        c2d.beginPath();
				        c2d.arc(150,150,129,0,Math.PI*2,true);
				        c2d.stroke();
				        c2d.strokeStyle="#546E7A";
				        c2d.save();

				        c2d.moveTo(150,150);
				        c2d.lineTo(150,150);


				        var angleIn = (Math.PI/6*(timeIn_h+(timeIn_m/60)+(timeIn_s/3600))) - 1.57;
				        var angleOut = (Math.PI/6*(timeOut_h+(timeOut_m/60)+(timeOut_s/3600))) - 1.57;

				        c2d.arc(150,150,127, angleOut, angleIn);
				        
				        c2d.fillStyle = "rgba(0, 0, 200, 0.5)";
				        c2d.fill();

				        c2d.translate(150,150);
				        //Markings/Numerals
				        for (i=1;i<=60;i++) {
				          ang=Math.PI/30*i;
				          sang=Math.sin(ang);
				          cang=Math.cos(ang);
				          //If modulus of divide by 5 is zero then draw an hour marker/numeral
				          if (i % 5 == 0) {
				            c2d.lineWidth=2;
				            sx=sang*95;
				            sy=cang*-95;
				            ex=sang*120;
				            ey=cang*-120;
				            nx=sang*80;
				            ny=cang*-80;
				            //writes the numbers
				            //c2d.fillStyle = "rgb(0, 0, 0)";
				            //c2d.fillText(i/5,nx,ny);
				          //Else this is a minute marker
				          } else {
				            c2d.lineWidth=1;
				            sx=sang*110;
				            sy=cang*110;
				            ex=sang*120;
				            ey=cang*120;
				          }
				          c2d.beginPath();
				          c2d.moveTo(sx,sy);
				          c2d.lineTo(ex,ey);
				          c2d.stroke();
				        }

						
				        
				        c2d.strokeStyle="#000";
				        c2d.lineWidth=6;
				        c2d.save();
				        //Draw clock pointers but this time rotate the canvas rather than
				        //calculate x/y start/end positions.
				        //
				        //Draw hour hand
				        c2d.rotate(Math.PI/6*(hrs+(min/60)+(sec/3600)));
				        c2d.beginPath();
				        c2d.moveTo(0,10);
				        c2d.lineTo(0,-60);
				        c2d.stroke();
				        c2d.restore();
				        c2d.lineWidth=4;
				        c2d.save();
				        //Draw minute hand
				        c2d.rotate(Math.PI/30*(min+(sec/60)));
				        c2d.beginPath();
				        c2d.moveTo(0,20);
				        c2d.lineTo(0,-100);
				        c2d.stroke();
		        		c2d.restore();

				      	
				        
				        //Additional restore to go back to state before translate
				        //Alternative would be to simply reverse the original translate
				        c2d.restore();
				        setTimeout(draw,1000);


				  	}	   
				</script>
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
