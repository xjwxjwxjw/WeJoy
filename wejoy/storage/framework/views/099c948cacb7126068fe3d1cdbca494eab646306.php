<?php $__env->startSection('title','page Title'); ?>
<?php $__env->startSection('top'); ?>
    <?php echo $__env->make('/admin/public/top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('/admin/public/sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('/admin/public/content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('/admin/layouts/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>