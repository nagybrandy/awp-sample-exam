<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add a plant') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                {{-- TODO (L3): Add @csrf. Fix the spot field name. Protect this route with auth middleware. --}}
                <form method="POST" action="{{ route('plants.store') }}" class="space-y-6">

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="spot" :value="__('Spot in the garden')" />
                        <x-text-input id="spot" class="mt-1 block w-full" type="text" name="garden_spot" :value="old('spot')" required />
                        <x-input-error :messages="$errors->get('spot')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="care_note" :value="__('Care note (optional)')" />
                        <textarea id="care_note" name="care_note" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('care_note') }}</textarea>
                        <x-input-error :messages="$errors->get('care_note')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save plant') }}</x-primary-button>
                        <a href="{{ url('/plants') }}" class="text-sm text-gray-600 underline hover:text-gray-900">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
