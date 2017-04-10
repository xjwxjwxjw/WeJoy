<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>这里是头部<?php echo $__env->yieldContent('title'); ?></title>
</head>
<body>
<?php $__env->startSection('top'); ?>
    这是master 的头部
<?php echo $__env->yieldSection(); ?>

<div class ="container">
    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html>