<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;//日付取得

use App\Models\Todo;//追加
use App\Models\User;//追加
use App\Models\TodoList;//追加
use App\Models\Category;//追加

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //  ログインユーザーのタスクのみを表示
      // 予定日の早い順から表示
      $todos=Todo::where('user_id',\Auth::user()->id)->get()->sortBy('due_date');
      
       //categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
      $category = new Category;
      $categories = $category->getLists();
      
      $category_id = $request->input('category_id'); //カテゴリの値
      
      // 現在の日時を取得
      $now = Carbon::now();
      return view('todos.index',compact('todos','categories','now'));
    }
    
  
     public function category_search(Request $request)
    {
      $category_id= $request->input('category_id'); 
      //categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
      $category = new Category;
      $categories = $category->getLists();
      
      // $todos=Todo::query()->where('user_id',\Auth::user()->id)->where('category_id',$category_id)->get()->sortBy('due_date');
      $todos=Todo::where('user_id',\Auth::user()->id)->where('category_id',$category_id)->get()->sortBy('due_date');
      
      // 現在の日時を取得
      $now = Carbon::now();
      return view('todos.category_search',compact('todos','categories','now','category_id'));
    }
    
    
    public function about()
    {
       return view('todos.about');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
      // プラン名、予定日は必須項目
      // プラン名は３０字以内
      // カテゴリは必須項目
        $validated = $request->validate([
        'title' => 'required|max:30',
        'due_date' => 'required',
        'category_id' => 'required',
        ]);

          // 新規作成
          $todo = new Todo;
          
         
          //データを割り当てる
          $todo->title = $request->input('title');
          $todo->due_date = $request->input('due_date');
          $todo->user_id = $request->user()->id;
          $todo->category_id= $request->input('category_id');
          
          // リクエストの確認
          // dd($request->all());
          
          //保存
          $todo->save();
          //リダイレクト
          return redirect('/todos');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $todo= Todo::find($id);
      $todo->todo_lists();
      return view('todos.show',compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $todo = Todo::find($id);
      $todo->todo_lists();
      
      //categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
      $category = new Category;
      $categories = $category->getLists();
      
      
      return view('todos.edit',compact('todo','categories'));
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      if($request->status===null){
        
       //バリデーション
      // プラン名、予定日は必須項目
      // プラン名は３０字以内
      // カテゴリーは必須項目
        $validated = $request->validate([
        'title' => 'required|max:30',
        'due_date' => 'required',
        'category_id' => 'required',
        ]);

      // 編集ボタンを押した時
      
      // 該当データを検索
        $todo=Todo::find($id);
        
        // データの割り当て
        $todo->title = $request->input('title');
        $todo->due_date = $request->input('due_date');
        $todo->category_id = $request->input('category_id');
        $todo->todo_lists->list_name=$request->input('list_name');
        $todo->save();
        
        // 詳細画面のリダイレクト
        return redirect()->route('todos.show',$todo->id);

      }else{
        // 完了ボタンを押した時
        $todo = Todo::find($id);
        // データの割り当て。true:完了、false:未完了
        $todo->status = true;
         //データベースに保存
        $todo->save();
       return redirect()->route('todos.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function destroy($id)
    {
        $todo=Todo::find($id);
        $todo->delete();
        return redirect('/todos');
    }
    
}
