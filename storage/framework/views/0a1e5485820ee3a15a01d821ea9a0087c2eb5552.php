 
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

<!-- <div style="padding-bottom: 20px">
  <a  href="<?php echo e(route('create-role')); ?>" type="button" class="btn btn-info"> TAMBAH </a>
</div> -->

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama Aturan</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">

var idrole;
var table;

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "<?php echo e(route('role')); ?>",
      columns: [
          {data: 'name', name: 'name'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idrole)
{
  swal({
      title: "Menghapus",
      text: 'Apakah anda yakin ingin menghapus role ini ?', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/role/delete',
        data:{
          idrole:idrole, 
          "_token": "<?php echo e(csrf_token()); ?>",},
        success:function(data) {
          
          if(data.status != false)
          {
            swal(data.message, { button:false, icon: "success", timer: 1000});
          }
          else
          {
            swal(data.message, { button:false, icon: "error", timer: 1000});
          }

          table.ajax.reload();
        },
        error: function(error) {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      });      
    }
  });
}

function btnDel(id)
{
  idrole = id;
  hapus(idrole);
}

function btnUbah(id){
  var url = '<?php echo e(route("update-role", ":id")); ?>';
  url     = url.replace(':id', id);
  window.location.href = url;
}

function clearAll()
{

}


</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/role/index.blade.php ENDPATH**/ ?>