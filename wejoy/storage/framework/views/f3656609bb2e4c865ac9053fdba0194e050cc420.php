<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改用户</title>
    <link href="/css/app.css" rel="stylesheet">
    <style>
        .form-group{width: 300px;}
        form{margin-left: 100px;}
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>修改用户</h2>
        <?php $result = $result[0] ?>
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <label for="exampleInputName">用户名：</label>
            <input type="text" class="form-control" id="exampleInputName" placeholder="Please enter your name" name="name" value="<?php echo e($result->name); ?>" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="exampleInputSex">性别：</label>
            <label><input type="radio" id="exampleInputSex" name="sex" value="1" <?php echo e($result->sex==1?'checked':''); ?>>男</label>
            <label><input type="radio" id="exampleInputSex" name="sex" value="2" <?php echo e($result->sex==2?'checked':''); ?>>女</label>
            <label><input type="radio" id="exampleInputSex" name="sex" value="3" <?php echo e($result->sex==3?'checked':''); ?>>保密</label>
        </div>
        <div class="form-group">
            <label for="exampleInputPhone">手机号码：</label>
            <input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" class="form-control" id="exampleInputPhone" placeholder="Please enter your Phone" name="phone" value="<?php echo e($result->phone); ?>" autocomplete="off" maxlength="11">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail">邮箱：</label>
            <input type="text" class="form-control" id="exampleInputEmail" placeholder="Please enter your email" name="email" value="<?php echo e($result->email); ?>" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="exampleInputAddress">住址：</label>
            <input type="text" class="form-control" id="exampleInputAddress" placeholder="Please enter your address" name="address" value="<?php echo e($result->address); ?>" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="exampleInputBirthday">生日：</label>
            <input type="date" class="form-control" id="exampleInputBirthday" name="birthday" value="<?php echo e($result->birthday); ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">头像上传：</label>
            <input type="file" id="exampleInputFile" name="icon">
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
<?php echo e(var_dump($errors->all())); ?>}
</body>
</html>