<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('All plants') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            @if ($plants->isEmpty())
                <p class="rounded-lg border border-dashed border-gray-200 bg-white px-6 py-10 text-center text-sm text-gray-500">
                    {{ __('No plants in the garden yet.') }}
                </p>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($plants as $plant)
                        <div class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
                            <div class="border-b border-emerald-100 bg-emerald-50/50 px-5 py-3">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $plant->name }}</h3>
                            </div>
                            <div class="space-y-2 px-5 py-4 text-sm text-gray-600">
                                <p><span class="font-medium text-gray-800">{{ __('Added by') }}:</span> {{ $plant->creator?->name ?? __('Unknown') }}</p>
                                <p><span class="font-medium text-gray-800">{{ __('Spot') }}:</span> {{ $plant->spot }}</p>
                                @if ($plant->care_note)
                                    <p><span class="font-medium text-gray-800">{{ __('Care') }}:</span> {{ $plant->care_note }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
