<?php

namespace App\Http\Controllers;

use App\Http\Requests\Licence\StoreLicenceRequest;
use App\Http\Requests\Licence\UpdateLicenceRequest;
use App\Http\Resources\LicenceResource;
use App\Models\Licence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LicenceController extends Controller
{
    public function index()
    {
        $licences = Licence::all();

        $totalLicences = $licences->count();
        $totalExpiringLicences = 0;
        $today = Carbon::today();

        foreach ($licences as $licence) {
            $endDate = Carbon::parse($licence->end_date);

            foreach ($licence->notification->notification_days as $days) {
                $notificationDate = $endDate->copy()->subDays($days);

                if ($today->gte($notificationDate) && $today->lte($endDate)) {
                    $totalExpiringLicences++;
                    break;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => LicenceResource::collection($licences),
            'total_licences' => $totalLicences,
            'total_expiring_licences' => $totalExpiringLicences,
        ], 200);
    }

    public function store(StoreLicenceRequest $request)
    {
        $validated = $request->validated();
        $licence = Licence::query()->create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Licence created successfully',
            'data' => new LicenceResource($licence),
        ], 201);
    }

    public function show(Licence $licence)
    {
        return response()->json([
            'status' => 'success',
            'data' => new LicenceResource($licence),
        ], 200);
    }

    public function update(UpdateLicenceRequest $request, Licence $licence)
    {
        $validated = $request->validated();
        $licence->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Licence updated successfully',
            'data' => new LicenceResource($licence),
        ], 200);
    }

    public function destroy(Licence $licence)
    {
        $licence->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Licence deleted successfully',
        ], 200);
    }
}
