<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $goals = Auth::user()->goals;

        return response()->json($goals);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goal = new Goal();
        $goal->title = request('title');
        $goal->user_id = Auth::id();
        $goal->save();

        $goals = Auth::user()->goals;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $goal->title = request('title');
        $goal->user_id = Auth::id();
        $goal->save();

        $goals = Auth::user()->goals;

        return response()->json($goals);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $goal->delete();

        $goals = Auth::user()->goals;

        return response()->json($goals);
    }
}
