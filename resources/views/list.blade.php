@extends('template')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<br>
		</div>
		<div class="col-md-12">
			<div class="float-right">
				
				<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><b>+ Add Movie</b></button>
				
			</div>
		</div>
		<div class="col-md-12">
			<br>
		</div>
	</div>
	<div class="row" id="movieList">
		@foreach($list as $key => $row)
			<div class="col-lg-4 col-md-6 col-xs-12" style="height: 500px;">
				<div class="row" style="padding: 10px;">
					<div class="col-md-12 text-white bg-dark">
						<h2>{{$row->movie_name}} <div class="float-right"><span style="right: 0px; " class="badge badge-danger">{{$row->duration}} m</span></div></h2>
							<div class="float-left">
								<a class="btn btn-light" href="{{URL::to('/detailMovie/'.bin2hex(json_encode(array('id_movie'=>$row->id_movie))))}}"><b style="letter-spacing: 3px;">Detail</b></a>
								<button class="btn btn-info" data-toggle="modal" data-target="#update_modal_{{$key}}"><b>Update</b></button>
								<button class="btn btn-warning" data-toggle="modal" data-target="#delete_modal_{{$key}}"><b>Remove</b></button>
								
							</div>

								<div class="modal fade" style="color: black" id="delete_modal_{{$key}}">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">

								      <!-- Modal Header -->
								      <div class="modal-header">
								        <h4 class="modal-title">Delete Movie</h4>
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								      </div>
								      	<!-- Modal body -->
								      	<form method="POST" action="{{URL::to('/deleteMovie')}}">
								      	  @csrf
								      	  	<input type="hidden" name="id" value="<?=bin2hex(json_encode(array('id_movie'=>$row->id_movie)))?>">
									      	<div class="modal-body">
							        			Are you sure to remove this movie?
							        		</div>
									      <!-- Modal footer -->
									      <div class="modal-footer">
									      	<button type="submit" class="btn btn-primary">Yes, sure</button>
									        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									      </div>
								  		</form>
								    </div>
								  </div>
								</div>

								<div class="modal fade" style="color: black" id="update_modal_{{$key}}">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">

								      <!-- Modal Header -->
								      <div class="modal-header">
								        <h4 class="modal-title">Update Movie</h4>
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								      </div>
								      	<!-- Modal body -->
								      	<form method="POST" action="{{URL::to('/updateMovie')}}" enctype="multipart">
								      	  @csrf
								      	  	<input type="hidden" name="id" value="<?=bin2hex(json_encode(array('id_movie'=>$row->id_movie)))?>">
									      	<div class="modal-body">
							        			<div class="row">
								        			<div class="col-md-4">
										        		<img id="image_poster_preview{{$key}}" src="{{URL::to('assets/img/'.$row->picture)}}" style="background-image: url(''); background-size: 80%; background-repeat: no-repeat; background-position: center; background-color: black; width: 100%; height: 310px;">
									        		</div>
									        		<div class="col-md-8">
									        			<div class="row">
															<div class="col-md-12">
											        			<h4><b>Movie Data: </b></h4>
											        		</div>
											        		<div class="col-md-12 col-lg-12">
												        		<div class="form-group">
												        			<label>Movie Poster: <span style="color: red">*</span></label>
												        			<input type="file" id="image_poster" name="picture" class="form-control" accept="image/*" onchange="loadFile{{$key}}(event)">
												        		</div>
												        		<script>
												        			var loadFile{{$key}} = function(event) {
																    var output = document.getElementById('image_poster_preview{{$key}}');
																    output.src = URL.createObjectURL(event.target.files[0]);
																    output.onload = function() {
																      URL.revokeObjectURL(output.src) // free memory
																    }
																  };
												        		</script>
											        		</div>
											        		<div class="col-md-8 col-lg-8">
												        		<div class="form-group">
												        			<label>Movie Name: <span style="color: red">*</span></label>
												        			<input type="text" required="" name="movie_name" class="form-control" value="{{$row->movie_name}}">
												        		</div>
												        	</div>
												        	<div class="col-md-4 col-lg-4">
												        		<div class="form-group">
												        			<label>Duration: <span style="color: red">*</span></label>
												        			<input type="number" required="" name="duration" class="form-control" value="{{$row->duration}}">
												        		</div>
											        		</div>
											        		<div class="col-md-12 col-lg-12">
												        		<div class="form-group">
												        			<label>Description: <span style="color: red">*</span></label>
												        			<textarea name="description" required="" class="form-control">{{$row->description}}</textarea>
												        		</div>
											        		</div>
									        			</div>
									        		</div>
								        		</div>
							        		</div>
									      <!-- Modal footer -->
									      <div class="modal-footer">
									      	<button type="submit" class="btn btn-primary">Submit</button>
									        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									      </div>
								  		</form>
								    </div>
								  </div>
								</div>
						<div style="background-image: url('{{URL::to('/assets/img/'.$row->picture)}}'); background-size: 100%; background-position: center; background-repeat: no-repeat; background-color: black; width: 100%; height: 425px; padding-top: 275px;">

							<div style="height: 150px; overflow-y: hidden; background-color: rgba(50, 50, 50, 0.8);">
								<p class="well" style="padding: 20px;">				        			<b>Summary: </b><br>{{$row->description}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		@if(count($list)==0)
			<div class="col-md-12">
				<center><h1>there is no movies</h1></center>
			</div>
		@endif

		<!-- The Modal -->
		<div class="modal fade" id="myModal">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Add Movie</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <form method="POST" action="{{URL::to('/addMovie')}}" enctype="multipart/form-data">
		      	  @csrf
			      <div class="modal-body">
	        		<div class="row">
	        			<div class="col-md-4">
			        		<img id="image_poster_preview" style="background-image: url(''); background-size: 80%; background-repeat: no-repeat; background-position: center; background-color: black; width: 100%; height: 310px;">
		        		</div>
		        		<div class="col-md-8">
		        			<div class="row">
								<div class="col-md-12">
				        			<h4><b>Movie Data: </b></h4>
				        		</div>
				        		<div class="col-md-12 col-lg-12">
					        		<div class="form-group">
					        			<label>Movie Poster: <span style="color: red">*</span></label>
					        			<input type="file" id="image_poster" required="" name="picture" class="form-control" accept="image/*" onchange="loadFile(event)">
					        		</div>
				        		</div>
				        		<div class="col-md-8 col-lg-8">
					        		<div class="form-group">
					        			<label>Movie Name: <span style="color: red">*</span></label>
					        			<input type="text" required="" name="movie_name" class="form-control">
					        		</div>
					        	</div>
					        	<div class="col-md-4 col-lg-4">
					        		<div class="form-group">
					        			<label>Duration: <span style="color: red">*</span></label>
					        			<input type="number" required="" name="duration" class="form-control">
					        		</div>
				        		</div>
				        		<div class="col-md-12 col-lg-12">
					        		<div class="form-group">
					        			<label>Description: <span style="color: red">*</span></label>
					        			<textarea name="description" required="" class="form-control"></textarea>
					        		</div>
				        		</div>
		        			</div>
		        		</div>
		        		
	        		</div>
			      </div>
			      <script>
			      	var loadFile = function(event) {
					    var output = document.getElementById('image_poster_preview');
					    output.src = URL.createObjectURL(event.target.files[0]);
					    output.onload = function() {
					      URL.revokeObjectURL(output.src) // free memory
					    }
					  };
			      </script>
			      <!-- Modal footer -->
			      <div class="modal-footer">
			      	<button type="submit" class="btn btn-primary">Submit</button>
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      </div>
		  		</form>
		    </div>
		  </div>
		</div>
	</div>
@endsection
