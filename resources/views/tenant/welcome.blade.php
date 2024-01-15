<x-guest-layout>
    <div class="text-center">
        <h1 class="mb-4"><strong>Welcome to {{ tenant('id') }}</strong></h1>
        <p class="mb-4">Boost your skills with our quiz app! Take quizzes, develop expertise, and excel in various topics. Start
            learning now!</p>

        @if (Auth::guard('tenant')->check())
            <x-primary-link :href="route('tenant.dashboard')">
                Dashboard
            </x-primary-link>
        @else
            <x-primary-link :href="route('tenant.register')">
                Register
            </x-primary-link>
            <x-primary-link :href="route('tenant.login')">
                Log in
            </x-primary-link>
        @endif
    </div>
</x-guest-layout>
