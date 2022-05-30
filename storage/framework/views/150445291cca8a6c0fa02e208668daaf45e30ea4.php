<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('alert'); ?>

<?php if(Session::has('alert_success')): ?>
  <?php $__env->startComponent('components.alert'); ?>
        <?php $__env->slot('class'); ?>
            success
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Terimakasih
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('message'); ?>
            <?php echo e(session('alert_success')); ?>

        <?php $__env->endSlot(); ?>
  <?php echo $__env->renderComponent(); ?>
<?php elseif(Session::has('alert_error')): ?>
  <?php $__env->startComponent('components.alert'); ?>
        <?php $__env->slot('class'); ?>
            error
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Cek Kembali
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('message'); ?>
            <?php echo e(session('alert_error')); ?>

        <?php $__env->endSlot(); ?>
  <?php echo $__env->renderComponent(); ?> 
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<form method="post" action="<?php echo e(route('store-notification')); ?>">

		<?php echo csrf_field(); ?>

		<div class="form-group">
			<label>Tipe Notifikasi</label>
			<select class="form-control" name="notification_type" id="notification_type">
			<option value="<?php echo e(Notification::NOTIFICATION_TYPE_PARENT); ?>" > Untuk Orangtua</option>
			<option value="<?php echo e(Notification::NOTIFICATION_TYPE_TEACHER); ?>" > Untuk Guru / Admin </option>
			</select>
		</div>

		<div class="form-group">
			<label>Judul Notifikasi</label>
			<input type="text" class="form-control" value="" name="notification_title">
			<?php if($errors->has('notification_title')): ?>
			    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('notification_title')); ?></p></div>
			<?php endif; ?>
		</div>

		<div class="form-group">
			<label>Pesan Notifikasi</label>
			<textarea class="form-control" placeholder="" rows="3" id="notification_message" name="notification_message"></textarea>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-info"> KIRIM </button>
		</div>

	</form>

	<hr> 

	<div class="table-responsive">
		<table class="table table-bordered data-table display nowrap" style="width:100%">
		<thead>
		    <tr>
		        <th>Title Notifikasi</th>
		        <th>Isi Notifikasi</th>
		        <th>Tanggal Notifikasi</th>
		        <th>Jenis Notifikasi</th>
		    </tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
	
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      "aaSorting": [[ 2, "desc" ]],
      ajax: "<?php echo e(route('notification')); ?>",
      columns: [
          {data: 'notification_title', name: 'notification_title'},
          {data: 'notification_message', name: 'notification_message'},
          {data: 'date', name: 'date'},
          {data: 'notification_type', name: 'notification_type'}
      ]
  });
});

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/notification/index.blade.php ENDPATH**/ ?>