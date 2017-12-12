@extends('book.muban.admin')

@section('title','分类修改')

@section('content')
<section class="panel">
  <header class="panel-heading">
      分类修改
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
          		action="{{url('/cate/'.$cate->id)}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-2">分类名<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input class="form-control" name="name" value="{{$cate->name}}" type="text" required="">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-4">
                      <button class="btn btn-primary" type="submit">提交</button>
                      <input type="hidden" name="id" value="{{$cate->id}}">
                      <input type="hidden" name="_method" value="PUT">
                  </div>
              </div>
              {{csrf_field()}}
          </form>
      </div>

  </div>
</section>
@endsection