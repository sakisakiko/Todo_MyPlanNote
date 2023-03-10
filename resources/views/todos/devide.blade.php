@extends('layouts.app')
@section('content')
    <div class="container devide_box">
      <div class="devide_header">
        <h1><strong>やることリストのふりわけ</strong></h1>
        <p>終わったら完了ボタンを押しましょう</p>
      </div>
      <div class="devide_contents">
        <div class="todo_box">
          <h2 class="devide_content_title"><strong>❗️やること❗️</strong></h2>
          <table>
            <thead>
              <tr>
                <th>プラン名</th>
                <th>予定日</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            @foreach ($todos as $todo)
             @if($todo->status==false)
            <tr>
              <td>{{$todo->title}}</td>
              <td>{{$todo->due_date}}</td>
              <td>
                <form action="/todos/{{$todo->id}}" method=post>
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="{{$todo->status}}">
                  <div class=green_button><button type="submit"><strong>完了</strong></button></div>
                </form>
              </td>
              <td><div class=blue_button><a href="/todos/{{ $todo->id }}/edit"><button><strong>編集</strong></button></a></div></td>
            </tr>
            @endif
          @endforeach
          </table>
        </div><!--todo_box-->
  
        <div class="done_box">
          <h2 class="devide_content_title"><strong>⭐️終わったこと⭐️</strong></h2>
          <table>
            <thead>
              <tr>
                <th>プラン名</th>
                <th>完了日</th>
                <th></th>
              </tr>
            </thead>
            @foreach ($dones as $done)
            @if($done->status==true)
            <tr>
              <td>{{$done->title}}</td>
              <td>{{$done->updated_at->format('Y-m-d')}}</td>
              <td>
                <form onsubmit="return deleteTodo();"
                action="/todos/{{ $done->id }}" method="post">
                @csrf
                @method('DELETE')
                <div class="red_button"><button><strong type=submit>削除する</strong></button></div>
                </form>
              </td>
            </tr>
            @endif
            @endforeach
          </table>
        </div><!--done_box-->
      </div><!--devide_contents-->
    </div><!--devide_box-->
    
    <!-- flatpickrスクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <!-- 日本語化のための追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <script>
      function deleteTodo() {
        if (confirm('本当に削除しますか？')) {
          return true;
        } else {
          return false;
      }
      }
    </script>
@endsection











 