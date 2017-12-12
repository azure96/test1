
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="/admins/img/favicon.png">

    <title>登录页面</title>

    <!-- Bootstrap CSS -->    
    <link href="/admins/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="/admins/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="/admins/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="/admins/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="/admins/css/style.css" rel="stylesheet">
    <link href="/admins/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="/admins/js/html5shiv.js"></script>
    <script src="/admins/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">  
          
        function checkForm(){
             var input_cart=document.getElementsByTagName("INPUT");

              for(var   i=0;   i<input_cart.length;   i++)   {  
                      if(input_cart[i].value==""||input_cart[i].value==null)   {
                   alert("用户名密码不能为空!");
                   input_cart[i].focus();
               return (false);
                      }  
                   }

             }

        //触发onclick事件
        setTimeout(function() {
            // IE
            if(document.all) {
                document.getElementById("clickMe").click();
            }
            // 其它浏览器
            else {
                var e = document.createEvent("MouseEvents");
                e.initEvent("click", true, true);
                document.getElementById("clickMe").dispatchEvent(e);
            }
        }, );
    </script>  
</head>
  @if(session('yonghu'))
  <div id="clickMe" onclick="alert('用户不存在');" ></div>
  @endif
  @if(session('mima'))
  <div id="clickMe" onclick="alert('密码不正确');" ></div>
  @endif
  @if(session('info'))
  <div id="clickMe" onclick="alert('注册成功');" ></div>
  @endif
  @if(session('gaimima'))
  <div id="clickMe" onclick="alert('修改密码成功，请重新登陆');" ></div>
  @endif
  <body class="login-img3-body">
    <div class="container">

      <form class="login-form" action="/admin" method="post" onsubmit="return checkForm();">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" 
              placeholder="输入用户名" autofocus name="username"
              value="{{old('username')}}">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control"   
                placeholder="输入密码" name="password">
            </div>
            {{csrf_field()}}
            <button class="btn btn-primary btn-lg btn-block" type="submit">登录</button>
        </div>
      </form>
      <a href="/add" style="font-size: 20px;float: right;color: red;margin-top: -450px;">注册</a>
    </div>
  </body>
</html>
