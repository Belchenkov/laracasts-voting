<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('idea.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return Application|Factory|View
     */
    public function show(Idea $idea)
    {
        $votesCount = $idea->votes()->count();
        $backUrl =  url()->previous() !== url()->full()
            ? url()->previous()
            : route('idea.index');

        return view('idea.show')
            ->with(compact('idea', 'votesCount', 'backUrl'));
    }
}
