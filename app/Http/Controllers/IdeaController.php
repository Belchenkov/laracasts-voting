<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::with('category', 'user', 'status')
            ->withCount('votes')
            ->orderBy('id', 'desc')
            ->simplePaginate(Idea::PAGINATION_COUNT);

        return view('idea.index')
            ->with(compact('ideas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        $votesCount = $idea->votes()->count();

        return view('idea.show')
            ->with(compact('idea', 'votesCount'));

    }
}
