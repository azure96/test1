
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="{{asset('/admins/img/favicon.png')}}">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->    
    <link href="{{asset('/admins/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{asset('/admins/css/bootstrap-theme.css')}}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{asset('/admins/css/elegant-icons-style.css')}}" rel="stylesheet" />
    <link href="{{asset('/admins/css/font-awesome.min.css')}}" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="{{asset('/admins/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css')}}" rel="stylesheet" />
	<link href="{{asset('/admins/assets/fullcalendar/fullcalendar/fullcalendar.css')}}" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="{{asset('/admins/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{asset('/admins/css/owl.carousel.css')}}" type="text/css">
	<link href="{{asset('/admins/css/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="{{asset('/admins/css/fullcalendar.css')}}">
	<link href="{{asset('/admins/css/widgets.css')}}" rel="stylesheet">
    <link href="{{asset('/admins/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/admins/css/style-responsive.css')}}" rel="stylesheet" />
	<link href="{{asset('/admins/css/xcharts.min.css')}}" rel=" stylesheet">	
	<link href="{{asset('/admins/css/jquery-ui-1.10.4.min.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="{{asset('/admins/js/html5shiv.js')}}')}}"></script>
      <script src="{{asset('/admins/js/respond.min.js')}}"></script>
      <script src="{{asset('/admins/js/lte-ie7.js')}}"></script>
    <![endif]-->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
            </div>
            
            @if(session('uid'))
              <?php $user = \App\User::find(session('uid')); ?>
              @if($user->admin == 1)
              <a href="/admin" class="logo">图书 <span class="lite">管理</span></a>
              @elseif($user->admin == 0)
              <a href="/" class="logo">图书 <span class="lite">管理</span></a>
              @endif
              <script type="text/javascript">  
                  //触发onclick事件
                  setTimeout(function() {
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
                  }, );
              </script> 
              @if(session('success'))
              <div id="clickMe" onclick="alert('登录成功');" ></div>
              @endif
              <div class="top-nav notification-row">                
                  <!-- notificatoin dropdown start-->
                  <ul class="nav pull-right top-menu" style="margin-right: 50px;margin-top: -5px;">
                      <!-- user login dropdown start-->
                      <li class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                              <span class="profile-ava">
                                  
                                  <img alt="" src="{{$user->profile}}" style="width: 40px;height: 40px;">
                                  
                              </span>
                              <span class="username" style="font-size: 20px;">{{$user->username}}</span>
                              <b class="caret"></b>
                          </a>
                          @section('touxiang')
                          <ul class="dropdown-menu extended logout">
                              <div class="log-arrow-up"></div>
                              <li>
                                  <a href="/repassword"><i class="icon_mail_alt"></i>修改密码</a>
                              </li>
                              <li>
                                  <a href="/logout"><i class="icon_clock_alt"></i>注销</a>
                              </li>
                          </ul>
                          @show
                      </li>
                      <!-- user login dropdown end -->
                  </ul>
                  <!-- notificatoin dropdown end-->
              </div>
            @elseif(!session('uid'))
            <a href="/" class="logo">图书 <span class="lite">管理</span></a>
              <div class="top-nav notification-row">                
                  <ul class="nav pull-right top-menu" style="margin-right: 50px;margin-top: 10px;font-size: 20px;">
                        <a href="/login" style="color: #eae410">登录</a>
                        <a href="/add" style="color: #eae410;padding-left: 3px;margin-top:2px">注册</a>
                  </ul>
              </div>
            @endif
            
      </header>      
      <!--header end-->

      <!--sidebar start-->
      @section('people')
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
				  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>用户管理</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="{{url('/user/create')}}">用户添加</a></li>
                          <li><a class="" href="{{url('/user/')}}">用户列表</a></li>
                      </ul>
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>分类管理</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="{{url('/cate/create')}}">分类添加</a></li>
                          <li><a class="" href="{{url('/cate')}}">分类列表</a></li>
                      </ul>
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>图书管理</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="{{url('/book/create')}}">图书添加</a></li>
                          <li><a class="" href="{{url('/book')}}">图书列表</a></li>
                          <li><a class="" href="{{url('/allborrow')}}">借出的图书</a></li>
                      </ul>
                  </li>       
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      @show
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
              @if(session('info'))
              <div class="alert alert-success fade in">
                <strong>{{session('info')}}</strong>
              </div>
              @endif
			        @section('content')

              @show
      </section>
      <!--main content end-->
     </section>
  <!-- container section start -->
     
    <!-- javascripts -->
    <script src="{{asset('/admins/js/jquery.js')}}"></script>
	<script src="{{asset('/admins/js/jquery-ui-1.10.4.min.js')}}"></script>
    <script src="{{asset('/admins/js/jquery-1.8.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admins/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{asset('/admins/js/bootstrap.min.js')}}"></script>
    <!-- nice scroll -->
    <script src="{{asset('/admins/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('/admins/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="{{asset('/admins/assets/jquery-knob/js/jquery.knob.js')}}"></script>
    <script src="{{asset('/admins/js/jquery.sparkline.js')}}" type="text/javascript"></script>
    <script src="{{asset('/admins/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
    <script src="{{asset('/admins/js/owl.carousel.js')}}" ></script>
    <!-- jQuery full calendar -->
    <<script src="{{asset('/admins/js/fullcalendar.min.js')}}"></script> <!-- Full Google Calendar - Calendar -->
	<script src="{{asset('/admins/assets/fullcalendar/fullcalendar/fullcalendar.js')}}"></script>
    <!--script for this page only-->
    <script src="{{asset('/admins/js/calendar-custom.js')}}"></script>
	<script src="{{asset('/admins/js/jquery.rateit.min.js')}}"></script>
    <!-- custom select -->
    <script src="{{asset('/admins/js/jquery.customSelect.min.js')}}" ></script>
	<script src="{{asset('/admins/assets/chart-master/Chart.js')}}"></script>
   
    <!--custome script for all page-->
    <script src="{{asset('/admins/js/scripts.js')}}"></script>
    <!-- custom script for this page-->
    <script src="{{asset('/admins/js/sparkline-chart.js')}}"></script>
    <script src="{{asset('/admins/js/easy-pie-chart.js')}}"></script>
	<script src="{{asset('/admins/js/jquery-jvectormap-1.2.2.min.js')}}"></script>
	<script src="{{asset('/admins/js/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('/admins/js/xcharts.min.js')}}"></script>
	<script src="{{asset('/admins/js/jquery.autosize.min.js')}}"></script>
	<script src="{{asset('/admins/js/jquery.placeholder.min.js')}}"></script>
	<script src="{{asset('/admins/js/gdp-data.js')}}"></script>	
	<script src="{{asset('/admins/js/morris.min.js')}}"></script>
	<script src="{{asset('/admins/js/sparklines.js')}}"></script>	
	<script src="{{asset('/admins/js/charts.js')}}"></script>
	<script src="{{asset('/admins/js/jquery.slimscroll.min.js')}}"></script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});



  </script>

  </body>
</html>
