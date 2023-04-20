<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageThreadRequest;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Resources\ContactPersonResource;
use App\Http\Resources\MessageThreadResource;
use App\Http\Resources\ReplyResource;
use App\Models\ContactPerson;
use App\Models\MessageThread;
use app\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class MessageThreadController extends Controller
{


    public function __construct()
    {
//        $this->authorizeResource(MessageThread::class,'messageThread');
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
//        auth()->login(User::find(1));
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
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
            ]);
        }


        /**
         * @var \app\Models\ContactPerson $contactPerson
         */

        $contactPerson = ContactPerson::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'user_id' => $user?->id
        ]);

        $contactPerson->messageThread()->create([
            'title' => $data['title'],
            'body' => $data['body']
        ]);

        return new ContactPersonResource($contactPerson->load('messageThread'));
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(MessageThread $messageThread): MessageThreadResource
    {


        return new MessageThreadResource($messageThread->load('replies.replyable'));
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


    public function reply(StoreReplyRequest $request,MessageThread $messageThread) {
        $this->authorize('reply',$messageThread);
        $data = $request->validated();
        $user = auth()->user();
        $messageThread = $messageThread->load('contactPerson');


        /**
         * 1. guest
         * 2. authenticated and normal user
         * 3, authenticated and admin
         */
        if(is_null($user) || !$user->is_admin){
         $data['replyable_id'] = $messageThread->contactPerson->id;
         $data['replyable_type'] = get_class($messageThread->contactPerson);
        }
        else{
            $data['replyable_id'] = $user->id;
            $data['replyable_type'] = get_class($user->contactPerson);
        }



        $reply = $messageThread->replies()->create([
            'title' => $data['title'],
            'body' => $data['body'],
            'replyable_id' => $data['replyable_id'],
            'replyable_type' => $data['replyable_type']
        ]);

        return new ReplyResource($reply);
    }
}
