@extends('layouts.app')
@section('content')

  <div class="container edit_box">
    <h1><strong>プラン編集</strong></h1>
    
    <!--エラーメッセージ-->
    <div class="error_box">
    @foreach ($errors->all() as $error)
      <li class="error_message">{{$error}}</li>
    @endforeach
    </div>
    <!--エラーメッセージ-->

  <div class="edit_contents">
    <!--大目標の編集-->
    <div class="todo_edit">
    <form action="/todos/{{$todo->id}}" method="POST">
    @csrf
    @method('PUT')
     <div class="plan_edit">
      <h2><strong>目標プランの変更</strong></h2>
        <table class="edit_table">
          <tr>
            <th><label>プラン名</label></th>
            <td><input class="edit_input"type="text" value="{{$todo->title}}" name="title" /></td>
          </tr>
          <tr>
            <th><label>予定日</label></th>
            <td><input class="edit_input" type="text"  name="due_date" id="due_date" value="{{ $todo->due_date }}" /></td>
          </tr>
          <tr>
            <th><label>カテゴリ</label></th>
            <td>
              {{Form::select('category_id',$categories->prepend('選択してください', ''),['id'=>'category_name'])}}
            </td>
          </tr>
        </table>
      </div>
      <button type="submit"><strong class="edit_button" >編集する</strong></button>
    </form>
    </div>
    <!--大目標の編集-->
  
  <div class="todo_list_edit">
    <h3><strong>やることリストの変更</strong></h3>
    <table>
    @foreach($todo->todo_lists as $todo_list)
    @if($todo_list->status==false)
    <form action="/todo/{{$todo->id}}/todo_lists/{{$todo_list->id}}" method="post">
    @csrf
    @method('PUT')
      <tr>
        <td>
          <input class="edit_input"type="text" value="{{$todo_list->list_name}}" name="list_name" />
        </td>
        <td>
          <button type="submit"><strong class="green_button" >編集する</strong></button>
        </td>
      </tr>
    </form>
    @endif
    @endforeach
    </table>
  </div>
  
  </div> <!-- edit_contents -->  
  <a href="/todos/{{$todo->id}}"><p class="return">詳細画面へ戻る</p></a>
  
  </div><!--edit_box-->
  
    <!-- flatpickrスクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <!-- 日本語化のための追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <script>
      flatpickr(document.getElementById('due_date'), {
        locale: 'ja',
        dateFormat: "Y/m/d",
        minDate: new Date()
      });
    </script>
@endsection