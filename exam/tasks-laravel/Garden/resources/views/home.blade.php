<x-guest-layout>
    <div class="space-y-6 text-center">
        <h1 class="text-2xl font-semibold text-gray-900">
            {{ __('Welcome to Garden') }}
        </h1>
        <p class="text-gray-600">
            {{ __('Track plants in your backyard — where they sit and how to care for them.') }}
        </p>
        <p class="text-sm text-gray-500">
            {{ __('Plants in the map:') }} <span class="font-semibold text-emerald-700">{{ $plantCount }}</span>
        </p>
        <div class="flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a href="{{ url('/plants') }}"
               class="inline-flex items-center justify-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                {{ __('Browse plants') }}
            </a>
            <a href="{{ route('login') }}"
               class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                {{ __('Log in to manage') }}
            </a>
        </div>
    </div>
</x-guest-layout>
