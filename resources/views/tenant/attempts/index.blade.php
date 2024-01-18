<x-tenant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Attempts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left">
                        <thead class="border-b font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">Quiz</th>
                                <th scope="col" class="px-6 py-4 whitespace-nowrap">Score (%)</th>
                                <th scope="col" class="px-6 py-4 whitespace-nowrap">Passed At</th>
                                <th scope="col" class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attempts as $attempt)
                                <tr class="border-b">
                                    <td class="px-6 py-4 font-medium">{{ $attempt->quiz->title }}</td>
                                    <td class="px-6 py-4">{{ $attempt->score }}</td>
                                    <td class="px-6 py-4">{{ $attempt->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="whitespace-nowrap text-right">
                                        <x-primary-link :href="route('tenant.attempts.show', ['attempt' => $attempt->id])">
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
    </div>
</x-tenant-layout>
