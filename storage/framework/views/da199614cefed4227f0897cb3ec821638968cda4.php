

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-12">
			<br>
		</div>
		<div class="col-md-12">
			<div class="float-right">
				
				<a class="btn btn-danger" href="<?php echo e(URL::to('/')); ?>" style="letter-spacing: 4px;"><b>Back</b></a>
				
			</div>
		</div>
		<div class="col-md-12">
			<br>
		</div>
	</div>
	<div class="row" id="movieList">
		<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-lg-4 col-md-4 col-xs-12" style="height: 500px;">
				<div class="row" style="padding: 10px;">
					<div class="col-md-12 text-white bg-dark">
						<div style="background-image: url('<?php echo e(URL::to('/assets/img/'.$row->picture)); ?>'); background-size: 100%; background-position: center; background-repeat: no-repeat; background-color: black; width: 100%; height: 425px; padding-top: 275px;">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-xs-12">
				<h2><?php echo e($row->movie_name); ?> </h2>
				<hr>
				<p><b>Duration: </b><?php echo e($row->duration); ?> Minutes</p>
				<p class="text-muted"><?php echo e($row->description); ?><p>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php if(count($list)==0): ?>
			<div class="col-md-12">
				<center><h1>there is no movies</h1></center>
			</div>
		<?php endif; ?>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\develop\xampp733\htdocs\QuickTest\resources\views/detail.blade.php ENDPATH**/ ?>