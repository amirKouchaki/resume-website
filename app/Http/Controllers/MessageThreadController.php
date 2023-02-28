<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageThreadRequest;
use App\Http\Resources\ContactPersonCollection;
use App\Http\Resources\ContactPersonResource;
use App\Http\Resources\MessageThreadResource;
use App\Models\ContactPerson;
use App\Models\MessageThread;
use app\Models\User;
use http\Message;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class MessageThreadController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['index']);
        $this->authorizeResource(MessageThread::class,'messageThread');
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

        /**
         * @var User $user
         */
        $user = auth()->user();

        //basically admin

        $contactPeople = [];
        if($user->isAdministrator())
            $contactPeople = ContactPerson::with('messageThread.replies')->get();
        else
            $contactPeople = $user->contactPeople()->with('messageThreads.replies')->get();

        return ContactPersonResource::collection($contactPeople);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageThreadRequest $request)
    {
        $data = $request->validated();

        /*
         * TODO: might be better to use polymorphic relationship to choose between contact person and user instead of saving extra information
         */

        $user = auth()->user();

        if(!is_null($user)){
            $data = array_merge($data,[
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]);
        }


        /**
         * @var \app\Models\ContactPerson $contactPerson
         */

        $contactPerson = ContactPerson::create([
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'user_id' => $user?->id
        ]);

        $contactPerson->messageThread()->create([
            'title' => $data->title,
            'body' => $data->body
        ]);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(MessageThread $messageThread): MessageThreadResource
    {


        return new MessageThreadResource($messageThread->load('replies'));
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

        $messageThread->deleteOrFail();

        return response()->noContent();
    }
}
