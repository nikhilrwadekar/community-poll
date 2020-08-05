<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use Validator;

class PollsController extends Controller
{
    // Send all polls
    public function index() {
        return response()->json(Poll::get(), 200);
    }

    // Send one poll with 'id'
    public function show($id) {
        $poll = Poll::find($id);
        if (is_null($poll)) {
            return response()->json(null, 404);
        }
        return response()->json(Poll::findOrFail($id), 200);
    }

    // Save a new poll
    public function store(Request $request) {
        $rules = ['title' => 'required|max:255',];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };

        $poll = Poll::create($request->all()); // Get all the data from the request

        return response()->json($poll, 201); // 201 - Created a new resource
    }

    // Update an existing poll
    public function update(Request $request, Poll $poll) {
        $poll->update($request->all());

        return response()->json($poll, 200); // 200 - OK Updated
    }

    // Delete an existing poll
    public function delete(Request $request, Poll $poll) {
        $poll->delete();
        
        return response()->json(null, 204); // 204 - NO content, Deleted!
    }
}
