<div class="alert alert-<?php echo e($class); ?>">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

	<?php if($class == 'error'): ?>

    <p class="alert-title" style="color: red"><?php echo e($title); ?></p>
    <p style="color: red"><?php echo e($message); ?></p>

    <?php else: ?>

    <p class="alert-title" style="color: blue"><?php echo e($title); ?></p>
    <p style="color: blue"><?php echo e($message); ?></p>

    <?php endif; ?>

</div><?php /**PATH X:\xampp\htdocs\siqur\resources\views/components/alert.blade.php ENDPATH**/ ?>