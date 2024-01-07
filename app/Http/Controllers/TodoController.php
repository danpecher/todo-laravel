<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => ['required'],
            'is_completed' => ['boolean'],
        ]);

        return Todo::create($data);
    }

    public function show(Todo $todo)
    {
        return $todo;
    }

    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'text' => ['required'],
            'is_completed' => ['boolean'],
        ]);

        $todo->update($data);

        return $todo;
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json();
    }
}
