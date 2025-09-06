<div class="flex items-center justify-between mb-6 z-50">
    <h1 class="text-5xl font-bold text-gray-800 dark:text-white">{{ $title }}</h1>

    @if ($actions)
        <div class="flex items-center space-x-2">
            {{ $actions }}
        </div>
    @endif
</div>
