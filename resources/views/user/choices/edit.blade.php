<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit choice
            </h2>
            <x-secondary-link :href="route('choices.index', ['question' => $choice->question_id])">
                Return
            </x-secondary-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full sm:max-w-md mx-auto p-6 text-gray-900 dark:text-gray-100">
                    <x-alert-session />

                    <form method="post" action="{{ route('choices.update', ['choice' => $choice->id]) }}">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="title" value="title" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title') ?? $choice->title" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="order" value="order" />
                            <x-text-input id="order" class="block mt-1 w-full" type="number" name="order"
                                :value="old('order') ?? $choice->order" required />
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <div class="block mt-4">
                            <label for="is_correct" class="inline-flex items-center">
                                <input id="is_correct" type="checkbox"
                                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                    name="is_correct" value="on" @checked($choice->is_correct)>
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Is correct</span>
                            </label>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" value="Description" />
                            <x-text-textarea id="description" class="block mt-1 w-full" type="text"
                                name="description">{{ old('description') ?? $choice->description }}</x-text-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="explanation" value="Explanation" />
                            <x-text-textarea id="explanation" class="block mt-1 w-full" type="text"
                                name="explanation">{{ old('explanation') ?? $choice->explanation }}</x-text-textarea>
                            <x-input-error :messages="$errors->get('explanation')" class="mt-2" />
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
