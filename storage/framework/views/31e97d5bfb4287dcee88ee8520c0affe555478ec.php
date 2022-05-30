<link rel="stylesheet" href="<?= URL::to('/'); ?>/layout/assets/css/bootstrap.min.css">
<script src="<?= URL::to('/'); ?>/layout/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= URL::to('/'); ?>/layout/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<link href="<?= URL::to('/'); ?>/layout/assets/css/additional_css.css" rel="stylesheet" />

<!------ Include the above in your HEAD tag ---------->

<body>

<?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
<?php endif; ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <div class="form-gap"></div>
    <div class="container">
      <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-body logoreset">
            <div class="text-center">
              
              <img src="<?= URL::to('/layout/assets/img/logo.png'); ?>" style="width:110px;height:40px;" class="center">
              
              <p style="padding-top: 10px; color: white">Anda dapat melakukan reset password disini.</p>

              <div class="panel-body">

                <?php echo $__env->yieldContent('content'); ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

</body><?php /**PATH X:\xampp\htdocs\siqur\resources\views/master_reset_password.blade.php ENDPATH**/ ?>