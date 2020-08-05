<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use Validator;
use App\Http\Resources\Poll as PollResource;

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

        $response = new PollResource(Poll::findOrFail($id), 200);
        return response()->json($response, 200);
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

    // Error Handler
    public function errors() {
        return response()->json(['msg' => 'Payment is required.'], 501); // 501 - Server does not know how to process the request.
    }

    // Get Questions for the Poll (Subresources)
    public function questions(Request $request, Poll $poll) {
        $questions = $poll->questions;

        return response()->json($questions, 200);
    }

}
