<?php

namespace App\Services;

use App\Models\Analytics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnalyticsService
{
    public function trackPageView(Request $request, ?int $postId = null): void
    {
        // Start session if not already started
        if (!session()->isStarted()) {
            session()->start();
        }

        $sessionId = session()->getId();

        // Generate a unique session ID if none exists
        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
            session()->setId($sessionId);
            session()->start();
        }

        try {
            Analytics::create([
                'event_type' => 'page_view',
                'post_id' => $postId,
                'session_id' => $sessionId,
                'ip_address' => $this->getClientIp($request),
                'user_agent' => $request->userAgent(),
                'referrer' => $request->header('referer'),
                'url' => $request->fullUrl(),
                'user_id' => auth()->id(),
            ]);
        } catch (\Exception $e) {
            report($e);
        }
    }

    public function trackEvent(string $eventType, Request $request, array $data = []): void
    {
        if (!session()->isStarted()) {
            session()->start();
        }

        $sessionId = session()->getId() ?: Str::uuid()->toString();

        try {
            Analytics::create(array_merge([
                'event_type' => $eventType,
                'session_id' => $sessionId,
                'ip_address' => $this->getClientIp($request),
                'user_agent' => $request->userAgent(),
                'referrer' => $request->header('referer'),
                'url' => $request->fullUrl(),
                'user_id' => auth()->id(),
            ], $data));
        } catch (\Exception $e) {
            report($e);
        }
    }

    private function getClientIp(Request $request): string
    {
        // Check for various proxy headers
        $ipKeys = [
            'HTTP_CF_CONNECTING_IP',     // Cloudflare
            'HTTP_CLIENT_IP',            // Proxy
            'HTTP_X_FORWARDED_FOR',      // Load Balancer/Proxy
            'HTTP_X_FORWARDED',          // Proxy
            'HTTP_X_CLUSTER_CLIENT_IP',  // Cluster
            'HTTP_FORWARDED_FOR',        // Proxy
            'HTTP_FORWARDED',            // Proxy
            'REMOTE_ADDR'                // Standard
        ];

        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) && !empty($_SERVER[$key])) {
                $ips = explode(',', $_SERVER[$key]);
                $ip = trim($ips[0]);

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return $request->ip();
    }

    public function isUniqueVisitor(string $sessionId): bool
    {
        return !Analytics::where('session_id', $sessionId)->exists();
    }
}