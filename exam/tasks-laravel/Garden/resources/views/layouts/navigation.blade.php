{{-- TODO (L3): Split primary links and account menu with @guest / @auth (see solution). Do not show Dashboard / Add plant / profile to guests. --}}
<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex items-center gap-8 text-sm font-medium text-gray-700">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-emerald-800">
                    <x-application-logo class="h-8 w-auto fill-current text-emerald-600" />
                    {{ config('app.name') }}
                </a>
                <a href="{{ url('/dashboard') }}" class="hover:text-emerald-700">{{ __('Dashboard') }}</a>
                <a href="{{ url('/plants') }}" class="hover:text-emerald-700">{{ __('Plants') }}</a>
                <a href="{{ route('plants.create') }}" class="hover:text-emerald-700">{{ __('Add plant') }}</a>
                <a href="{{ route('login') }}" class="hover:text-emerald-700">{{ __('Log in') }}</a>
                <a href="{{ route('register') }}" class="hover:text-emerald-700">{{ __('Register') }}</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-gray-800">{{ __('Log out') }}</button>
            </form>
        </div>
    </div>
</nav>
