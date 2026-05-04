<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('All plants') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                        <div class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
                            <div class="border-b border-emerald-100 bg-emerald-50/50 px-5 py-3">
                                <h3 class="text-lg font-semibold text-gray-900">Basil</h3>
                            </div>
                            <div class="space-y-2 px-5 py-4 text-sm text-gray-600">
                                <p><span class="font-medium text-gray-800">{{ __('Added by') }}:</span> John Doe</p>
                                <p><span class="font-medium text-gray-800">{{ __('Spot') }}:</span> Front yard</p>
                                <p><span class="font-medium text-gray-800">{{ __('Care') }}:</span> Water every week</p>
                            </div>
                        </div>
                </div>
        </div>
    </div>
</x-app-layout>
