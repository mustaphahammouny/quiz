<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create quiz
            </h2>
            <x-secondary-link :href="route('quizzes.index')">
                Return
            </x-secondary-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full sm:max-w-md mx-auto p-6 text-gray-900 dark:text-gray-100">
                    <x-alert-session />

                    <form method="post" action="{{ route('quizzes.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="start_time" value="Start time" />
                            <x-text-input id="start_time" class="block mt-1 w-full" type="datetime-local"
                                name="start_time" :value="old('start_time')" />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="end_time" value="End time" />
                            <x-text-input id="end_time" class="block mt-1 w-full" type="datetime-local" name="end_time"
                                :value="old('end_time')" />
                            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" value="Description" />
                            <x-text-textarea id="description" class="block mt-1 w-full" type="text"
                                name="description">{{ old('description') }}</x-text-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
