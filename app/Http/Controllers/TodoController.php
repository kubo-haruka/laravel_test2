<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Cache\TagSet;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $tags = Tag::all();
        $users = User::all();
        $index = ['todos' => $todos, 'users' => $users, 'tags' => $tags];
        return view('index', ['todos' => $todos, 'users' => $users, 'tags' => $tags]);
    }

    public function create(TodoRequest $request)
    {
        $contents = $request->all();
        Todo::create($contents);
        return redirect('/index');
    }

    public function update(TodoRequest $request)
    {
        $contents = $request->all();
        unset($contents['_token']);
        Todo::find($request->id)->update($contents);
        return redirect('/index');
    }

    public function delete($id)
    {
        $contents = Todo::find($id);
        unset($contents['_token']);
        $contents->delete();
        return redirect('/index');
    }

    public function check(Request $request)
    {
        $text = ['text' => 'ログインして下さい。'];
        return view('auth', $text);
    }

    public function checkUser(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Todo::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $text =   Auth::user()->name . 'さんがログインしました';
        } else {
            $text = 'ログインに失敗しました';
        }
        return view('auth', ['text' => $text]);
    }
}
