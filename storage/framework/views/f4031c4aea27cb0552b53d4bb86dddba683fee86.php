<?php $__env->startSection('content'); ?>

     <form id="register-form" autocomplete="off" method="POST" action="<?php echo e(route('password.email')); ?>">
       
        <?php echo csrf_field(); ?>

        <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
          <input id="email" name="email" placeholder="alamat email" class="form-control"  type="email">
        </div>
        </div>
        
        <div class="form-group">                       
            <button type="submit" class="btn btn-primary">
                Kirim
            </button>
        </div>

        <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($message); ?></strong>
            </span>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

    </form>
                
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master_reset_password', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>