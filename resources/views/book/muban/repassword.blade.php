@extends('book.muban.admin')

@section('title','修改密码')

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
<section class="panel" style="margin-left: -150px;">
  <header class="panel-heading">
      修改密码
  </header>
	@if (count($errors) > 0)
	    <div class="alert alert-block alert-danger fade in">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <h4 style="text-align: center;">{{ $error }}</h4>
	            @endforeach
	        </ul>
	    </div>
	@endif
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
  @if(session('mima'))
  <div id="clickMe" onclick="alert('旧密码不正确');" ></div>
  @endif
  @if(session('info'))
  <div id="clickMe" onclick="alert('修改失败');" ></div>
  @endif
  <div class="panel-body">
      <div class="form">
          <form class="form-validate form-horizontal" id="feedback_form" method="post" 
          		action="{{url('/updatepassword')}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-5">旧密码<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input class="form-control" name="old"  type="password" required="" >
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">新密码<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input class="form-control " type="password" name="new" required="" >
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">确认密码<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input class="form-control " type="password" name="repassword" required="" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-offset-5 col-lg-4">
                      <button class="btn btn-primary" type="submit">提交</button>
                  </div>
              </div>
              {{csrf_field()}}
          </form>
      </div>

  </div>
</section>
@endsection