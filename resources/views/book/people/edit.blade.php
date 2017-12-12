@extends('book.muban.admin')

@section('title','用户修改')

@section('people')
@endsection

@section('content')
<section class="panel" style="margin-left: -150px;">
  <header class="panel-heading">
      用户修改
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
          		action="{{url('/update')}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-5">用户名<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input class="form-control" name="username" value="{{$user->username}}" type="text" required="">
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">邮箱<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input class="form-control " type="email" name="email" value="{{$user->email}}">
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">头像<span class="required">*</span></label>
                  <img src="{{$user->profile}}">
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