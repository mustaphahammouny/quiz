<x-tenant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Quiz: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @error('answers')
                        <x-alert :message="$message" color="red" />
                    @enderror

                    <form method="post" action="{{ route('tenant.attemps.store', ['quiz' => $quiz->id]) }}">
                        @csrf

                        @foreach ($quiz->questions as $question)
                            <div class="mb-6 space-y-10">
                                <fieldset>
                                    <legend class="text-sm font-semibold leading-6 text-gray-900">
                                        {{ $question->question }}
                                    </legend>
                                    <div class="mt-6">
                                        @foreach ($question->choices as $choice)
                                            <div class="block mt-2">
                                                <label for="choice-{{ $choice->id }}"
                                                    class="inline-flex items-center">
                                                    <input id="choice-{{ $choice->id }}" type="checkbox"
                                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                        name="answers[{{ $question->id }}][]"
                                                        value="{{ $choice->id }}">
                                                    <span
                                                        class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ $choice->title }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>
                        @endforeach

                        <div class="text-center">
                            <x-primary-button type="submit">
                                Validate
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-tenant-layout>
