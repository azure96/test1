@extends('book.muban.admin')

@section('title','还书信息')

@section('people')
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
@if(session('yanzheng'))
<div id="clickMe" onclick="alert('管理员验证码错误');" ></div>
@endif
<section class="panel" style="margin-left: -150px;">
  <header class="panel-heading">
      还书信息
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
  <div class="panel-body">
      <div class="form">
          <form class="form-validate form-horizontal" id="feedback_form" method="post" 
          		action="{{url('/return/'.$book->id)}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-5">图书名:</label>
                  <label for="cname" class="control-label col-lg-1" style="text-align: left;">{{$book->name}}</label>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">作者:</label>
                  <label for="cname" class="control-label col-lg-1" style="text-align: left;">{{$book->author}}</label>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">封面:</label>
                  <div class="col-lg-4">
                      <img src="{{$book->img}}" style="width: 200px;height: 200px;">
                  </div>
              </div>
            <div class="form-group">
	              <label class="control-label col-lg-5" for="inputSuccess">还书人</label>
	              <label for="cname" class="control-label col-lg-1" style="text-align: left;">
	              {{$user->username}}</label>
	          </div>
            <div class="form-group ">
                  <label for="cname" class="control-label col-lg-5">管理员确认码<span class="required">*</span></label>
                  <div class="col-lg-2">
                      <input class="form-control" name="adminnum" value="" type="password" required="">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-offset-5 col-lg-4">
                      <button class="btn btn-primary" type="submit">确认</button>
                      <input type="hidden" name="id" value="{{$book->id}}">
                  </div>
              </div>
              {{csrf_field()}}
          </form>
      </div>

  </div>
</section>
@endsection