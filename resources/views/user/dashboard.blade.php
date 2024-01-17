<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div class="bg-white max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $quizzes }}</div>
                        <p class="text-gray-700 text-base">Quizzes</p>
                    </div>
                    <div class="px-6 pb-4">
                        <x-primary-link :href="route('quizzes.index')">
                            See more
                        </x-primary-link>
                    </div>
                </div>

                <div class="bg-white max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $members }}</div>
                        <p class="text-gray-700 text-base">Members</p>
                    </div>
                    <div class="px-6 pb-4">
                        <x-primary-link :href="route('members.index')">
                            See more
                        </x-primary-link>
                    </div>
                </div>

                <div class="bg-white max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $attempts }}</div>
                        <p class="text-gray-700 text-base">Attempts</p>
                    </div>
                    <div class="px-6 pb-4">
                        <x-primary-link :href="route('attempts.index')">
                            See more
                        </x-primary-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
