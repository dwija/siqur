<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>

	<form method="post" action="<?php echo e(route('store-alquran')); ?>">

		<?php echo csrf_field(); ?>
		
		<div class="form-group">
			<label>Nama Surat</label>
			<input type="text" class="form-control" value="" name="surah_name">
			<?php if($errors->has('surah_name')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('surah_name')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Total Ayat</label>
			<input type="text" class="form-control" value="" name="total_ayat">
			<?php if($errors->has('total_ayat')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('total_ayat')); ?></p></div>
			<?php endif; ?>
		</div>
	
		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>
	
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/alquran/store.blade.php ENDPATH**/ ?>