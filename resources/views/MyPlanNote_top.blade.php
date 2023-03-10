@extends('layouts.app')
@section('content')
<div class="container myplan_box">
<div class="introduction">
  <h1>ようこそ<strong>MyPlanNote</strong>へ</h1>
  <p><strong>MyPlanNote</strong> を使ってやることリストを作ってみましょう！<br>
  完了ボタンを押すと終わったタスクを可視化することができます</p>
</div>
</div>
<div class="button_group">
@auth
  <button class="login_button"><a href='/todos'><strong>ログイン</strong></a></button></br>
  <button class="register_button"><a href='/todos'><strong>新規登録</strong></a></button>
@endauth
@guest
  <button class="login_button"><a href='/login'><strong>ログイン</strong></a></button></br>
  <button class="register_button"><a href='/register'><strong>新規登録</strong></a></button>
@endguest
</div>
@endsection