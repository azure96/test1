<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use App\User;
use Hash;
use App\Cate;
use App\Borrow;

class PeopleController extends Controller
{
    /**
     * 显示图书页面
     * @return [type] [description]
     */
    public function index(Request $request)
    {   
        //读取图书信息
        $books = Book::orderBy('id','desc')
                ->where(function($query) use ($request){
                    //获取关键字
                    $keyword = $request->input('keyword');
                    //检测关键字是否为空
                    if(!empty($keyword)){
                        $query->where('name','like','%'.$keyword.'%');
                    }
                })
                ->paginate($request->input('num',10));
        return view('book.people.index',['books'=>$books,'request'=>$request]);
    }

    /**
     * 用户登录
     */
    public function login(Request $request){
        //判断用户是否存在
        if($request->username == User::where('username','=',$request->username)->pluck('username')){
            $user = User::where('username',$request->username)->firstOrFail();
            //检测密码是否正确
            if(Hash::check($request->password,$user->password)){
                //写入登录状态
                session(['uid'=>$user->id]);
                if($user->admin == 1){
                    return redirect('/admin')->with('success','登录成功');
                }else{
                    return redirect('/')->with('success','登录成功');
                }
            }else{
                //withInput()函数将之前输入的值返回，前台用old()函数接收
                return back()->with('mima','密码不正确')->withInput();
            }
        }else{
            return back()->with('yonghu','用户不存在');
        }
    }

    /**
     * 普通用户查看自己资料
     */
    public function myprofile(){
        //获取用户信息
        $user = User::find(session('uid'));
        return view('book.people.myprofile',['user'=>$user]);
    }

    /**
     * 显示普通用户注册的页面
     */
    public function add(){
        return view('book.people.add');
    }

    /**
     * 普通用户注册操作处理
     */
    public function doadd(Request $request){
        //手动表单验证
        $this->validate($request, [
            'username' => 'required|regex:/\w{4,20}/',//regex正则表达式(是否符合4到20位的字母数字下划线)
            'email'=>'required|email|unique:users',
            'repassword'=>'required',
            'password'=>'required|same:repassword',
            'profile'=>'required',
        ],[
            'username.required'=>'必须输入用户名！',//设置中文显示
            'username.regex'=>'用户名要由4到20位的字母数字下划线组成',
            'email.required'=>'必须输入电子邮箱！',
            'email.email'=>'电子邮箱的格式不正确',
            'email.unique'=>'该邮箱已注册',
            'password.required'=>'必须输入密码',
            'repassword.required'=>'请输入确认密码',
            'password.same'=>'两次密码输入不一样！', 
            'profile.required'=>'请选择头像'
        ]);

        //将数据插入数据库
        $user = new User;
        $user -> username = $request->input('username');
        $user -> email = $request->input('email');
        $user -> password = Hash::make($request->input('password'));//使用哈希函数来加密密码
        $user -> admin = 0;

        //随机字符串标识
        $user -> remember_token = str_random('50');

        //检测图片是否上传
        if($request->hasfile('profile')){
            //文件的存放目录
            $path = './Uploads/'.date('Ymd');
            //获取文件的后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();
            //文件名称
            $fileName = time().rand(1000000,9999999).'.'.$suffix;

            // $request->file('profile')->move($destinationPath, $fileName);//$destinationPath文件目录
            $request->file('profile')->move($path, $fileName);
            $user -> profile =trim($path.'/'.$fileName,'.');//使用trim函数将相对路径改成绝对路径
        }

        //执行插入
        if($user->save()){
            return redirect('/login')->with('info','注册成功')->withInput();//闪存信息
        }else{
            return back()->with('info','注册失败');
        }
    }

    /**
     * 普通用户修改自己的资料
     */
    public function edit(){
        //获取用户的资料
        $user = User::find(session('uid'));

        return view('book.people.edit',['user'=>$user]);
    }

    /**
     * 普通用户更新自己的资料
     */
    public function update(Request $request){
        //获取当前用户的信息
        $user = User::find(session('uid'));

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        //检测是否有文件上传
        if($request->hasFile('profile')){
            //拼接文件夹路径
            $destinationPath = './Uploads/'.date('Y-m-d').'/';
            //拼接文件路径
            $fileName = time().rand(100000,999999);
            //获取上传文件的后缀名
            $suffix = $request->file('profile')->getClientOriginalExtension();
            //文件的完整名称
            $path = $fileName.'.'.$suffix;
            $request->file('profile')->move($destinationPath,$path);
            //拼接文件上传之后的路径
            $user->profile = trim($destinationPath.$path,'.');
        }else{
            echo '文章主图没上传';
        }

        if($user->save()){
            return redirect('/myprofile')->with('update','更新成功');
        }else{
            return back()->with('update','更新失败');
        }
    }

