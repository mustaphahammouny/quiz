<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create question
            </h2>
            <x-secondary-link :href="route('questions.index', ['quiz' => $quiz->id])">
                Return
            </x-secondary-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full sm:max-w-md mx-auto p-6 text-gray-900 dark:text-gray-100">
                    <x-alert-session />

                    <form method="post" action="{{ route('questions.store') }}">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}" />

                        <div>
                            <x-input-label for="question" value="Question" />
                            <x-text-input id="question" class="block mt-1 w-full" type="text" name="question"
                                :value="old('question')" required autofocus />
                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
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
