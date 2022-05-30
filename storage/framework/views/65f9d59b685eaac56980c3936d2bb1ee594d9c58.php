 
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

<form method="post" action="<?php echo e(route('update-profile')); ?>" enctype="multipart/form-data">

    <?php echo csrf_field(); ?>
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" value="<?php echo e($data_user->full_name); ?>" class="form-control" value="" name="full_name">
      <?php if($errors->has('full_name')): ?>
          <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('full_name')); ?></p></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="text" value="<?php echo e($data_user->email); ?>" class="form-control" value="" name="email">
      <?php if($errors->has('email')): ?>
          <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('email')); ?></p></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <input type="text" value="<?php echo e($data_user->address); ?>" class="form-control" value="" name="address">
      <?php if($errors->has('address')): ?>
          <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('address')); ?></p></div>
      <?php endif; ?>
    </div>

    <input type="hidden" value="<?php echo e($data_user->id); ?>" class="form-control" value="" name="iduser">
  
    <div class="form-group">
      <button type="submit" class="btn btn-info"> UPDATE </button>
      <button type="button" id="change_pass" class="btn btn-info pull-right"> UBAH PASSWORD </button>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('profile_picture'); ?>

<div style="text-align: center">
    <img src="<?= $data_user->profile_picture != null ? URL::to('/').'/uploads/profile/'.$data_user->profile_picture : URL::to('/').'/layout/assets/img/default-avatar.png';?>" style="width:200px;height:200px;" class="img-thumbnail center-cropped" id="profile_pic"> 
</div>
<div style="text-align: center; padding-top: 10px">
  <?php if($data_user->profile_picture != null): ?>

  <button type="button" class="btn btn-info" id="delete_image">
      <span class="glyphicon glyphicon-trash"></span>
  </button>

  <?php else: ?>

  <input type="file" name="file" id="file" class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
  <label for="file"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Pilih Gambar</label>

  <p> Gambar Max. 2 MB </p>
  
  <?php endif; ?>
  

</div>


<?php if($errors->has('file')): ?>
    <div class="error"><p style="color: red"><span>&#42;</span> <?php echo e($errors->first('file')); ?></p></div>
<?php endif; ?>

</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<div class="modal fade" id="passwordModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title">Ubah Password</p>
      </div>
      <div class="modal-body">
        
        <div class="form-group col-md-12">
          <label>Password Lama</label>
          <input type="password" class="form-control" value="" id="old_password" name="old_password">
        </div>

        <div class="form-group col-md-6">
          <label>Password</label>
          <input type="password" class="form-control" value="" id="password" name="password">
        </div>

        <div class="form-group col-md-6">
          <label>Re Password</label>
          <input type="password" class="form-control" value="" id="password_confirmation" name="password_confirmation">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" id="update_password" class="btn btn-default pull-left">Update</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">

var idiqro;
var table;


$( document ).ready(function() {

  $("#file").change(function() {
    
    var size = this.files[0].size;
  
    if(size >= 2000587)
    {
      swal('Ukuran file maksimal 2 MB', { button:false, icon: "error", timer: 1000});
      return false;
    }

    readURL(this);

  });

  $('#delete_image').click(function() { 
    // Delete imagee With ajax

    swal({
      title: "Ingin menghapus foto profile ?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type:'POST',
          url: base_url + '/profile/delete-image',
          data:
          {
            "_token": "<?php echo e(csrf_token()); ?>",
          },
          success:function(data) {
            if(data.status != false)
            {
              swal(data.message, { button:false, icon: "success", timer: 1000});
            }
            else
            {
              swal(data.message, { button:false, icon: "error", timer: 1000});
            }
            location.reload();
          },
          error: function(error) {
            swal('Error pada sistem', { button:false, icon: "error", timer: 1000});
          }
        }); 
      }
    });
  })

  $('#change_pass').click(function() { 
    $('#passwordModal').modal('toggle');
  })

  $('#update_password').click(function() { 

    var old_password = $('#old_password').val();
    var password = $('#password').val();
    var password_confirmation = $('#password_confirmation').val();

    $.ajax({
        type:'POST',
        url: base_url + '/profile/update-password',
        data:
        {
          "_token": "<?php echo e(csrf_token()); ?>",
          password : password,
          password_confirmation : password_confirmation,
          old_password : old_password
        },
        success:function(data) {
          if(data.status != false)
          {
            swal(data.message, { button:false, icon: "success", timer: 1000});
            $("#passwordModal .close").click()
          }
          else
          {
            swal(data.message, { button:false, icon: "error", timer: 1000});
          }
        },
        error: function(error) {
          var err = eval("(" + error.responseText + ")");
          var array_1 = $.map(err, function(value, index) {
              return [value];
          });
          var array_2 = $.map(array_1, function(value, index) {
              return [value];
          });
          var message = JSON.stringify(array_2);
          swal(message, { button:false, icon: "error", timer: 1000});
        }
    });
  })
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#profile_pic').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', ['profile_content'=>true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/profile/index.blade.php ENDPATH**/ ?>