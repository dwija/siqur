 
<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('alert'); ?>

<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>

<div class="alert alert-warning">
  <p style="color: red"><strong>Warning!</strong> Anda tidak mempunyai izin untuk mengakses halaman ini, silahkan menghubungi Administrator apabila anda berfikir ini merupakan sebuah kesalahan.</p>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH X:\xampp\htdocs\siqur\resources\views/error/unauthorized.blade.php ENDPATH**/ ?>