<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo List</title>
</head>
<style>
  body {
    background-color: #351482;
  }

  .card {
    background-color: #fff;
    width: 600px;
    margin: 100px auto 0;
    padding: 0 20px;
    border-radius: 8px;
    overflow: hidden;
  }

  .todo {
    display: inline-block;
  }

  .header {
    width: 100%;
  }

  .title {
    font-style: normal;
    font-size: 30px;
    font-weight: bold;
    display: inline-block;
    width: 28%;
  }

  .login {
    display: inline-block;
    width: 70%;
    text-align: right;
  }

  .login_name {
    display: inline-block;
    width: 40%;
    text-align: right;
  }

  .logout {
    display: inline-block;
    width: 40%;
  }

  button.logout {
    border-style: solid;
    padding: 8px 20px;
    background: none;
    color: #ff0000;
    border-radius: 5px;
    border-color: #ff0000;
  }

  button.logout:hover {
    background-color: #ff0000;
    color: #fff;
  }

  input.todo_create {
    width: 450px;
    height: 30px;
    border-style: solid;
    border-width: 1px;
    border-radius: 5px;
  }

  button.create {
    margin-left: 50px;
    border-style: solid;
    padding: 8px 20px;
    background: none;
    color: #ff00ff;
    border-radius: 5px;
    border-color: #ff00ff;
  }

  button.create:hover {
    background-color: #ff00ff;
    color: #fff;
  }

  table {
    width: 600px;
    margin: 30px 0;
  }

  input.todo_update {
    width: 300px;
    height: 30px;
    border-style: solid;
    border-width: 1px;
    border-radius: 5px;
  }

  button.update {
    border-style: solid;
    padding: 8px 20px;
    background: none;
    color: #ffbf1c;
    border-radius: 5px;
    border-color: #ffbf1c;
  }

  button.update:hover {
    background-color: #ffbf1c;
    color: #fff;
  }

  button.delete {
    border-style: solid;
    padding: 8px 20px;
    background: none;
    color: #1cffbb;
    border-radius: 5px;
    border-color: #1cffbb;
  }

  button.delete:hover {
    background-color: #1cffbb;
    color: #fff;
  }

  .error_massege {
    background-color: #ff0000;
    color: #fff;
  }
</style>

<body>
  @if (count($errors) > 0)
  <ul>
    @foreach ($errors->all() as $error)
    <li class="error_massege">{{$error}}</li>
    @endforeach
  </ul>
  @endif

  <div class="card">
    <div class="todo">

      <div class="header">
        <p class="title">Todo List</p>
        <div class="login">
          <div class="login_name">
            @if (Auth::check())
            <p>「{{$user->name}}」でログイン中</p>
            @else
            <p>
              ログインしてください（<a href="/login">ログイン</a>｜<a href="/register">登録</a>）
            </p>
            @endif
          </div>
          <div class="logout">
            <form action="/login" method="post">
              <button class="logout" type="submit">ログアウト</button>
            </form>
          </div>
        </div>
      </div>

      <form action="/create" method="post">
        @csrf
        <input name="contents" type="text" class="todo_create">
        <button class="create">追加</button>
      </form>
    </div>

    <table>
      <tr>
        <th>作成日</th>
        <th>タスク名</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      @foreach($todos as $todo)
      <tr>
        <td>{{$todo->created_at}}</td>
        <form action="{{ route('todo.update', ['id' => $todo->id]) }}" method="post">
          @csrf
          <td>
            <input name="contents" type="text" value="{{ $todo->contents }}">
          </td>
          <td>
            <button class="update" type="submit">更新</button>
        </form>
        </form>
        </td>
        <td>
          <form action="{{ route('todo.delete', ['id' => $todo->id]) }}" method="post">
            @csrf
            <button class="delete" type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</body>

</html>