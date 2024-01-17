<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseTrait;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Resources\V1\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    public function createNewChat(StoreMessageRequest $request)
    {
        // check if user
        $user = Auth('sanctum')->user();

        // validate unauthenticated visits
        if (!$user->id) {
            throw ValidationException::withMessages([
                'user' => 'Please, Sign in to send message.'
            ]);
        }

        // collect sender_id
        $request->merge(['sender_id'=> $user->id]);

        // collecting chat required data
        $chatData = [
            'starter_id' => $request->sender_id,
            'ads_title' => $request->ads_title,
        ];

        // check if previous chat with this ads
        $whereChat = [
            'starter_id' => $request->sender_id,
            'ads_title' => $request->ads_title,
        ];

        $chat = Chat::where($whereChat)
            ->first();

        if (!$chat) {
            $chat = Chat::create($chatData);
        }

        // merge chat_id to request
        $request->merge(['chat_id' => $chat->id]);

        // Save message
        Message::create($request->all());

        return $this->successResponse('Your message has been sent', 201);
    }

    public function replayMessage(Request $request)
    {

        // collect sender_id
        $user = Auth('sanctum')->user();

        $whereChat = [
            'starter_id' => $request->receiver_id,
            'ads_title' => $request->ads_title,
        ];

        // retrieve chat_id
        $chat = Chat::where($whereChat)
            ->first();

        // merging params to request
        $request->merge(['chat_id' => $chat->id]);
        $request->merge(['sender_id' => 2]);

        Message::create($request->all());

        return $this->successResponse('Your message has been sent', 201);
    }

    public function threads()
    {
        $user = auth('sanctum')->user();

        $whereMessage = [
            'receiver_id' => $user->id,
            'is_seen' => false,

        ];

        $chat_id = Chat::with(['message' => function($query) use($whereMessage) {
            $query->where($whereMessage)->get();
        }])
            ->get();

        return MessageResource::collection($chat_id);
    }

    public function showThread(Chat $chat)
    {
        // update message seen status
        $messageWhere = [
            'chat_id' => $chat->id,
            'is_seen' => false,
        ];

        $updates = [
            'is_seen' => true,
            'seen_at' => now(),
        ];

        Message::where($messageWhere)
            ->update($updates);

        return new MessageResource($chat);
    }
}
