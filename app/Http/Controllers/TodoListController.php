<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;//追加
use App\Models\TodoList;//追加


class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //バリデーション
      // リスト名は必須項目
      //リスト名は３０字以内
        $validated = $request->validate([
        'list_name' => 'required|max:30',
        ]);
        
      $todo_list=new TodoList();
      
      //データの割り当て
      $todo_list->list_name =$request->input('list_name');
      $todo_list->todo_id=$request->input('todo_id');
      
      // リクエストの確認
      // dd($request->all());
      
      // 保存
      $todo_list->save();
      // Todo詳細画面にリダイレクト
      return redirect()->route('todos.show',$todo_list->todo_id);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Todo $todo, TodoList $todo_list)
    {
      // リストの編集ボタンを押した時
      if($request->status===null){
        
      //バリデーション
      // リスト名は必須項目
      //リスト名は３０字以内
        $validated = $request->validate([
        'list_name' => 'required|max:30',
        ]);
        
      
        $todo_list->list_name=$request->input('list_name');
        $todo_list->save();
        return redirect()->route('todos.edit',$todo_list->todo_id);
      }else{
      
        //ステータスを未完了（デフォルト）→完了 false:未完了 true:完了
        $todo_list->status= true;
        //データの保存
        $todo_list->save();
        // 詳細画面のリダイレクト
        return redirect()->route('todos.show',$todo_list->todo_id);
      }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo, TodoList $todo_list)
    {
        $todo_list->delete();
        return redirect()->route('todos.show',$todo_list->todo_id);
        
    }
}
