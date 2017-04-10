<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/css/app.css" rel="stylesheet">
    <style>
        .table{margin: 50px auto;width: 90%;}
        .table,.table th{text-align: center}
        .table caption{text-align: center;font-size: 40px;}
    </style>
</head>
<body>
    <table class='table table-striped table-bordered table-hover'>
        <caption>用户列表<br>
            <a href="<?php echo url('/admin/myIndex/add'); ?>" class="btn btn-warning">添加用户</a>
        </caption>
        <tr class='success'>
            <th>id</th>
            <th>name</th>
            <th>pwd</th>
            <th>sex</th>
            <th>phone</th>
            <th>email</th>
            <th>address</th>
            <th>icon</th>
            <th>birthday</th>
            <th>status</th>
            <th>regtime</th>
            <th>DoWork</th>
        </tr>
        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>
                <td><?php echo e($value->id); ?></td>
                <td><?php echo e($value->name); ?></td>
                <td><?php echo e($value->pwd); ?></td>
                <td><?php echo e($value->sex); ?></td>
                <td><?php echo e($value->phone); ?></td>
                <td><?php echo e($value->email); ?></td>
                <td><?php echo e($value->address); ?></td>
                <td><?php echo e($value->icon); ?></td>
                <td><?php echo e($value->birthday); ?></td>
                <td><?php echo e($value->status); ?></td>
                <td><?php echo e($value->regtime); ?></td>
                <td><a href="" class="btn btn-info">修改</a><a href="<?php echo url('/admin/myIndex/del/'.$value->id); ?>" class="btn btn-danger">删除</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </table>
</body>
</html>
