<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Quiz: {{ $attempt->quiz->title }}
            </h2>
            <div class="whitespace-nowrap">
                <x-secondary-link :href="route('attempts.index')">
                    Return
                </x-secondary-link>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($attempt->answers as $answer)
                        <div class="mb-6 space-y-10">
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">
                                    {{ $answer->question }} ({{ $answer->is_correct ? 1 : 0 }} Point)
                                </legend>
                                <table class="min-w-full text-center">
                                    <thead class="border-b font-medium">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">Chosen answers</th>
                                            <th scope="col" class="px-6 py-4">Correct answers</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b">
                                            <td class="px-6 py-4">{!! Arr::join($answer->chosen_answers, '<br>') !!}</td>
                                            <td class="px-6 py-4">{!! Arr::join($answer->correct_answers, '<br>') !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
