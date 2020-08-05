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

    // Save a new poll
    public function store(Request $request) {
        $poll = Poll::create($request->all()); // Get all the data from the request

        return response()->json($poll, 201); // 201 - Created a new resource
    }

    // Update an existing poll
    public function update(Request $request, Poll $poll) {
        $poll->update($request->all());

        return response()->json($poll, 200); // 200 - OK Updated
    }
}
