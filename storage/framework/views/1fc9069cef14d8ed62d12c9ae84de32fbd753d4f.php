<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>

	<form method="post" action="<?php echo e(route('store-student-class')); ?>">

		<?php echo csrf_field(); ?>

		<div class="form-group">
			<label>Angkatan</label>
            <select class="form-control" id="angkatan" name="angkatan" style="width: 100%">
            	<?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                	<option value="<?php echo e($year); ?>"> <?php echo e($year); ?> </option>
            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($errors->has('angkatan')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('teacher_id')); ?></p></div>
			<?php endif; ?>
        </div>

		<div class="form-group">
			<label>Guru</label>
            <select class="js-example-basic-single form-control" id="guru" name="teacher_id" style="width: 100%"></select>
            <?php if($errors->has('teacher_id')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('teacher_id')); ?></p></div>
			<?php endif; ?>
        </div>

		<div class="form-group">
			<label>Kelas</label>
			<input type="text" class="form-control" value="" name="class_name">
			<?php if($errors->has('class_name')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('class_name')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Catatan</label>
			<input type="text" class="form-control" value="" name="note">
			<?php if($errors->has('note')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('note')); ?></p></div>
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
	    $('#guru').select2({
	    	allowClear: true,
			placeholder: 'Masukkan Nama Guru',
			ajax: {
				url: base_url + '/student-class/get-user-teacher',
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/student_class/store.blade.php ENDPATH**/ ?>