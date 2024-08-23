<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return response()->json([
            'status' => 'success',
            'data' => ContactResource::collection($contacts),
        ], 200);
    }

    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        $contact = Contact::query()->create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Contact created successfully',
            'data' => new ContactResource($contact),
        ], 201);
    }

    public function show(Contact $contact)
    {
        return response()->json([
            'status' => 'success',
            'data' => new ContactResource($contact),
        ], 200);
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $validated = $request->validated();
        $contact->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Contact updated successfully',
            'data' => new ContactResource($contact),
        ], 200);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Contact deleted successfully',
        ], 200);
    }
}
