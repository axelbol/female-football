<div class="space-y-6">
    <!-- Header and Period Selector -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Analytics Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400">Track your website performance and user behavior</p>
        </div>
        <div>
            <select wire:model.live="period"
                    class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-emerald-500 focus:ring-emerald-500">
                <option value="1">Last 24 hours</option>
                <option value="7">Last 7 days</option>
                <option value="30">Last 30 days</option>
                <option value="90">Last 90 days</option>
            </select>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Page Views -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Page Views</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($analytics['totalViews']) }}</p>
                </div>
            </div>
        </div>

        <!-- Unique Visitors -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-emerald-100 dark:bg-emerald-900 rounded-lg">
                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Unique Visitors</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($analytics['uniqueVisitors']) }}</p>
                </div>
            </div>
        </div>

        <!-- Average Pages per Session -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pages/Session</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $analytics['uniqueVisitors'] > 0 ? number_format($analytics['totalViews'] / $analytics['uniqueVisitors'], 1) : '0' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Mobile Users -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Mobile Users</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($analytics['deviceStats']['mobile']) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Daily Views Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daily Page Views</h3>
            <div class="space-y-4">
                @forelse($analytics['dailyViews'] as $day)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($day->date)->format('M j') }}
                        </span>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-900 dark:text-white">{{ $day->views }} views</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $day->unique_visitors }} visitors</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">No data available for this period</p>
                @endforelse
            </div>
        </div>

        <!-- Top Posts -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Most Popular Stories</h3>
            <div class="space-y-4">
                @forelse($analytics['topPosts'] as $postData)
                    @if($postData->post)
                        <div class="flex items-start space-x-3">
                            <div class="w-12 h-12 flex-shrink-0 rounded-lg overflow-hidden">
                                @if($postData->post->featured_image_url)
                                    <img src="{{ $postData->post->featured_image_url }}"
                                         alt="{{ $postData->post->title }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-500"></div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    <a href="{{ route('post.public', $postData->post->slug) }}" class="hover:text-emerald-600">
                                        {{ $postData->post->title }}
                                    </a>
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ number_format($postData->views) }} views
                                </p>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">No post views recorded yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Device Stats and Referrers -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Device Breakdown -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Device Types</h3>
            <div class="space-y-4">
                @php
                    $totalDeviceViews = array_sum($analytics['deviceStats']);
                @endphp
                @foreach($analytics['deviceStats'] as $device => $count)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 rounded-full {{ $device === 'mobile' ? 'bg-blue-500' : ($device === 'desktop' ? 'bg-emerald-500' : 'bg-purple-500') }}"></div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($device) }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($count) }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                ({{ $totalDeviceViews > 0 ? number_format(($count / $totalDeviceViews) * 100, 1) : 0 }}%)
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Referrers -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Referrers</h3>
            <div class="space-y-3">
                @forelse($analytics['topReferrers'] as $referrer)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-900 dark:text-white truncate max-w-xs" title="{{ $referrer->referrer }}">
                            {{ parse_url($referrer->referrer, PHP_URL_HOST) ?? 'Direct' }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ number_format($referrer->visits) }} visits
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">No referrer data available</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading.flex class="fixed inset-0 bg-black/20 backdrop-blur-sm z-50 items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xl">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-2 border-emerald-600 border-t-transparent"></div>
                <span class="text-gray-900 dark:text-white">Loading analytics...</span>
            </div>
        </div>
    </div>
</div>
