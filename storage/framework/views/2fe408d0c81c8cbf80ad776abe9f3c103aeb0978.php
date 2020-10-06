

<?php $__env->startSection('content'); ?>
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
		<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-lg-4 col-md-6 col-xs-12" style="height: 500px;">
				<div class="row" style="padding: 10px;">
					<div class="col-md-12 text-white bg-dark">
						<h2><?php echo e($row->movie_name); ?> <div class="float-right"><span style="right: 0px; " class="badge badge-danger"><?php echo e($row->duration); ?> m</span></div></h2>
							<div class="float-left">
								<a class="btn btn-light" href="<?php echo e(URL::to('/detailMovie/'.bin2hex(json_encode(array('id_movie'=>$row->id_movie))))); ?>"><b style="letter-spacing: 3px;">Detail</b></a>
								<button class="btn btn-info" data-toggle="modal" data-target="#update_modal_<?php echo e($key); ?>"><b>Update</b></button>
								<button class="btn btn-warning" data-toggle="modal" data-target="#delete_modal_<?php echo e($key); ?>"><b>Remove</b></button>
								
							</div>

								<div class="modal fade" style="color: black" id="delete_modal_<?php echo e($key); ?>">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">

								      <!-- Modal Header -->
								      <div class="modal-header">
								        <h4 class="modal-title">Delete Movie</h4>
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								      </div>
								      	<!-- Modal body -->
								      	<form method="POST" action="<?php echo e(URL::to('/deleteMovie')); ?>">
								      	  <?php echo csrf_field(); ?>
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

								<div class="modal fade" style="color: black" id="update_modal_<?php echo e($key); ?>">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">

								      <!-- Modal Header -->
								      <div class="modal-header">
								        <h4 class="modal-title">Update Movie</h4>
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								      </div>
								      	<!-- Modal body -->
								      	<form method="POST" action="<?php echo e(URL::to('/updateMovie')); ?>" enctype="multipart">
								      	  <?php echo csrf_field(); ?>
								      	  	<input type="hidden" name="id" value="<?=bin2hex(json_encode(array('id_movie'=>$row->id_movie)))?>">
									      	<div class="modal-body">
							        			<div class="row">
								        			<div class="col-md-4">
										        		<img id="image_poster_preview<?php echo e($key); ?>" src="<?php echo e(URL::to('assets/img/'.$row->picture)); ?>" style="background-image: url(''); background-size: 80%; background-repeat: no-repeat; background-position: center; background-color: black; width: 100%; height: 310px;">
									        		</div>
									        		<div class="col-md-8">
									        			<div class="row">
															<div class="col-md-12">
											        			<h4><b>Movie Data: </b></h4>
											        		</div>
											        		<div class="col-md-12 col-lg-12">
												        		<div class="form-group">
												        			<label>Movie Poster: <span style="color: red">*</span></label>
												        			<input type="file" id="image_poster" name="picture" class="form-control" accept="image/*" onchange="loadFile<?php echo e($key); ?>(event)">
												        		</div>
												        		<script>
												        			var loadFile<?php echo e($key); ?> = function(event) {
																    var output = document.getElementById('image_poster_preview<?php echo e($key); ?>');
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
												        			<input type="text" required="" name="movie_name" class="form-control" value="<?php echo e($row->movie_name); ?>">
												        		</div>
												        	</div>
												        	<div class="col-md-4 col-lg-4">
												        		<div class="form-group">
												        			<label>Duration: <span style="color: red">*</span></label>
												        			<input type="number" required="" name="duration" class="form-control" value="<?php echo e($row->duration); ?>">
												        		</div>
											        		</div>
											        		<div class="col-md-12 col-lg-12">
												        		<div class="form-group">
												        			<label>Description: <span style="color: red">*</span></label>
												        			<textarea name="description" required="" class="form-control"><?php echo e($row->description); ?></textarea>
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
						<div style="background-image: url('<?php echo e(URL::to('/assets/img/'.$row->picture)); ?>'); background-size: 100%; background-position: center; background-repeat: no-repeat; background-color: black; width: 100%; height: 425px; padding-top: 275px;">

							<div style="height: 150px; overflow-y: hidden; background-color: rgba(50, 50, 50, 0.8);">
								<p class="well" style="padding: 20px;">				        			<b>Summary: </b><br><?php echo e($row->description); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php if(count($list)==0): ?>
			<div class="col-md-12">
				<center><h1>there is no movies</h1></center>
			</div>
		<?php endif; ?>

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
		      <form method="POST" action="<?php echo e(URL::to('/addMovie')); ?>" enctype="multipart/form-data">
		      	  <?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\develop\xampp733\htdocs\QuickTest\resources\views/list.blade.php ENDPATH**/ ?>