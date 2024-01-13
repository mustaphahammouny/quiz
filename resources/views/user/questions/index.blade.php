<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Questions of the quiz : {{ $quiz->title }}
            </h2>
            <div class="whitespace-nowrap">
                <x-secondary-link :href="route('quizzes.index')">
                    Return
                </x-secondary-link>
                <x-primary-link :href="route('questions.create', ['quiz' => $quiz->id])">
                    Create
                </x-primary-link>
            </div>
        </div>
    </x-slot>

    <div x-data="{ selectedRoute: null }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-alert-session />

                    <table class="min-w-full text-left">
                        <thead class="border-b font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">Question</th>
                                <th scope="col" class="px-6 py-4">Slug</th>
                                <th scope="col" class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($questions as $question)
                                <tr class="border-b">
                                    <td class="px-6 py-4 font-medium">{{ $question->question }}</td>
                                    <td class="px-6 py-4">{{ $question->slug }}</td>
                                    <td class="whitespace-nowrap text-right">
                                        <x-primary-link :href="route('choices.index', ['question' => $question->id])">
                                            Choices
                                        </x-primary-link>
                                        <x-primary-link :href="route('questions.edit', ['question' => $question->id])">
                                            Edit
                                        </x-primary-link>
                                        <x-danger-button x-data="{ route: '{{ route('questions.destroy', ['question' => $question->id]) }}' }"
                                            x-on:click.prevent="() => {selectedRoute = route; $dispatch('open-modal', 'confirm-question-deletion');}">
                                            Delete
                                        </x-danger-button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>

                    <div class="pt-4">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="confirm-question-deletion" focusable>
            <form method="post" x-bind:action="selectedRoute" class="p-6">
                @csrf
                @method('delete')
    
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete this question?
                </h2>
    
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once the question is deleted, all of its questions and choices will be permanently deleted.
                </p>
    
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-danger-button class="ms-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
