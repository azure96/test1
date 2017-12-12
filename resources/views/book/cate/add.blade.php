@extends('book.muban.admin')

@section('title','分类添加')

@section('content')
<section class="panel">
  <header class="panel-heading">
      分类添加
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
          		action="{{url('/cate')}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-2">分类名<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input class="form-control" name="name" value="{{old('name')}}" type="text" required="">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-4">
                      <button class="btn btn-primary" type="submit">提交</button>
                  </div>
              </div>
              {{csrf_field()}}
          </form>
      </div>

  </div>
</section>
@endsection