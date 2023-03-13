@extends('layouts.app')
@section('content')
  <div class="container show_box">
    
    <div class="show_header">
      <div class="show_header_contents">
        <h1><strong>{{$todo->title}}</strong></h1>
        <p class="due_date"><strong>予定日:{{$todo->due_date}}</strong></p>
        @if($todo->status==false)
          <a href="/todos/{{ $todo->id }}/edit"><button class="green_button"><span><strong>編集</strong></span></button></a>
          <form onsubmit="return UpdateStatus();" 
          action="/todos/{{$todo->id}}" method="post">
          @csrf
          @method('PUT')
            <input type="hidden" name="status" value="{{$todo->status}}">
            <div class="complete_button"><button type="submit"><span><strong>✨プラン達成‼️✨</strong></span></button></div>
          </form>
        @else
          <p class="complete"><strong>🌸 完了済み 🌸</strong></p>
        @endif
      </div>
    </div>
      
    <div class="show_sub_header">
      <p>やることを入力しよう！</p>
      <form action="/todo/{{$todo->id}}/todo_lists" method="post">
      @csrf
        <input type="text" placeholder="小目標を入力" name="list_name" />
        <input value="{{$todo->id}}" type="hidden" name="todo_id"/>
        <button type="submit"><strong class="list_btn">＋</strong></button>
      </form>
    </div> 
      
    <!--エラーメッセージ-->
    <div class="error_box">
    @foreach ($errors->all() as $error)
      <li class="error_message">{{$error}}</li>
    @endforeach
    </div>
    <!--エラーメッセージ-->
      
    <div class="show_contents">
      <!--やること-->
      <div class="todo_box">
        <h2 class="show_content_title"><strong>❗️やること❗️</strong></h2>
        <table>
          <thead>
            <tr>
              <th>やること</th>
              <th></th>
            </tr>
          </thead>
          @foreach($todo->todo_lists as $todo_list)
            @if($todo_list->status==false)
            <tr>
              <td>{{$todo_list->list_name}}</td>
              <td>
                <form action="/todo/{{$todo->id}}/todo_lists/{{$todo_list->id}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="{{$todo_list->status}}">
                  <div class=green_button><button type="submit"><strong>完了</strong></button></div>
                </form>
              </td>
            </tr>
            @endif
          @endforeach
        </table>
      </div>
      <!--やることここまで-->
      
      <!--終わったこと-->
        <div class="done_box">
          <h2 class="show_content_title"><strong>⭐️終わったこと⭐️</strong></h2>
          <table>
            <thead>
              <tr>
                <th>終わったこと</th>
                <th>完了日</th>
                <th></th>
              </tr>
            </thead>
            @foreach($todo->todo_lists as $todo_list)
            @if($todo_list->status==true)
            <tr>
              <td>{{$todo_list->list_name}}</td>
              <td>{{$todo_list->updated_at->format('Y-m-d')}}</td>
              <td>
                <form onsubmit="return deleteTodoList();"
                 action="/todo/{{$todo->id}}/todo_lists/{{$todo_list->id}}" method=post>
                @csrf
                @method('DELETE')
                <div class="red_button"><button><strong type=submit>削除する</strong></button></div>
                </form>
              </td>
            </tr>
            @endif
            @endforeach
          </table>
        </div>
        <!--終わったことここまで-->
      </div>
      <a href="/todos"><p class="return">戻る</p></a>
    </div><!--devide_box-->
    
    <!-- flatpickrスクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <!-- 日本語化のための追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>

    <script>
      function UpdateStatus() {
        if (confirm('やることリストはすべて完了しましたか？')) {
            return true;
        } else {
            return false;
        }
    }
    </script>
@endsection
