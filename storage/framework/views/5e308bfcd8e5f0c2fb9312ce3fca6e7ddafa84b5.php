 
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
  <a  href="<?php echo e(route('create-alquran')); ?>" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama Surah</th>
            <th>Total Ayat</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<div class="modal fade" id="detailModal" role="dialog" >
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <p class="modal-title">Detail Alquran</p>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Nama Surat</label>
      <input type="text" class="form-control" value="" name="surah_name" id="surah_name">
    </div>

    <div class="form-group">
      <label>Total Ayat</label>
      <input type="text" class="form-control" value="" name="total_ayat" id="total_ayat">
    </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-right" id="hapus_action">Hapus</button>
      <button type="button" id="update_data" class="btn btn-default pull-left">Update</button>
    </div>
  </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">

var idsurah;
var table;

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "<?php echo e(route('alquran')); ?>",
      columns: [
          {data: 'surah_name', name: 'surah_name'},
          {data: 'total_ayat', name: 'total_ayat'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idsurah)
{
  swal({
      title: "Menghapus",
      text: 'Apakah anda yakin ingin menghapus ini ?', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/alquran/delete',
        data:{
          idsurah:idsurah, 
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
  idsurah = id;
  hapus(idsurah);
}

function btnUbah(id)
{
  idsurah = id;
  $.ajax({
     type:'POST',
     url: base_url + '/alquran/get-detail',
     data:{idsurah:idsurah, "_token": "<?php echo e(csrf_token()); ?>",},
     success:function(data) {
        $('#detailModal').modal('toggle');
        $('#surah_name').val(data.data.surah_name);
        $('#total_ayat').val(data.data.total_ayat);
     }
  });

  $('#hapus_action').click(function() {
    hapus(idsurah);
    $("#detailModal .close").click()
  })

  $('#update_data').click(function() {

    var surah_name = $('#surah_name').val();
    var total_ayat = $('#total_ayat').val();
    
    $.ajax({
      type:'POST',
      url: base_url + '/alquran/update',
      data:{
            idsurah:idsurah, 
            "_token": "<?php echo e(csrf_token()); ?>",
            surah_name : surah_name,
            total_ayat : total_ayat
      },
     success:function(data) {
        if(data.status != false)
        {
          swal(data.message, { button:false, icon: "success", timer: 1000});
          $("#detailModal .close").click()
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
  })

}

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/alquran/index.blade.php ENDPATH**/ ?>