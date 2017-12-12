@extends('book.muban.admin')

@section('title','图书添加')

@section('content')
<section class="panel">
  <header class="panel-heading">
      图书添加
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
          		action="{{url('/book')}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-2">图书名<span class="required">*</span></label>
                  <div class="col-lg-3">
                      <input class="form-control" name="name" value="{{old('name')}}" type="text" required="">
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-2">作者<span class="required">*</span></label>
                  <div class="col-lg-2">
                      <input class="form-control " type="text" name="author" value="{{old('author')}}">
                  </div>
              </div>
              <div class="form-group">
	              <label class="control-label col-lg-2" for="inputSuccess">分类<span class="required">*</span></label>
	              <div class="col-lg-2">
	                  <select class="form-control" name="cate">
	                      <option value="0" >请选择</option>
	                      <!-- 遍历数据库里面已有的分类 -->
          						  @foreach($cates as $k=>$v)
          						  <option value="{{$v->id}}">{{$v->name}}</option>
          						  @endforeach
	                  </select>
	              </div>
	          </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-2">封面<span class="required">*</span></label>
                  <div class="col-lg-4">
                      <input type="file" name="img" required="" >
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-2">库存<span class="required">*</span></label>
                  <div class="col-lg-1">
                      <input class="form-control " type="text" name="last" required="" 
                      value="{{old('last')}}">
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-2">图书简介<span class="required">*</span></label>
                  <div class="col-lg-10" >
                      <textarea rows="10" cols="70" name="intro">{{old('intro')}}</textarea>
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