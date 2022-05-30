 
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

<div style="padding-bottom: 20px">
  <button type="button" class="btn btn-danger" id="reset">RESET</button>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th> Nama Aksi </th>
            <th> Pengguna </th>
            <th> Tanggal </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">

var table;

$( document ).ready(function() {
  $( "#reset" ).click(function() {
      
    $.ajax({
      type:'POST',
      url: base_url + '/action-log/remove',
      data:{
        
        "_token": "<?php echo e(csrf_token()); ?>",
      
      },
      success:function(data) {
        if(data.status != false)
        {
          table.ajax.reload();
          swal(data.message, { button:false, icon: "success", timer: 1000});
        }
        else
        {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      },
      error: function(error) {
        swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
      }
    });

  });
});

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "<?php echo e(route('action-log')); ?>",
      columns: [
          {data: 'action_message', name: 'action_message'},
          {data: 'user', name: 'user'},
          {data: 'date', name: 'date'},
      ]
  });
});

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/action-log/index.blade.php ENDPATH**/ ?>