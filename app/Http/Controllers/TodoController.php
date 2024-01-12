<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController
{
    public function all(Request $request)
    {
        return view('todos', [
            'todos' => Todo::query()
                ->when(
                    $request->input('finished'),
                    fn($query) => $request->boolean('finished')
                        ? $query->whereNotNull('finished_at')
                        : $query->whereNull('finished_at')
                )
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:300'],
        ]);

        Todo::create([
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function finished(Request $request, Todo $todo)
    {
        if ($todo->finished_at === null) {
            $todo->finished_at = now();
        } else {
            $todo->finished_at = null;
        }

        $todo->saveOrFail();

        if ($request->header('HX-Request')) {
            return view('single-todo', ['todo' => $todo]);
        }

        return redirect()->back();
    }

    public function delete(Request $request, Todo $todo)
    {
        $todo->deleteOrFail();

        if ($request->header('HX-Request')) {
            return response('', 200);
        }

        return redirect()->back();
    }
}
