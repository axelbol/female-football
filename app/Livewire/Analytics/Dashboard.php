<?php

namespace App\Livewire\Analytics;

use App\Models\Analytics;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $period = '7'; // days
    public $dateRange;

    public function mount()
    {
        $this->dateRange = $this->getDateRange();
    }

    public function updatedPeriod()
    {
        $this->dateRange = $this->getDateRange();
    }

    public function getAnalyticsProperty()
    {
        $startDate = $this->dateRange['start'];
        $endDate = $this->dateRange['end'];

        return [
            'totalViews' => Analytics::where('event_type', 'page_view')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),

            'uniqueVisitors' => Analytics::where('event_type', 'page_view')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->distinct('session_id')
                ->count('session_id'),

            'topPosts' => Analytics::select('post_id', DB::raw('COUNT(*) as views'))
                ->where('event_type', 'page_view')
                ->whereNotNull('post_id')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('post_id')
                ->orderByDesc('views')
                ->limit(10)
                ->with('post')
                ->get(),

            'dailyViews' => Analytics::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(*) as views'),
                    DB::raw('COUNT(DISTINCT session_id) as unique_visitors')
                )
                ->where('event_type', 'page_view')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get(),

            'topReferrers' => Analytics::select('referrer', DB::raw('COUNT(*) as visits'))
                ->where('event_type', 'page_view')
                ->whereNotNull('referrer')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('referrer')
                ->orderByDesc('visits')
                ->limit(10)
                ->get(),

            'deviceStats' => $this->getDeviceStats($startDate, $endDate),
        ];
    }

    private function getDateRange(): array
    {
        $endDate = Carbon::now();
        $startDate = match ($this->period) {
            '1' => $endDate->copy()->subDay(),
            '7' => $endDate->copy()->subDays(7),
            '30' => $endDate->copy()->subDays(30),
            '90' => $endDate->copy()->subDays(90),
            default => $endDate->copy()->subDays(7),
        };

        return [
            'start' => $startDate,
            'end' => $endDate,
        ];
    }

    private function getDeviceStats($startDate, $endDate): array
    {
        $userAgents = Analytics::select('user_agent', DB::raw('COUNT(*) as visits'))
            ->where('event_type', 'page_view')
            ->whereNotNull('user_agent')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('user_agent')
            ->orderByDesc('visits')
            ->get();

        $deviceTypes = [
            'mobile' => 0,
            'desktop' => 0,
            'tablet' => 0,
        ];

        foreach ($userAgents as $userAgent) {
            $agent = strtolower($userAgent->user_agent);
            if (str_contains($agent, 'mobile') || str_contains($agent, 'iphone') || str_contains($agent, 'android')) {
                $deviceTypes['mobile'] += $userAgent->visits;
            } elseif (str_contains($agent, 'tablet') || str_contains($agent, 'ipad')) {
                $deviceTypes['tablet'] += $userAgent->visits;
            } else {
                $deviceTypes['desktop'] += $userAgent->visits;
            }
        }

        return $deviceTypes;
    }

    public function render()
    {
        $analytics = $this->analytics;

        return view('livewire.analytics.dashboard', compact('analytics'));
    }
}
