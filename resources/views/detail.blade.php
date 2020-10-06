@extends('template')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<br>
		</div>
		<div class="col-md-12">
			<div class="float-right">
				
				<a class="btn btn-danger" href="{{URL::to('/')}}" style="letter-spacing: 4px;"><b>Back</b></a>
				
			</div>
		</div>
		<div class="col-md-12">
			<br>
		</div>
	</div>
	<div class="row" id="movieList">
		@foreach($list as $key => $row)
			<div class="col-lg-4 col-md-4 col-xs-12" style="height: 500px;">
				<div class="row" style="padding: 10px;">
					<div class="col-md-12 text-white bg-dark">
						<div style="background-image: url('{{URL::to('/assets/img/'.$row->picture)}}'); background-size: 100%; background-position: center; background-repeat: no-repeat; background-color: black; width: 100%; height: 425px; padding-top: 275px;">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-xs-12">
				<h2>{{$row->movie_name}} </h2>
				<hr>
				<p><b>Duration: </b>{{$row->duration}} Minutes</p>
				<p class="text-muted">{{$row->description}}<p>
			</div>
		@endforeach

		@if(count($list)==0)
			<div class="col-md-12">
				<center><h1>there is no movies</h1></center>
			</div>
		@endif
	</div>
@endsection
