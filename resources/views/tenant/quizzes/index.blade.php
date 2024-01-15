<x-tenant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Quizzes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-session />

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @forelse ($quizzes as $quiz)
                    <div class="bg-white max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $quiz->title }}</div>
                            <p class="text-gray-700 text-base">{{ $quiz->description }}</p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                {{ $quiz->questions_count }} questions
                            </span>
                            @if ($quiz->start_time)
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    Start time: {{ $quiz->start_time->format('d/m/Y H:i') }}
                                </span>
                            @endif
                            @if ($quiz->end_time)
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    End time: {{ $quiz->end_time->format('d/m/Y H:i') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

            <div class="pt-4">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>
</x-tenant-layout>
