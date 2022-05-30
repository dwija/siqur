 
<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('alert'); ?>

<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>


<fieldset>
<legend>Overview</legend>

<div class="col-md-4">
	<div class="card">
	    <div class="header">   
	        <p style="text-align: center; font-weight: bold;"> Siswa Yang Diampu </p>
	    </div>
	    <div class="content">
	       <h3 style="text-align: center;"> <?php echo e($siswa); ?> </h3>
	    </div>
	</div>
</div>

<div class="col-md-4">
	<div class="card">
	    <div class="header">   
	        <p style="text-align: center; font-weight: bold;"> Kelas Yang Diampu </p>
	    </div>
	    <div class="content">
	       <h3 style="text-align: center;"> <?php echo e($class); ?> </h3>
	    </div>
	</div>
</div>

<div class="col-md-4">
	<div class="card">
	    <div class="header">   
	        <p style="text-align: center; font-weight: bold;"> Hafalan <?php echo e(date("d M Y")); ?> </p>
	    </div>
	    <div class="content">
	       <h3 style="text-align: center;"> <?php echo e($hafalan); ?> </h3>
	    </div>
	</div>
</div>


</fieldset>

<hr>

<fieldset>
<legend>Informasi User</legend>

<div class="form-group">
	<label>Tipe User</label>
	<input disabled="true" type="text" class="form-control" value="<?php echo e(User::getAccountMeaning(Auth::user()->account_type)); ?>" name="user_type">
</div>

<div class="form-group">
	<label>Terakhir Login</label>
	<input disabled="true" type="text" class="form-control" value="<?php echo e($last_login); ?>" name="last_login">
</div>

</fieldset>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/home/index.blade.php ENDPATH**/ ?>