    /**
     * 显示修改密码的页面
     */
    public function repassword(){
        return view('book.muban.repassword');
    }

    /**
     * 更新数据库的用户密码
     */
    public function updatepassword(Request $request){
        $user = User::find(session('uid'));
        //表单验证
        $this->validate($request, [
            'old' => 'required',//regex正则表达式(是否符合4到20位的字母数字下划线)
            'repassword'=>'required',
            'new'=>'required|same:repassword',
        ],[
            'old.required'=>'必须输入旧密码！',//设置中文显示
            'new.required'=>'必须输入新密码',
            'repassword.required'=>'请输入确认密码',
            'new.same'=>'两次新密码不一致！', 
        ]);

        //判断旧密码是否正确
        if(Hash::check($request->old,$user->password)){
                //更新数据库的用户密码
                $user->password = Hash::make($request->input('new'));
                //执行更新
                if($user->save()){
                    return redirect('/login')->with('gaimima','..');
                }else{
                    return back()->with('info','修改失败');
                }
        }else{
                return back()->with('mima','旧密码不正确');
        }
    }

    /**
     * 显示借书页面
     */
    public function borrow($id){
        //获取书本信息
        $book = Book::findOrFail($id);
        //获取分类信息
        $cates = Cate::get();

        return view('book.people.borrow',['book'=>$book,'cates'=>$cates]);
    }

    /**
     * 把借书的信息存入数据库
     */
    public function borrowbook($id){
        //获取图书的信息
        $book = Book::findOrFail($id);
        //获取用户的信息
        $user = User::find(session('uid'));

        $borrows =count(Borrow::where('returns',0)->where('user_id',$user->id)->get());
        if($borrows > 3){
            return redirect('/')->with('duole','..');
        }

        //判断是否已经借了这本书
        $top = count(Borrow::where('bookname','=',$book->name)
                        ->where('user_id','=',$user->id)
                        ->where('returns',0)
                        ->get()
                        );
        if($top >= 1){
            return redirect('/')->with('chongfu','..');
        }else{
            //判断库存是否为零
            if($book->last == 0){
                return redirect('/')->with('kucun','没书啦');
            }else{
                $borrow = new Borrow;
                $borrow->book_id = $book->id;
                $borrow->bookname = $book->name;
                $borrow->cate_id = $book->cate_id;
                $borrow->user_id = $user->id;
                $borrow->returns = 0;
                //图书的库存减一
                $book->last = $book->last -1;
                
                //执行保存
                if($borrow->save() && $book->save()){
                    return redirect('/')->with('borrow','..');
                }else{
                    return back()->with('info','失败');
                }
            }
        }
    }

    /**
     * 显示还书的页面
     */
    public function returnbook($id){
        //获取图书信息
        $book = Book::findOrFail($id);
        //获取用户信息
        $user = User::find(session('uid'));

        return view('book.people.return',['book'=>$book,'user'=>$user]);
    }

    /**
     * 还书后的数据库变化处理
     */
    public function returnback(Request $request,$id){

        $this->validate($request, [
            'adminnum' => 'required',
        ],[
            'adminnum.required'=>'必须输入管理员验证码！',//设置中文显示
        ]);
        //获取图书的信息
        $book = Book::findOrFail($id);
        //获取用户的信息
        $user = User::find(session('uid'));

        //获取第一个满足条件的那一行所有信息
        $borrow = Borrow::where('bookname','=',$book->name)
                        ->where('user_id','=',$user->id)
                        ->where('returns',0)
                        ->first();

        //管理员确认还书
        if($request->adminnum == 9999){
            //判断这本书是不是已经还过了
            if($borrow == null){
                return redirect('/')->with('huanshule','..');
            }else{
                //添加归还时间
                $borrow->return_time = date('Y-m-d');  
                //归还状态1是已归还         
                $borrow->returns = 1;
                //图书的库存加一
                $book->last = $book->last +1;
                
                //执行保存
                if($borrow->save() && $book->save()){
                    return redirect('/')->with('huanshu','..');
                }else{
                    return back()->with('info','失败');
                }
            }
        }else{
            return back()->with('yanzheng','管理员验证码错误');
        }
        
        }

    /**
     * 显示我借的图书
     */
    public function mybook(){
        $user = User::find(session('uid'));
        $books = Book::get();
        $borrow = Borrow::orderBy('returns','asc')->where('user_id',$user->id)->paginate(10);
        return view('book.people.mybook',['borrow'=>$borrow,'books'=>$books]);
    }

    /**
     * 显示所有借出的图书
     */
    public function allborrow(){
        $borrow = Borrow::orderBy('returns','asc')->paginate(10);
        return view('book.people.allborrow',['borrow'=>$borrow]);
    }
}
