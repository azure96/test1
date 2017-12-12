@extends('book.muban.admin')

@section('title','用户列表')

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
      用户列表
  </header>
  <form action="/user" >
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
         <th><i class="icon_calendar"></i> 用户名</th>
         <th><i class="icon_mail_alt"></i> 电子邮箱</th>
         <th><i ></i> 是否为管理员</th>
         <th><i ></i> 头像</th>
         <th><i class="icon_cogs"></i> 操作</th>
      </tr>
      @foreach($users as $k=>$v)
      <tr>
         <td>{{$v->id}}</td>
         <td>{{$v->username}}</td>
         <td>{{$v->email}}</td>
         @if($v->admin == 1) 
         <td> 是 </td>
         @elseif($v->admin == 0)
         <td> 否 </td>
         @endif
         <td><img src="{{$v->profile}}" width="50px" height="50px"></td>
         <td>
          <div class="btn-group">
              <a class="btn btn-primary" href="/user/{{$v->id}}/edit"><i class="icon_plus_alt2"></i></a>
              <form action="/user/{{$v->id}}" method="post" style="float: right; ">
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
	{!!$users->appends($request->only('num','keyword'))->render()!!}
  <!-- 给页码链接传递参数 -->
</div>
</section>
@endsection