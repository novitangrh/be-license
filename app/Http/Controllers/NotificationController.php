<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();

        return response()->json([
            'status' => 'success',
            'data' => NotificationResource::collection($notifications),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Notification $notification)
    {
        return response()->json([
            'status' => 'success',
            'data' => new NotificationResource($notification),
        ], 200);
    }

    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $validated = $request->validated();
        $notification->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Notification updated successfully',
            'data' => new NotificationResource($notification),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
