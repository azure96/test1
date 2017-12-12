@extends('book.muban.admin')

@section('title','图书列表')

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
@if(session('kucun'))
<div id="clickMe" onclick="alert('这本书已经借完啦');" ></div>
@endif
@if(session('borrow'))
<div id="clickMe" onclick="alert('这本书暂时是你的啦');" ></div>
@endif
@if(session('chongfu'))
<div id="clickMe" onclick="alert('你已经借过这本书啦');" ></div>
@endif
@if(session('huanshu'))
<div id="clickMe" onclick="alert('还书成功');" ></div>
@endif
@if(session('huanshule'))
<div id="clickMe" onclick="alert('这本书已经还过啦');" ></div>
@endif
@if(session('duole'))
<div id="clickMe" onclick="alert('你已经借很多本书啦');" ></div>
@endif
<section class="panel" style="margin-left: -150px;">
  <header class="panel-heading">
      图书列表
  </header>
  <form action="/" >
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

  <table class="table table-striped table-advance table-hover">
   <tbody>
   	  @foreach($books as $k=>$v)
      <tr>
         <th><i class="icon_profile"></i> 图书号</th>
         <th><i class="icon_calendar"></i> 图书名</th>
         <th><i class="icon_mail_alt"></i> 作者</th>
         <th><i ></i> 分类</th>
         <th><i ></i> 简介</th>
         <th><i ></i> 封面</th>
         <th><i ></i> 库存</th>
         <th><i class="icon_cogs"></i> 操作</th>
      </tr>
      <tr>
         <td>{{$v->id}}</td>
         <td>{{$v->name}}</td>
         <td>{{$v->author}}</td>
         <td>{{$v->cate->name or '无分类'}}</td>
         <!-- 将简介太长的用省略号代替 -->
         <td>{{str_limit($v->intro, $limit = 12, $end = '...')}}</td>
         <td><img src="{{$v->img}}" width="50px" height="50px"></td>
         <td>{{$v->last}}</td>
         <td>
          <div class="btn-group">
              <a class="btn btn-primary" href="/borrow/{{$v->id}}">我要借书</a><hr>
              <a class="btn btn-primary" href="/return/{{$v->id}}">我要还书</a>
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