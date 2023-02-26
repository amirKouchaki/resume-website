<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactPersonCollection;
use App\Http\Resources\MessageThreadResource;
use App\Models\ContactPerson;
use App\Models\MessageThread;
use http\Message;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class MessageThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['index']);
    }


    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index()
    {
        /*
         * TODO: It might be better to transfer this function to index function of ContactPersonController
         */


        $user = auth()->user();

        //basically admin
        $this->authorize('viewAny',$user);

        $contactPeople = [];
        if($user->isAdministrator)
            $contactPeople = ContactPerson::with('messageThread.replies')->get();
        else
            $contactPeople = $user->messageThreads()->with('replies')->get();


        return new ContactPersonCollection($contactPeople);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(MessageThread $messageThread)
    {
        $this->authorize('view',[auth()->user(),$messageThread]);


        return new MessageThreadResource($messageThread->load('replies.sender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MessageThread $messageThread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     * @throws \Throwable
     */
    public function destroy(MessageThread $messageThread)
    {
        $this->authorize('destroy',[auth()->user(),$messageThread]);

        $messageThread->deleteOrFail();

        return response(status: 202);
    }
}
