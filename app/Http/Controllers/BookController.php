<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cate;
use App\Book;

class BookController extends Controller
{
    /**
     * 显示图书列表
     *
     * @return \Illuminate\Http\Response
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
        return view('book.books.index',['books'=>$books,'request'=>$request]);
    }

    /**
     * 显示图书添加的页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //获取分类信息
        $cates = Cate::get();
        return view('book.books.add',['cates'=>$cates]);
    }

    /**
     * 将图书信息插入数据库
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //表单验证
        $this->validate($request, [
            'name' => 'required|unique:books',
            'author'=>'required',
            'img'=>'required',
            'last'=>'required',
            'intro'=>'required',
        ],[
            'name.required'=>'必须输入用户名！',//设置中文显示
            'name.unique'=>'该图书已存在',
            'img.required'=>'必须上传图书封面！',
            'last.required'=>'必须输入库存！',
            'intro.required'=>'必须输入图书简介！'
        ]);

        $book = new Book;
        $book->name = $request->input('name');
        $book->author = $request->input('author');
        $book->last = $request->input('last');
        $book->intro = $request->input('intro');
        $book->cate_id = $request->input('cate');

        //检测图片是否上传
        if($request->hasfile('img')){
            //文件的存放目录
            $path = './Uploads/'.date('Ymd');
            //获取文件的后缀
            $suffix = $request->file('img')->getClientOriginalExtension();
            //文件名称
            $fileName = time().rand(1000000,9999999).'.'.$suffix;

            // $request->file('img')->move($destinationPath, $fileName);//$destinationPath文件目录
            $request->file('img')->move($path, $fileName);
            $book -> img =trim($path.'/'.$fileName,'.');//使用trim函数将相对路径改成绝对路径
        }

        //执行插入
        if($book->save()){
            return redirect('/book')->with('info','添加成功');//闪存信息
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
     * 显示修改图书信息的页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //获取图书的信息
        $book = Book::FindOrFail($id);
        //获取分类信息
        $cates = Cate::get();

        return view('book.books.edit',['book'=>$book,'cates'=>$cates]);
    }

    /**
     * 更新数据库里的图书信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //创建模型
        $book = Book::findOrFail($id);

        $book->name = $request->input('name');
        $book->author = $request->input('author');
        $book->last = $request->input('last');
        $book->intro = $request->input('intro');
        $book->cate_id = $request->input('cate');

        //检测图片是否上传
        if($request->hasfile('img')){
            //文件的存放目录
            $path = './Uploads/'.date('Ymd');
            //获取文件的后缀
            $suffix = $request->file('img')->getClientOriginalExtension();
            //文件名称
            $fileName = time().rand(1000000,9999999).'.'.$suffix;

            // $request->file('img')->move($destinationPath, $fileName);//$destinationPath文件目录
            $request->file('img')->move($path, $fileName);
            $book -> img =trim($path.'/'.$fileName,'.');//使用trim函数将相对路径改成绝对路径
        }

        //执行更新
        if($book->save()){
            return redirect('/book')->with('info','更新成功');//闪存信息
        }else{
            return back()->with('info','更新失败');
        }
    }

    /**
     * 删除数据库的图书信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取模型
        $book = Book::findOrFail($id);

        //读取用户的头像路径
        $img = $book->img;
        $path = '.'.$img;
        //判断路径是否存在
        if(file_exists($path)){
            //删除头像图片
            unlink($path);
        }

        //删除文章
        if($book->delete()){
            return back()->with('info','删除成功');
        }else{
            return back()->with('info','删除失败');
        }
    }
}
