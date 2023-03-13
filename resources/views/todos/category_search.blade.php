@extends('layouts.app')
@section('content')

<div class="container index_box">
  <div class="sub_box">@include('sub_box')</div><!--新規作成、絞り込みフォーム-->
  <div class="main_box">
  <h1><strong>マイプランリスト</strong></h1>
  <p>{{ $todos->count() }}件見つかりました。</p>
      @include('main_box')
  </div><!--main_box-->
</div><!--main-->


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