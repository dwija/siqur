 
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
  <a  href="<?php echo e(route('create-siswa')); ?>" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Jenis Hafalan</th>
            <th>Kelas</th>
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
      <p class="modal-title">Detail Siswa</p>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Nama Siswa</label>
      <input type="text" class="form-control" value="" name="siswa_name" id="siswa_name">
    </div> 

    <div class="form-group">
      <label>Jenis Hafalan</label>
      <select class="form-control" name="memorization_type" id="memorization_type">
        <option value="<?php echo e(Siswa::TYPE_IQRO); ?>" >Iqro</option>
        <option value="<?php echo e(Siswa::TYPE_QURAN); ?>" >Alquran</option>
      </select>
    </div>

    <div class="form-group">
      <label>Kelas </label>
      <?= $class_option ?>
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

var idsiswa;
var table;

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "<?php echo e(route('siswa')); ?>",
      columns: [
          {data: 'siswa_name', name: 'siswa_name'},
          {data: 'memorization_type', name: 'memorization_type'},
          {data: 'class_id', name: 'class_id'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idsiswa)
{
  swal({
      title: "Menghapus",
      text: 'Siswa yang dihapus, akan menghilangkan data siswa yang bersangkutan secara keseluruhan', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/siswa/delete',
        data:{
          idsiswa:idsiswa, 
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
  idsiswa = id;
  hapus(idsiswa);
}

function callSelect2()
{
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
  })

  $('#hapus_action').click(function() {
    hapus(idsiswa);
    $("#detailModal .close").click()
  })

}


function clearAll()
{
  $('#siswa_name').val('');
  $("#class_id").val([]).trigger("change");
  $('#memorization_type').val('');
  $('#note').val('');
}

function btnUbah(id){
  clearAll();

  callSelect2();
  
  idsiswa = id;
  $.ajax({
     type:'POST',
     url: base_url + '/siswa/get-detail',
     data:{idsiswa:idsiswa, "_token": "<?php echo e(csrf_token()); ?>",},
     success:function(data) {
        $('#detailModal').modal('toggle');
        $('#siswa_name').val(data.data.siswa_name);
        $('#class_id').val(data.data.class.id).trigger('change');
        $('#memorization_type').val(data.data.memorization_type);
     }
  });

  $('#update_data').click(function() {

    var siswa_name = $('#siswa_name').val();
    var memorization_type = $('#memorization_type').val();
    var class_id = $('#class_id').val();

    $.ajax({
      type:'POST',
      url: base_url + '/siswa/update',
      data:{
            idsiswa:idsiswa, 
            "_token": "<?php echo e(csrf_token()); ?>",
            siswa_name : siswa_name,
            memorization_type : memorization_type,
            class_id : class_id
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/siswa/index.blade.php ENDPATH**/ ?>