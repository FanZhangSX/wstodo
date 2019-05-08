<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Todo::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = Todo::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'except_finish_time' => $request->except_finish_time,
            'is_completed' => 0,
        ]);

        return response()->json([
            'status' => (bool)$todo,
            'data' => $todo,
            'message' => $todo ? 'New Task created' : 'Error to create new Task'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return response()->json($todo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $status = $todo->update(
            $request->only(['user_id', 'name', 'description', 'except_finish_time', 'is_completed'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Task update' : 'Error to update task'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $status = $todo->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Task deleted' : 'Error to delete Task'
        ]);
    }
}
