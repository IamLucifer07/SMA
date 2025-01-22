<?php

namespace App\Http\Controllers;

use App\Models\TwitterData;
use App\Models\FacebookData;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SocialMediaController extends Controller
{
    /**
     * Display the dashboard with all social media data
     */
    public function index()
    {
        // $twitterData = TwitterData::all();
        $facebookData = FacebookData::all();

        return view('dashboard', compact('facebookData'));
    }


    /**
     * Get Facebook engagement data for a specific user
     */
    public function getFacebookEngagement(Request $request, $userId)
    {
        $timeRange = $request->query('timeRange', 'week');
        $startDate = $this->getStartDate($timeRange);

        try {
            $data = FacebookData::where('user_id', $userId)
                ->where('created_at', '>=', $startDate)
                ->orderBy('created_at')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch Facebook engagement data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Helper method to calculate start date based on time range
     */
    private function getStartDate($timeRange)
    {
        $now = Carbon::now();

        return match ($timeRange) {
            'week' => $now->subWeek(),
            'month' => $now->subMonth(),
            'year' => $now->subYear(),
            default => $now->subWeek(),
        };
    }
}
