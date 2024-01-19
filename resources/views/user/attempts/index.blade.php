<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Attempts
            </h2>
            <div class="whitespace-nowrap">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'attempts-export')">
                    Export
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-alert-session />
                    
                    <table class="min-w-full text-left">
                        <thead class="border-b font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">Member</th>
                                <th scope="col" class="px-6 py-4">Quiz</th>
                                <th scope="col" class="px-6 py-4 whitespace-nowrap">Score (%)</th>
                                <th scope="col" class="px-6 py-4 whitespace-nowrap">Passed At</th>
                                <th scope="col" class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attempts as $attempt)
                                <tr class="border-b">
                                    <td class="px-6 py-4 font-medium">{{ $attempt->member->name }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $attempt->quiz->title }}</td>
                                    <td class="px-6 py-4">{{ $attempt->score }}</td>
                                    <td class="px-6 py-4">{{ $attempt->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="whitespace-nowrap text-right">
                                        <x-primary-link :href="route('attempts.show', ['attempt' => $attempt->id])">
                                            Details
                                        </x-primary-link>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>

                    <div class="pt-4">
                        {{ $attempts->links() }}
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="attempts-export" focusable>
            <form method="post" action="{{ route('attempts.export') }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Export data
                </h2>

                <div class="mt-6">
                    <x-input-label for="member" value="Member" />

                    <x-select-input id="member" name="member_id" class="mt-1" placeholder="Member">
                        <option value="0" selected>Select Member</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </x-select-input>

                    <x-input-error :messages="$errors->get('member_id')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="quiz" value="Quiz" />

                    <x-select-input id="quiz" name="quiz_id" class="mt-1" placeholder="Quiz">
                        <option value="0" selected>Select Quiz</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                        @endforeach
                    </x-select-input>

                    <x-input-error :messages="$errors->get('quiz_id')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Validate') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
