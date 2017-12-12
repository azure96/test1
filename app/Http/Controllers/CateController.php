<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cate;

class CateController extends Controller
{
    /**
     * 显示分类列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //读取分类信息
        $cates = Cate::orderBy('id','desc')
                ->where(function($query) use ($request){
                    //获取关键字
                    $keyword = $request->input('keyword');
                    //检测关键字是否为空
                    if(!empty($keyword)){
                        $query->where('name','like','%'.$keyword.'%');
                    }
                })
                ->paginate($request->input('num',10));
        return view('book.cate.index',['cates'=>$cates,'request'=>$request]);
    }

    /**
     * 显示分类添加的页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.cate.add');
    }

    /**
     * 将分类信息插入数据库
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //手动表单验证
        $this->validate($request, [
            'name' => 'required|unique:cates',
        ],[
            'name.required'=>'必须输入用户名！',//设置中文显示
            'name.unique'=>'分类名已存在'
        ]);

        //新建模型
        $cate = new Cate;
        $cate->name = $request->input('name');

        //插入数据库
        if($cate->save()){
            return redirect('/cate')->with('info','添加成功');
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
     * 显示修改分类的页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //获取分类信息
        $cate = Cate::FindOrFail($id);

        return view('book.cate.edit',['cate'=>$cate]);
    }

    /**
     * 更新数据库的分类信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //创建模型
        $cate = Cate::FindOrFail($id);

        $cate->name = $request->input('name');

        //插入数据库
        if($cate->save()){
            return redirect('/cate')->with('info','修改成功');
        }else{
            return back()->with('info','修改失败');
        }
    }

    /**
     * 删除分类信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取模型
        $cate = Cate::FindOrFail($id);

        if($cate->delete()){
            return back()->with('info','删除成功');
        }else{
            return back()->with('info','删除失败');
        }
    }
}
