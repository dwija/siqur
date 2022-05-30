<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
	
	<form method="post" action="<?php echo e(route('store-user')); ?>">

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
			<label for="sel1">Tipe Akun</label>
			<select class="form-control" name="account_type">
				<option value="<?php echo e(User::ACCOUNT_TYPE_ADMIN); ?>" >Admin</option>
				<option value="<?php echo e(User::ACCOUNT_TYPE_TEACHER); ?>" >Guru</option>
			</select>
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<textarea class="form-control" rows="3" name="address">
			</textarea>
			<?php if($errors->has('address')): ?>
			    <div class="address"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('address')); ?></p></div>
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/user/store.blade.php ENDPATH**/ ?>