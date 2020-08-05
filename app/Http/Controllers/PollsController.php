<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;

class PollsController extends Controller
{
    // Send all polls
    public function index() {
        return response()->json(Poll::get(), 200);
    }

    // Send one poll with 'id'
    public function show($id) {
        return response()->json(Poll::find($id), 200);
    }
}
