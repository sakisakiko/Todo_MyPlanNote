@extends('layouts.app')
  @section('content')
  <div class="container myplan_box">
    
    <div class="introduction">
      <h1>ようこそ<strong>MyPlanNote</strong>へ</h1>
      <p><strong>MyPlanNote</strong> を使ってやることリストを作ってみましょう！<br>
      完了ボタンを押すと終わったタスクを可視化することができます</p>
    </div>

    <div class="top_contents">
    @auth
      <div class="button_group">
        <button class="about_button"><a href='/todos_about'><strong>アバウト</strong></a></button>
      </div>
      <img src="/img/top_image.jpg" width="400" height="200">
    @endauth
    @guest
      <div class="button_group">
        <button class="login_button"><a href='/login'><strong>ログイン</strong></a></button></br>
        <button class="register_button"><a href='/register'><strong>新規登録</strong></a></button>
      </div>
      <div class="button_group">
      　<button class="about_button"><a href='/todos_about'><strong>アバウト</strong></a></button>
      </div>
      <img src="/img/top_image.jpg" width="400" height="200">
    @endguest
    </div>
    
  </div>
@endsection