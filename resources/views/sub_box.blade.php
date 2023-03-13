<h2 ><strong>プランを入力しよう！</strong></h2>

<!--エラーメッセージ-->
<div class="error_box">
@foreach ($errors->all() as $error)
<li class="error_message">{{$error}}</li>
@endforeach
</div>
<!--エラーメッセージ-->

<!--新規作成フォーム-->
<div class="create_box">
  <form action="/todos" method="post">
  @csrf
    <table>
      <tr>
        <td><span><strong>プラン</strong></span></td>
        <td><input type="text" placeholder="プランを入力" name="title" /></td>
      </tr>
      <tr>
        <td><span><strong>予定日</strong></span></td>
        <td><input type="text" name="due_date" id="due_date" value="{{ old('due_date') }}" /></td>
      </tr>
      <tr>
        <td><span><strong>カテゴリ</strong></span></td>
        <td>
        {{Form::select('category_id',$categories->prepend('選択してください', ''),['id'=>'category_name'])}}
        
        </td>
      </tr>
    </table>
  <button type="submit"><strong>作成する</strong></button>
  </form>
</div>
<!--新規作成フォームここまで-->

<!--絞り込み-->
<div class="search">
  <h2><strong>カテゴリ絞り込み</strong></h2>
  <div class="category_search_box">
    <form  action="/todos/category" method="get">
    @csrf
    {{Form::select('category_id',$categories->prepend('選択してください', ''),['id'=>'category_name'])}}
    <button type="submit"><strong>検索</strong></button>
    </form>
  </div>
</div>
<!--絞り込みここまで-->
      