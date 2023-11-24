<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center">
        <p class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Logout</p>
    </div>

    <form method="GET" action="{{ route('saml.logout', ['uuid'=>'0ef871ba-2939-4b9e-8ced-3abd059b2808']) }}">
        @csrf
        <div class="flex flex-col items-center justify-center mt-4">
            <x-primary-button style="background-color: #2563eb">
                {{ __('With SSO') }}
            </x-primary-button>

        </div>
    </form>


    <form method="GET" action="{{ route('logout') }}">
        @csrf
        <div class="flex flex-col items-center justify-center">
            <x-primary-button class="mt-4">
                {{ __('Log out') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
