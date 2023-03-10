<!--content.blade.php-->
@extends('layouts.app')
@section('content')
<div class="container index_box">
  <div class="sub_box">
    <h2 ><strong>プランを入力しよう！</strong></h2>

      <!--エラーメッセージ-->
      <div class="error_box">
        @foreach ($errors->all() as $error)
         <li class="error_message">{{$error}}</li>
        @endforeach
      </div>
      <!--エラーメッセージ-->

      <form action="/todos" method="post">
       @csrf
        <table>
          <tr>
            <td><span><strong>プラン</strong></span></td>
            <td><input type="text" placeholder="プランを入力" name="title" /></td>
          </tr>
        </table>
        <table>
          <tr>
            <td><span><strong>予定日</strong></span></td>
            <td><input type="text" name="due_date" id="due_date" value="{{ old('due_date') }}" /></td>
          </tr>
        </table>
        <table>
          <td><span><strong>カテゴリ</strong></span></td>
          <td>
            {{Form::select('category', ['---' => '---','仕事' => '仕事', '家事' => '家事','学習' => '学習', '趣味' => '趣味','旅行' => '旅行', 'その他' => 'その他'])}}
          </td>
        </table>
        <button type="submit"><strong>作成する</strong></button>
      </form>
      </div><!--side_box-->  
 
      <div class="main_box">
        <h1><strong>マイプランリスト</strong></h1>

        <!--※キーワード検索※-->
        <!--<div>-->
        <!--  <form action="todos" method="GET">-->
        <!--    <input type="text" name="keyword" value="">-->
        <!--   <button> <input type="submit" value="検索"></button>-->
        <!--  </form>-->
        <!--</div>-->
        <!--※キーワード検索※-->

        <table class="table-auto">
          <thead>
          <tr>
            <th>プラン名</th>
            <th>予定日</th>
            <th>カテゴリ</th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
          </thead>
          <!--繰り返し-->
          @foreach ($todos as $todo)
          <tbody>
            <tr>
              <td>
                <a href="/todos/{{ $todo->id }}">
                 {{ $todo->title }}
                </a>
              </td>
              @if(date('Y-m-d')<$todo->due_date)
              <td>
              期限切
              </td>
              @endif
              <td>{{ $todo->due_date }}</td>
              <td>{{ $todo->category}}</td>
              <td>
                <div>
                <!--詳細画面に遷移-->
                  <a href="/todos/{{ $todo->id }}"><button class="green_button"><span><strong>詳細</strong></span></button></a>
                </div>
              </td>
              <td>
                <form onsubmit="return deleteTodo();"
                  action="/todos/{{ $todo->id }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="red_button"><span><strong>削除</strong></span></button>
                </form>
              </td>
            </tr>
          </tbody>
          @endforeach
          <!--繰り返し-->
        </table>
      </div><!--main_box-->
    </div><!--main-->
  <footer>
</footer>

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
    
    flatpickr(document.getElementById('due_date'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date()
    });
  </script>
@endsection