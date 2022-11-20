<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function list()
    {
        $tododb = Todo::all();
        return view('index', ['todos' => $tododb]);
    }

    public function create(TodoRequest $request)
    {
        $contents = $request->all();
        Todo::create($contents);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $contents = $request->all();
        unset($contents['_token']);
        Todo::find($request->id)->update($contents);
        return redirect('/');
    }

    public function delete($id)
    {
        $contents = Todo::find($id);
        unset($contents['_token']);
        $contents->delete();
        return redirect('/');
    }
}
