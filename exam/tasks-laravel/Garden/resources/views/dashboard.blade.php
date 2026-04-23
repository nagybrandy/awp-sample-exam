<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Garden dashboard') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">{{ __('Your hub for plants in the yard.') }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-8 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="border-b border-gray-100 bg-emerald-50/60 px-6 py-4">
                        <h3 class="text-lg font-medium text-emerald-900">{{ __('Overview') }}</h3>
                    </div>
                    <div class="p-6 text-gray-900">
                        <p class="text-gray-600">
                            {{ __('You are logged in. Use the navigation to browse all plants or add a new one.') }}
                        </p>
                        <p class="mt-4 text-sm text-gray-500">
                            {{ __('Plants on the map:') }}
                            <span class="text-lg font-semibold text-emerald-700">{{ $plantCount }}</span>
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ url('/plants') }}"
                               class="inline-flex rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700">
                                {{ __('Browse plants') }}
                            </a>
                            <a href="{{ url('/plants/create') }}"
                               class="inline-flex rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">
                                {{ __('Add plant') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-100 bg-emerald-700 px-6 py-4">
                        <h3 class="text-lg font-medium text-white">{{ __('Plants you tend') }}</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-500">
                            {{ __('Wire the pivot (L2), then load Auth::user()->tendedPlants here to list plants you care for.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
