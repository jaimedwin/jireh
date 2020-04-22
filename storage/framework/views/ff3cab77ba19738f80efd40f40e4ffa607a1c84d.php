<?php $__env->startSection('entidad', 'Principal'); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="container-fluid">
		
		<?php echo $__env->make('admin.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('admin.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">CPU</span>
						<span class="info-box-number"><?php echo e($cpu); ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-memory"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Memoria</span>
						<span class="info-box-number"><?php echo e($mem); ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-hdd"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Disco duro disponible</span>
						<span class="info-box-number"><?php echo e($dfg); ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bell"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Recordatorios por semana</span>
						<span class="info-box-number"><?php echo e($rec); ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>
	</div>


	<div class="container-fluid">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title"><?php echo e('Recordatorio de los últimos 30 días'); ?></h3>
				<div class="card-tools"></div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-bordered table-striped">
							<thead class="">
								<tr>
									<th style="width: 10px"><?php echo e('#'); ?></th>
									<th style="width: 200px"><?php echo e('Fecha'); ?></th>
									<th><?php echo e('Observación'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $Recordatorios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($loop->iteration); ?></td>
									<td><?php echo e($rec->fecha); ?></td>
									<td><?php echo e($rec->observacion); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/jireh/resources/views/admin.blade.php ENDPATH**/ ?>