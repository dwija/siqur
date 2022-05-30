<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>

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

  <form method="post" action="<?php echo e(route('do-assessment')); ?>">

    <?php echo csrf_field(); ?>

    <div class="form-group">
      <label>Nama Santri / Siswa</label>
      <input type="text" class="form-control" value="<?php echo e($data_siswa->siswa_name); ?>" disabled>
    </div>

    <div class="form-group">
      <label>Iqro</label>
      <select class="form-control" name="iqro_id" id="iqro_id">
        <option value=""></option>
        <?php $__currentLoopData = $iqro_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $iqro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($key); ?>" ><?php echo e($iqro); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php if($errors->has('iqro_id')): ?>
        <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('iqro_id')); ?></p></div>
      <?php endif; ?>
    </div>

    <div class="form-group col-md-6" style="padding-left: 0px">
      <label>Mulai Halaman</label>
        <input class="form-control" id="begin" name="begin">
        <?php if($errors->has('begin')): ?>
          <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('begin')); ?></p></div>
        <?php endif; ?>
    </div>

    <div class="form-group col-md-6" style="padding-left: 0px">
      <label>Sampai Halaman</label>
        <input class="form-control" id="end" name="end">
        <?php if($errors->has('end')): ?>
          <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('end')); ?></p></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Catatan </label>
      <input type="text" class="form-control" name="note">
      <?php if($errors->has('note')): ?>
          <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('note')); ?></p></div>
      <?php endif; ?>
    </div>
      
    <div class="form-group" id="submit_yes" style="padding-top: 20px; padding-bottom: 20px">
      <button type="submit" class="btn btn-info" value="text 1"> VALIDASI SELESAI </button>
    </div>

    <div class="form-group">
      <input type="hidden" class="form-control" name="id_siswa" value="<?php echo e($data_siswa->id); ?>">
    </div>

  </form>

  <hr>

  <div class="table-responsive">
  <table class="table table-bordered data-table display nowrap" style="width:100%">
  <thead>
      <tr>
          <th width="30%">Iqro </th>
          <th width="20%">Halaman </th>
          <th width="20%">Note / Nilai </th>
          <th width="50%">Tanggal </th>
      </tr>
  </thead>
  <tbody>
  </tbody>
  </table>
  </div>
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">

var total_page;
var table;
var id_siswa = '<?php echo e($data_siswa->id); ?>';

$(function () {
    
    var url = '<?php echo e(route("create-assessment", ":id")); ?>';
    url = url.replace(':id', id_siswa);
    
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        bInfo: false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        "aaSorting": [[ 3, "desc" ]],
        ajax: url,
        columns: [
            {data: 'assessment', name: 'assessment'},
            {data: 'range', name: 'range'},
            {data: 'note', name: 'note'},
            {data: 'date', name: 'date'},
        ]
    });
  });

$(document).ready(function() {

  $( "#iqro_id" ).change(function() {
        
        iqro_id = $(this).val();
        
        $.ajax({
        type:'GET',
        url: base_url + '/assessment/get-total-page',
        data:{
              iqro_id:iqro_id, 
              "_token": "<?php echo e(csrf_token()); ?>",
        },
       success:function(data) {
         total_page = data;
       },
       error: function(error) {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      });
    });

  // $('#begin').on('input', function () {
  //   var value = $(this).val();
  //   if ((value !== '') && (value.indexOf('.') === -1)) {
  //       $(this).val(Math.max(Math.min(value, total_page), 0));
  //   }
  // });

  // $('#end').on('input', function () {
  //   var value = $(this).val();
  //   if ((value !== '') && (value.indexOf('.') === -1)) {
  //       $(this).val(Math.max(Math.min(value, total_page), 0));
  //   }
  // });

})

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/assessment/assessment_iqro.blade.php ENDPATH**/ ?>