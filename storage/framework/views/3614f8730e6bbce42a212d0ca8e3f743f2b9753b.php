<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
	
	<form method="post" action="<?php echo e(route('store-parent')); ?>">

		<?php echo csrf_field(); ?>

		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" value="" name="username">
			<?php if($errors->has('username')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('username')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" value="" name="email">
			<?php if($errors->has('username')): ?>
			    <div class="email"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('email')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" value="" name="full_name">
			<?php if($errors->has('full_name')): ?>
			    <div class="email"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('full_name')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<textarea class="form-control" placeholder="" rows="3" name="address">
			</textarea>
			<?php if($errors->has('address')): ?>
			    <div class="address"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('address')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Orangtua Dari</label>
            <select class="js-example-basic-single form-control" id="siswa_data" name="siswa_data[]" style="width: 100%" multiple="multiple"></select>
            <?php if($errors->has('teacher_id')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('teacher_id')); ?></p></div>
			<?php endif; ?>
        </div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Password</label>
			<input type="password" class="form-control" value="" name="password">
			<?php if($errors->has('password')): ?>
			    <div class="password"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('password')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Re Password</label>
			<input type="password" class="form-control" value="" name="password_confirmation">
			<?php if($errors->has('password')): ?>
			    <div class="password"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('password')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>
	
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#siswa_data').select2({
	    	allowClear: true,
			placeholder: 'Masukkan Nama Siswa',
			ajax: {
				url: base_url + '/parent/get-siswa',
				dataType: 'json',
				data: function(params) {
				    return {
				      search: params.term
				    }
				},
				processResults: function (data, page) {
				    return {
				        results: data
				    };
				}
			}
	    });
	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/parent/store.blade.php ENDPATH**/ ?>