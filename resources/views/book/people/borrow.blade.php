@extends('book.muban.admin')

@section('title','图书信息')

@section('people')
@endsection

@section('content')
<section class="panel" style="margin-left: -150px;">
  <header class="panel-heading">
      图书信息
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
          		action="{{url('/borrow/'.$book->id)}}" enctype="multipart/form-data" novalidate="novalidate">
              <div class="form-group ">
                  <label for="cname" class="control-label col-lg-5">图书名:</label>
                  <label for="cname" class="control-label col-lg-1" style="text-align: left;">{{$book->name}}</label>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">作者:</label>
                  <label for="cname" class="control-label col-lg-1" style="text-align: left;">{{$book->author}}</label>
              </div>
              <div class="form-group">
	              <label class="control-label col-lg-5" for="inputSuccess">分类:</label>
	              <label for="cname" class="control-label col-lg-1" style="text-align: left;">{{$book->cate->name}}</label>
	          </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">封面:</label>
                  <div class="col-lg-4">
                      <img src="{{$book->img}}" style="width: 200px;height: 200px;">
                  </div>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">库存:</label>
                  <label for="cname" class="control-label col-lg-1" style="text-align: left;">{{$book->last}}</label>
              </div>
              <div class="form-group ">
                  <label for="cemail" class="control-label col-lg-5">图书简介:</label>
                  <label for="cname" class="control-label col-lg-5" style="text-align: left;">{{$book->intro}}</label>
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