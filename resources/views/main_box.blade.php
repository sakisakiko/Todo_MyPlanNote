　　<table class="table-auto">
          <thead>
          <tr>
            <th></th>
            <th>プラン名</th>
            <th>予定日</th>
            <th>カテゴリ</th>
            <th>状態</th>
            <th></th>
            <th></th>
            </tr>
          </thead>
          <!--繰り返し-->
          @foreach ($todos as $todo)
          <tbody>
            <tr>
              <td>
                @if($now > $todo->due_date)
                ❗️
                @endif
              </td>
              <td>
                <a href="/todos/{{ $todo->id }}">
                 {{ $todo->title }}
                </a>
              </td>
              <td>{{ $todo->due_date }}</td>
              <td>{{$todo->category->category_name}}</td>
              <td>
                @if($todo->status==false)
                <p class="status_false">未完了</p>
                @else
                <p class="status_true">完了</p>
                @endif
              </td>
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