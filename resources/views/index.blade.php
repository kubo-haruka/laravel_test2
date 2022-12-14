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
    width: 71%;
    text-align: right;
  }

  .login_name {
    padding-right: 20px;
    display: inline-block;
    width: 48%;
    text-align: right;
  }

  .logout {
    padding-left: -20px;
    display: inline-block;
    width: 28%;
  }

  button.logout_btn {
    width: 100%;
    border-style: solid;
    padding: 8px 20px;
    background: none;
    color: #ff0000;
    border-radius: 5px;
    border-color: #ff0000;
  }

  button.logout_btn:hover {
    background-color: #ff0000;
    color: #fff;
  }

  button.search_btn {
    border-style: solid;
    padding: 8px 20px;
    background: none;
    color: #b0f229;
    border-radius: 5px;
    border-color: #b0f229;
  }

  button.search_btn:hover {
    background-color: #b0f229;
    color: #fff;
  }

  input.todo_create {
    width: 400px;
    height: 30px;
    border-style: solid;
    border-width: 1px;
    border-radius: 5px;
  }

  .form-control {
    width: 60px;
    height: 35px;
    border-style: solid;
    border-width: 1px;
    border-radius: 5px;
  }

  button.create {
    margin-left: 10px;
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
            <p>???{{$user->name}}?????????????????????</p>
            @else
            <p>
              ?????????????????????????????????<a href="/login">????????????</a>???<a href="/register">??????</a>???
            </p>
            @endif
          </div>
          <div class="logout">
            <form action="/login" method="post">
              @csrf
              <button class="logout_btn">???????????????</button>
            </form>
          </div>
        </div>
      </div>

      <form action="/search" method="post">
        @csrf
        <button class="search_btn">???????????????</button>
      </form>

      <form action="/create" method="post">
        @csrf
        <input name="contents" type="text" class="todo_create">
        <select class="form-control" id="tag-id" name="tag_id">
          @foreach (Config::get('tag.tag_name') as $key => $val)
          <option value="{{ $key }}">{{ $val }}</option>
          @endforeach
        </select>
        <button class="create">??????</button>
      </form>
    </div>

    <table>
      <tr>
        <th>?????????</th>
        <th>????????????</th>
        <th>??????</th>
        <th>??????</th>
        <th>??????</th>
      </tr>
      @foreach($todos as $todo)
      <tr>
        <td>{{$todo->created_at}}</td>
        <form action="{{ route('todo.update', ['id' => $todos>id]) }}" method="post">
          @csrf
          <td>
            <input name="contents" type="text" value="{{ $todo->contents ,$users_id->id}}">
          </td>
          <td>
            <select class="form-control" id="tag-id" name="tag_id">
              @foreach (Config::get('tag.tag_name') as $key => $val)
              <option value="{{ $key }}">{{ $val }}</option>
              @endforeach
            </select>
          </td>
          <td>
            <button class="update" type="submit">??????</button>
        </form>
        </form>
        </td>
        <td>
          <form action="{{ route('todo.delete', ['id' => $todo->id]) }}" method="post">
            @csrf
            <button class="delete" type="submit">??????</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</body>

</html>