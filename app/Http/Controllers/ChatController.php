<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /** Main chat page */
    public function index(Request $request)
    {
        $myId = auth()->id();
        $activeConvId = $request->integer('c');

        // Only show conversations that already have messages
        $conversations = Conversation::where(fn($q) => $q->where('user1_id', $myId)->orWhere('user2_id', $myId))
            ->whereHas('messages')
            ->with(['user1', 'user2', 'lastMessage'])
            ->orderByDesc('last_message_at')
            ->get();

        $active = null;
        if ($activeConvId) {
            // First look in already-loaded list
            $active = $conversations->firstWhere('id', $activeConvId);
            // If not there (newly created, no messages yet), load it directly
            if (!$active) {
                $active = Conversation::where('id', $activeConvId)
                    ->where(fn($q) => $q->where('user1_id', $myId)->orWhere('user2_id', $myId))
                    ->with(['user1', 'user2'])
                    ->first();
            }
        }
        if (!$active && $conversations->isNotEmpty()) {
            $active = $conversations->first();
        }

        return view('chat', compact('conversations', 'active'));
    }

    /** Find or create a conversation with $user, then redirect to chat */
    public function start(User $user)
    {
        $myId = auth()->id();

        if ($user->id === $myId) {
            return redirect()->route('chat');
        }

        // Ensure consistent ordering so unique constraint works
        $u1 = min($myId, $user->id);
        $u2 = max($myId, $user->id);

        $conv = Conversation::firstOrCreate(
            ['user1_id' => $u1, 'user2_id' => $u2],
            ['last_message_at' => now()]
        );

        return redirect()->route('chat', ['c' => $conv->id]);
    }

    /** AJAX: get messages (optionally only after a given message ID) */
    public function messages(Request $request, Conversation $conversation)
    {
        $myId = auth()->id();
        $this->authorizeConversation($conversation, $myId);

        $after = $request->integer('after', 0);

        $msgs = $conversation->messages()
            ->with('sender')
            ->when($after, fn($q) => $q->where('id', '>', $after))
            ->orderBy('id')
            ->get()
            ->map(fn($m) => [
                'id'          => $m->id,
                'body'        => $m->body,
                'is_mine'     => $m->sender_id === $myId,
                'sender_name' => $m->sender->nickname ?? $m->sender->name,
                'time'        => $m->created_at->format('H:i'),
            ]);

        // Mark incoming messages as read
        $conversation->messages()
            ->where('sender_id', '!=', $myId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json($msgs);
    }

    /** AJAX: send a message */
    public function send(Request $request, Conversation $conversation)
    {
        $myId = auth()->id();
        $this->authorizeConversation($conversation, $myId);

        $request->validate(['body' => 'required|string|max:2000']);

        $msg = $conversation->messages()->create([
            'sender_id' => $myId,
            'body'      => $request->body,
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json([
            'id'          => $msg->id,
            'body'        => $msg->body,
            'is_mine'     => true,
            'sender_name' => auth()->user()->nickname ?? auth()->user()->name,
            'time'        => $msg->created_at->format('H:i'),
        ]);
    }

    private function authorizeConversation(Conversation $conv, int $myId): void
    {
        if ($conv->user1_id !== $myId && $conv->user2_id !== $myId) {
            abort(403);
        }
    }
}
