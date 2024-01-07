<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index()
    {
        return Inertia::render('Todos', [
            'todos' => Todo::orderByDesc('created_at')
                ->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => ['required', 'max:2048'],
            'is_completed' => ['boolean'],
        ]);

        Todo::create($data);

        return redirect()->back();
    }

    public function show(Todo $todo)
    {
        return $todo;
    }

    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'text' => ['max:2048']
        ]);

        $todo->update($data);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->back();
    }
}
