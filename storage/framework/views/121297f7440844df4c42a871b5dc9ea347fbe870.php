<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>

	<form method="post" action="<?php echo e(route('store-siswa')); ?>">

		<?php echo csrf_field(); ?>

		<div class="form-group">
			<label>Nama Siswa</label>
			<input type="text" class="form-control" value="" name="siswa_name">
			<?php if($errors->has('siswa_name')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('siswa_name')); ?></p></div>
			<?php endif; ?>
		</div>
		<div class="form-group">
			<label>Jenis Hafalan</label>
			<select class="form-control" name="memorization_type">
				<option value="<?php echo e(Siswa::TYPE_IQRO); ?>" >Iqro</option>
				<option value="<?php echo e(Siswa::TYPE_QURAN); ?>" >Alquran</option>
			</select>
			<?php if($errors->has('memorization_type')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('memorization_type')); ?></p></div>
			<?php endif; ?>
		</div>
		<div class="form-group">
			<label>Kelas </label>
			<select class="js-example-basic-single form-control" name="class_id" id="class_id" style="width: 100%">
	          <option></option>
	        </select>
			<?php if($errors->has('class_id')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('class_id')); ?></p></div>
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
		$('#class_id').select2({
			allowClear: true,
			ajax: {
			  url: base_url + '/siswa/get-class',
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/siswa/store.blade.php ENDPATH**/ ?>