@extends('book.muban.admin')

@section('title','借出的书')

@section('touxiang')
<ul class="dropdown-menu extended logout">
    <div class="log-arrow-up"></div>
    <li>
        <a href="/repassword"><i class="icon_mail_alt"></i>修改密码</a>
    </li>
    <li>
        <a href="logout"><i class="icon_clock_alt"></i>注销</a>
    </li>
</ul>
@endsection

@section('content')
<section class="panel" >
  <header class="panel-heading">
      图书列表
  </header>
  <table class="table table-striped table-advance table-hover">
   <tbody>
   	  
      <tr style="text-align: center;">
      	 <th style="text-align: center;"> 图书号</th>
         <th style="text-align: center;"> 图书名</th>
         <th style="text-align: center;"> 借书人</th>
         <th style="text-align: center;"> 借书时间</th>
         <th style="text-align: center;"> 还书时间</th>
         <th style="text-align: center;"> 是否还书</th>
      </tr>
      @foreach($borrow as $k=>$v)
      <tr>
         <td style="text-align: center;">{{$v->book_id}}</td>
         <td style="text-align: center;">{{$v->bookname}}</td>
         <td style="text-align: center;">{{$v->user->username}}</td>
         <td style="text-align: center;">{{$v->created_at}}</td>
         @if($v->returns == 1) 
         <td style="text-align: center;">{{$v->updated_at}}</td>
         <td style="text-align: center;"> 是 </td>
         @elseif($v->returns == 0)
         <td style="text-align: center;">无</td>
         <td style="text-align: center;"> 否 </td>
         @endif
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
{!! $borrow->render() !!}
  <!-- 给页码链接传递参数 -->
</div>
</section>
@endsection