<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
use App\Models\Goal;
use App\Models\User;
use App\Http\Controllers\HomeController;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    /**
     * @param Request $request
     * @param Goal $goal
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Goal $goal): \Illuminate\Http\JsonResponse
    {
        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        return response()->json($todos);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    /**
     * @param Request $request
     * @param Goal $goal
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Goal $goal): \Illuminate\Http\JsonResponse
    {
        $todo = new Todo();
        $todo->content = request('content');
        $todo->user_id = Auth::id();
        $todo->goal_id = $goal->id;
        $todo->position = request('position');
        $todo->done = false;
        $todo->save();
        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        return response()->json($todos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Todo $todo
     */
    /**
     * @param Request $request
     * @param Goal $goal
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Goal $goal, Todo $todo): \Illuminate\Http\JsonResponse
    {
        $todo->content = request('content');
        $todo->user_id = Auth::id();
        $todo->goal_id = $goal->id;
        $todo->position = request('position');
        $todo->done = (bool) request('done');
        $todo->save();

        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        return response()->json($todos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todo $todo
     */
    /**
     * @param Request $request
     * @param Goal $goal
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy(Request $request, Goal $goal,Todo $todo): \Illuminate\Http\JsonResponse
    {
        $todo->delete();
        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        return response()->json($todos);
    }

    /**
     * @param Todo $todo
     * @param Request $request
     * @param Goal $goal
     * @param User $user
     * @param \App\Http\Controllers\HomeController $homeController
     * @return string
     */
    }

public function sort(Request $request, Goal $goal, Todo $todo): \Illuminate\Http\JsonResponse
{
    $exchangeTodo = Todo::where('position', request('sortId'))->first();
    $lastTodo = Todo::where('position', request('sortId'))->latest('position')->first();

    if (request('sortId') == 0) {
        $todo->moveBefore($exchangeTodo);
    } else if (request('sortId') - 1 == $lastTodo->position) {
        $todo->moveAfter($exchangeTodo);
    } else {
        $todo->moveAfter($exchangeTodo);
    }

    $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();

    return response()->json($todos);
}


