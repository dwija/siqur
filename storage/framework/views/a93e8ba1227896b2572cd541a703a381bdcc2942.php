 
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
  <a  href="<?php echo e(route('create-student-class')); ?>" type="button" class="btn btn-info"> TAMBAH </a>
</div>
<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Angkatan</th>
            <th>Kelas</th>
            <th>Guru</th>
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
      <p class="modal-title">Detail Kelas</p>
    </div>
    <div class="modal-body">

    <div class="form-group">
    <label>Angkatan</label>
        <select class="form-control" id="angkatan" name="angkatan" style="width: 100%">
          <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($year); ?>"> <?php echo e($year); ?> </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group">
      <label>Guru</label>
          <?= $guru_option ?>
    </div>
    
    <div class="form-group">
      <label>Kelas</label>
      <input type="text" class="form-control" value="" name="class_name" id="class_name">
    </div> 

    <div class="form-group">
      <label>Catatan</label>
      <input type="text" class="form-control" value="" name="note" id="note">
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

var idclass;
var table;

function clearAll(){
  $('#angkatan').val('');
  $("#guru").val([]).trigger("change");
  $('#class_name').val('');
  $('#note').val('');
}

function btnUbah(id){
  clearAll();

  callGuru();
  
  idclass = id;
  $.ajax({
     type:'POST',
     url: base_url + '/student-class/get-detail',
     data:{idclass:idclass, "_token": "<?php echo e(csrf_token()); ?>",},
     success:function(data) {
        $('#detailModal').modal('toggle');
        $('#angkatan').val(data.data.angkatan);
        $('#guru').val(data.data.teacher.id).trigger('change');
        $('#class_name').val(data.data.class_name);
        $('#note').val(data.data.note);
     }
  });

  $('#hapus_action').click(function() {
    hapus(idclass);
    $("#detailModal .close").click()
  })

  $('#update_data').click(function() {

      var angkatan = $('#angkatan').val();
      var teacher_id = $('#guru').val();
      var class_name = $('#class_name').val();
      var note = $('#note').val();

      $.ajax({
        type:'POST',
        url: base_url + '/student-class/update',
        data:{
              idclass:idclass, 
              "_token": "<?php echo e(csrf_token()); ?>",
              angkatan : angkatan,
              teacher_id : teacher_id,
              class_name : class_name,
              note : note
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

function callGuru()
{
  $('#guru').select2({
    allowClear: true,
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
}

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "<?php echo e(route('student-class')); ?>",
      columns: [
          {data: 'angkatan', name: 'angkatan'},
          {data: 'class_name', name: 'class_name'},
          {data: 'guru', name: 'guru'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idclass)
{
  swal({
      title: "Menghapus",
      text: 'Dengan anda menghapus kelas, maka seluruh data nilai siswa dan data siswa dalam kelas ini akan ikut terhapus', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/student-class/delete',
        data:{
          idclass:idclass, 
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
  idclass = id;
  hapus(idclass);
}

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/student_class/index.blade.php ENDPATH**/ ?>