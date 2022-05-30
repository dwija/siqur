<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>

	<form method="post" action="<?php echo e(route('store-iqro')); ?>">

		<?php echo csrf_field(); ?>

		<div class="form-group">
			<label>Nomor Jilid</label>
			<input type="text" class="form-control" value="" name="jilid_number">
			<?php if($errors->has('jilid_number')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('jilid_number')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Total Halaman</label>
			<input type="text" class="form-control" value="" name="total_page">
			<?php if($errors->has('total_page')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('total_page')); ?></p></div>
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/iqro/store.blade.php ENDPATH**/ ?>