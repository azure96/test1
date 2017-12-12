<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class UserController extends Controller
{
    /**
     * 显示用户列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //读取用户信息
        $users = User::orderBy('id','desc')
                ->where(function($query) use ($request){
                    //获取关键字
                    $keyword = $request->input('keyword');
                    //检测关键字是否为空
                    if(!empty($keyword)){
                        $query->where('username','like','%'.$keyword.'%');
                    }
                })
                ->paginate($request->input('num',10));
        return view('book.user.index',['users'=>$users,'request'=>$request]);
    }

    /**
     * 显示添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.user.add');
    }

    /**
     * 将用户的数据插入数据库
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //手动表单验证
        $this->validate($request, [
            'username' => 'required|regex:/\w{4,20}/|unique:users',//regex正则表达式(是否符合4到20位的字母数字下划线)
            'email'=>'required|email|unique:users',
            'repassword'=>'required',
            'password'=>'required|same:repassword',
            'admin'=>'required',
            'profile'=>'required',
        ],[
            'username.required'=>'必须输入用户名！',//设置中文显示
            'username.regex'=>'用户名要由4到20位的字母数字下划线组成',
            'username.unique'=>'用户名已存在',
            'email.required'=>'必须输入电子邮箱！',
            'email.email'=>'电子邮箱的格式不正确',
            'email.unique'=>'该邮箱已注册',
            'password.required'=>'必须输入密码',
            'repassword.required'=>'请输入确认密码',
            'password.same'=>'两次密码输入不一样！', 
            'admin.required'=>'请选择是否是管理员',
            'profile.required'=>'请选择头像'
        ]);

        //将数据插入数据库
        $user = new User;
        $user -> username = $request->input('username');
        $user -> email = $request->input('email');
        $user -> password = Hash::make($request->input('password'));//使用哈希函数来加密密码
        $user -> admin =$request->input('admin');

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
            return redirect('/user')->with('info','添加成功');//闪存信息
        }else{
            return back()->with('info','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改信息页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //读取用户的信息
        $user = User::FindOrFail($id);

        return view('book.user.edit',['user'=>$user]);
    }

    /**
     * 更新数据库用户信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //创建模型
        $user = User::findOrFail($id);

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->admin = $request->input('admin');
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
            return redirect('/user')->with('info','更新成功');
        }else{
            return back()->with('info','更新失败');
        }
    }

    /**
     * 删除用户信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取模型
        $user = User::findOrFail($id);

        //读取用户的头像路径
        $profile = $user->profile;
        $path = '.'.$profile;
        //判断路径是否存在
        if(file_exists($path)){
            //删除头像图片
            unlink($path);
        }

        //删除文章
        if($user->delete()){
            return back()->with('info','删除成功');
        }else{
            return back()->with('info','删除失败');
        }
    }
}
