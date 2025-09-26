<?php

namespace App\Http\Middleware;

use App\Services\AnalyticsService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackAnalytics
{
    public function __construct(
        private AnalyticsService $analyticsService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET requests that are not API or admin routes
        if ($request->isMethod('GET') &&
            $response->isSuccessful() &&
            !$request->is('api/*') &&
            !$request->is('analytics*') &&
            !$request->is('dashboard*') &&
            !$request->is('settings*') &&
            !$request->is('login*') &&
            !$request->is('register*') &&
            !$request->ajax() &&
            !$request->expectsJson()) {

            $postId = $this->getPostIdFromRequest($request);
            $this->analyticsService->trackPageView($request, $postId);
        }

        return $response;
    }

    private function getPostIdFromRequest(Request $request): ?int
    {
        $route = $request->route();

        if (!$route) {
            return null;
        }

        // Check for post parameter in route
        if ($route->hasParameter('post')) {
            $post = $route->parameter('post');
            return is_object($post) ? $post->id : (int) $post;
        }

        // Check route name patterns for post views
        $routeName = $route->getName();
        if ($routeName === 'post.public') {
            $post = $route->parameter('post');
            return is_object($post) ? $post->id : null;
        }

        return null;
    }
}
