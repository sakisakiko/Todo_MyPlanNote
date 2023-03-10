@extends('layouts.app')
@section('content')
  <div class="container edit_box">
    <h1><strong>プラン編集</strong></h1>
    
    <!--エラーメッセージ-->
    <div class="error_box">
    @foreach ($errors->all() as $error)
      <li class="error_message_edit">{{$error}}</li>
    @endforeach
    </div>
    <!--エラーメッセージ-->
    <div class="edit_contents">
      <form action="/todos/{{$todo->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="plan_edit">
          <table class="edit_table">
            <tr>
              <th>プラン名</th>
              <td><input class="edit_input"type="text" value="{{$todo->title}}" name="title" /></td>
            </tr>
            <tr>
              <th>予定日</th>
              <td><input class="edit_input" type="text"  name="due_date" id="due_date" value="{{ $todo->due_date }}" /></td>
            </tr>
            <tr>
              <th>カテゴリ</th>
              <td>
                 {{Form::select('category', ['---' => '---','仕事' => '仕事', '家事' => '家事','学習' => '学習','趣味' => '趣味','旅行' => '旅行', 'その他' => 'その他'], old('category', $todo->category))}}
              </td>
              <th></th>
              <td><button type="submit"><span class="edit_button" ><strong>編集する</strong></span></button></td>
            </tr>
          </table>
        </div>
      </form>
      

      <table>
            @foreach($todo->todo_lists as $todo_list)
            @if($todo_list->status==false)
            <form action="/todo/{{$todo->id}}/todo_lists/{{$todo_list->id}}" method="post">
            @csrf
            @method('PUT')
            <tr>
              <th>小目標</th>
              <td>
                <input class="edit_input"type="text" value="{{$todo_list->list_name}}" name="list_name" />
              </td>
            </tr>
            <tr>
              <td><button type="submit"><span class="edit_button" >
                <strong>編集する</strong></span></button>
              </td>
            </tr>
        </form>
            @endif
            @endforeach
      </table>
      <a href="/todos"><p class="return">戻る</p></a>
    </div>
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