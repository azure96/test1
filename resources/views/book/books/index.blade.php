@extends('book.muban.admin')

@section('title','图书列表')

@section('content')
<script type="text/javascript">
function warn() { 
   var msg = "您真的确定要删除吗？\n\n请确认！"; 
   if (confirm(msg)==true){ 
    return true; 
   }else{ 
    return false; 
   } 
} 
</script>
<section class="panel">
  <header class="panel-heading">
      图书列表
  </header>
  <form action="/book" >
	  <div id="example_length" class="dataTables_length">
	  		<label>显示 
	  			<select size="1" name="num">
		  			<option value="10" @if($request->input('num') == 10) selected="selected" @endif>10</option>
		  			<option value="25" @if($request->input('num') == 25) selected="selected" @endif>25</option>
		  			<option value="50" @if($request->input('num') == 50) selected="selected" @endif>50</option>
		  			<option value="100" @if($request->input('num') == 100) selected="selected" @endif>100</option>
	  			</select> 条
	  		</label>
	  		<label style="float: right;padding-right: 60px">关键字: <input type="text" name="keyword" value="{{$request->input('keyword')}}">
	  		<button class="btn btn-danger" >搜索</button>
	  		</label>
	  </div>
	  {{csrf_field()}}

  </form>

<!--   <div class="dataTables_filter" id="example_filter"></div> -->

  <table class="table table-striped table-advance table-hover">
   <tbody>
   	  
      <tr>
         <th><i class="icon_profile"></i> ID</th>
         <th><i class="icon_calendar"></i> 图书名</th>
         <th><i class="icon_mail_alt"></i> 作者</th>
         <th><i ></i> 分类</th>
         <th><i ></i> 简介</th>
         <th><i ></i> 头像</th>
         <th><i class="icon_cogs"></i> 操作</th>
      </tr>
      @foreach($books as $k=>$v)
      <tr>
         <td>{{$v->id}}</td>
         <td>{{$v->name}}</td>
         <td>{{$v->author}}</td>
         <td>{{$v->cate->name or '无分类'}}</td>
         <!-- 将简介太长的用省略号代替 -->
         <td>{{str_limit($v->intro, $limit = 12, $end = '...')}}</td>
         <td><img src="{{$v->img}}" width="50px" height="50px"></td>
         <td>
          <div class="btn-group">
              <a class="btn btn-primary" href="/book/{{$v->id}}/edit"><i class="icon_plus_alt2"></i></a>
              <form action="/book/{{$v->id}}" method="post" style="float: right; ">
                <input type="hidden" name="_method" value="DELETE">
                {{csrf_field()}}
                <button class="btn btn-danger" onclick="return warn();">
                  <i class="icon_close_alt2"></i>
                </button>
              </form>
          </div>
          </td>
      </tr>  
      @endforeach                          
   </tbody>
</table>
<style type="text/css">
.btn-info {
    color: #ffffff;
    background-color: #34aadc;
    border-color: #34aadc;
}
#pages{
	float: right;
	padding-right: 100px;
}
</style>
<div id="pages">
	{!!$books->appends($request->only('num','keyword'))->render()!!}
  <!-- 给页码链接传递参数 -->
</div>
</section>
@endsection