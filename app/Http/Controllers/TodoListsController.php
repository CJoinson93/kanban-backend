<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Resources\TodoListResource;

class TodoListsController extends Controller
{
    public function all()
    {
        $todoLists = TodoList::orderBy('list_order')
            ->get();
            return TodoListResource::collection($todoLists);
    }

    public function get(TodoList $todoList)
    {
        return $todoList;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        $count = TodoList::count();

        $todoList = new TodoList;
        $todoList->title = $request->input('title');
        $todoList->list_order = $count + 1;
        $todoList->save();

        return new TodoListResource($todoList);
    }

    public function update (Request $request, TodoList $todoList)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        $todoList->title = $request->input('title');
        if ($request->has('list_order')){
            $todoList->list_order = $request->input('list_order');
        }

        $todoList->save();

        return new TodoListResource($todoList);
    }

    public function delete(TodoList $todoList)
    {
        $todoList->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
