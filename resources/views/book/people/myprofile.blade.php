@extends('book.muban.admin')

@section('title','用户信息')
@section('people')
@endsection

@section('touxiang')
<ul class="dropdown-menu extended logout">
    <div class="log-arrow-up"></div>
    <li>
        <a href="/myprofile"><i class="icon_mail_alt"></i>我的资料</a>
    </li>
    <li>
        <a href="/mybook"><i class="icon_mail_alt"></i>我的图书</a>
    </li>
    <li>
        <a href="/repassword"><i class="icon_mail_alt"></i>修改密码</a>
    </li>
    <li>
        <a href="logout"><i class="icon_clock_alt"></i>注销</a>
    </li>
</ul>
@endsection

@section('content')
<script type="text/javascript">  
    //触发onclick事件
    function() {
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
    };
</script> 
@if(session('update'))
<div id="clickMe" onclick="alert('更新成功');" ></div>
@endif
<section class="panel" style="margin-left: -150px;">
  <header class="panel-heading">
      用户信息
  </header>
  <table class="table table-striped table-advance table-hover">
   <tbody>
      <tr>	
         <th><i class="icon_profile"></i> ID</th>
         <th><i class="icon_calendar"></i> 用户名</th>
         <th><i class="icon_mail_alt"></i> 电子邮箱</th>
         <th><i ></i> 头像</th>
         <th><i class="icon_cogs"></i> 操作</th>
      </tr>
      <tr>
         <td>{{$user->id}}</td>
         <td>{{$user->username}}</td>
         <td>{{$user->email}}</td>
         <td><img src="{{$user->profile}}" width="50px" height="50px"></td>
         <td>
          <div class="btn-group">
              <a class="btn btn-primary" href="/edit">修改</a>
          </div>
          </td>
      </tr>                          
   </tbody>
</table>
</section>
@endsection