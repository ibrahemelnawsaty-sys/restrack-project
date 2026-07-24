<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $messages = $query->latest()->paginate(20);

        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contact)
    {
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, ContactMessage $contact)
    {
        $request->validate(['reply' => ['required', 'string', 'max:5000']]);

        $contact->update([
            'status' => 'replied',
            'replied_by' => auth()->id(),
            'replied_at' => now(),
        ]);

        return back()->with('success', __('messages.reply_sent'));
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', __('messages.message_deleted'));
    }
}
