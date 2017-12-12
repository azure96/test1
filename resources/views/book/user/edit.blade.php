@extends('book.muban.admin')

@section('title','用户修改')

@section('content')
<section class="panel">
  <header class="panel-heading">
      用户修改
  </header>
	@if (count($errors) > 0)
	    <div class="alert alert-block alert-danger fade in">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <h4>{{ $error }}</h4>
	            @endforeach
	        </ul>
	    </div>
	@endif
  <div class="panel-body">
      <div class="form">
          <form class="form-validate form-horizontal" id="feedback_form" method="post" 
          	 action="{{url('/user/'.$user->id)}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-2">用户名<span class="required">*</span></label>
                  <div class="col-lg-10">
                      <input class="form-control" name="username" value="{{$user->username}}" type="text" required="">
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-2">邮箱<span class="required">*</span></label>
                  <div class="col-lg-10">
                      <input class="form-control " type="email" name="email" value="{{$user->email}}">
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-2">是否为管理员<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input type="radio" name="admin" value="1" @if($user->admin == 1) checked @endif>是
                      <input type="radio" name="admin" value="0" @if($user->admin == 0) checked @endif>否
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-2">头像<span class="required">*</span></label>
                  
                  <div class="col-lg-10">
                      <img src="{{$user->profile}}" width="70px" height="70px" alt="">
                      <input type="file" name="profile" required="" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-primary" type="submit">修改</button>
                      <input type="hidden" name="id" value="{{$user->id}}">
                      <input type="hidden" name="_method" value="PUT">
                  </div>
              </div>
              {{csrf_field()}}
          </form>
      </div>

  </div>
</section>
@endsection