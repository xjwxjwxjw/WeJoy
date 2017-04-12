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
        .table{margin: 100px auto;width: 90%;}
        .table,.table th{text-align: center}
        .table caption{text-align: center;font-size: 40px;}
    </style>
</head>
<body>
    <table class='table table-striped table-bordered table-hover'>
        <caption>用户列表</caption>
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
        @foreach($result as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->pwd}}</td>
                <td>{{$value->sex}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->address}}</td>
                <td>{{$value->icon}}</td>
                <td>{{$value->birthday}}</td>
                <td>{{$value->status}}</td>
                <td>{{$value->regtime}}</td>
                <td><a href="" class="btn btn-info">修改</a><a href="{!!url('/admin/myIndex/del/'.$value->id)!!}" class="btn btn-danger">删除</a></td>
            </tr>
        @endforeach
    </table>
</body>
</html>
