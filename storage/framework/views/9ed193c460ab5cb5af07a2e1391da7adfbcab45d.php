<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <?php echo $__env->yieldContent('alert'); ?>
                <div class="card">
                    <div class="header">   
                        <?php echo $__env->yieldContent('title'); ?>
                    </div>
                    <div class="content">
                        <?php echo e(Breadcrumbs::render()); ?>

                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="header">   
                        <?php echo $__env->yieldContent('title'); ?>
                    </div>
                    <div class="content">
                        <?php echo $__env->yieldContent('profile_picture'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH X:\xampp\htdocs\siqur\resources\views/content_profile.blade.php ENDPATH**/ ?>