<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title >wejoy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
    <meta name="author" content="Codrops" />
    <link rel="stylesheet" type="text/css" href={{url('/home/css/logindemo.css')}} />
    <link rel="stylesheet" type="text/css" href={{url('/home/css/loginstyle.css')}} />
    <link rel="stylesheet" type="text/css" href={{url('/home/css/logincustom.css')}} />
</head>
<body>
<div class="container">
    <header>
        <h1>wejoy</h1>
    </header>
    <section>
        <div id="container_demo" >
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form  action={{url('home/singin')}}  method="post" autocomplete="on">
                        {{csrf_field()}}
                        <h1>登录</h1>
                            <p>
                                <input name="email"  type="email" placeholder={{$errors->first('email')?$errors->first('email'):'请输入电子邮箱'}}>
                            </p>
                            <p>
                                <input  name="password"  type="password" placeholder={{$errors->first('password')?$errors->first('password'):'请输入密码'}}>
                            </p>
                        <p class="login button">
                            <input type="submit" value="登录" />
                        </p>
                        <p class="change_link">
                            未有登录账号?
                            <a href="#toregister" class="to_register">请注册</a>
                        </p>
                    </form>
                </div>

                <div id="register" class="animate form">

                    <form  action={{url('home/store')}} method="post" autocomplete="on">
                        <h1> 注册</h1>
                        {{csrf_field()}}
                        <p>
                            <input  name="username"  type="text" placeholder={{$errors->first('username')?$errors->first('username'):'请输入用户名'}} >
                        </p>
                        <p>
                            <input  name="email"  type="email" placeholder={{$errors->first('email')?$errors->first('email'):'请输入邮箱'}}>
                        </p>
                        <p>
                            <input  name="password"  type="password" placeholder={{$errors->first('password')?$errors->first('password'):'请输入密码'}}>
                        </p>
                        <p>
                            <input  name="password_confirmation"  type="password" placeholder={{$errors->first('password_confirmation')?$errors->first('password_confirmation'):'请再次输入密码'}}>
                        </p>
                        <p class="signin button">
                            <input type="submit" value="注册"/>
                        </p>
                        <p class="change_link">
                            已经有账号 ?
                            <a href="#tologin" class="to_register"> 请登录 </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
