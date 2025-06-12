<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Historia zmian: {{ $task->name }}
            </h2>
            <div>
                <a href="{{ route('tasks.show', $task) }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-bold rounded">
                    Wróć do zadania
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($history->count() > 0)
                        <ol class="relative border-l border-gray-300 dark:border-gray-700">
                            @foreach ($history as $record)
                                <li class="mb-6 ml-6">
                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-800 dark:bg-blue-900">
                                        @if ($record->change_type === 'create')
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/></svg>
                                        @elseif ($record->change_type === 'update')
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18"><path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/><path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/></svg>
                                        @elseif ($record->change_type === 'delete')
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20"><path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/></svg>
                                        @else
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="8" /></svg>
                                        @endif
                                    </span>
                                    <div class="p-4 bg-white dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                        <div class="flex justify-between items-center mb-2">
                                            <time class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                {{ $record->created_at->format('d.m.Y H:i') }}
                                            </time>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                {{ $record->formatted_change_type }}
                                            </span>
                                        </div>
                                        @if ($record->field_name === 'task')
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                @if ($record->change_type === 'create')
                                                    Zadanie zostało utworzone
                                                @elseif ($record->change_type === 'delete')
                                                    Zadanie zostało usunięte
                                                @elseif ($record->change_type === 'restore')
                                                    Zadanie zostało przywrócone
                                                @endif
                                            </h3>
                                        @else
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Zmieniono: {{ $record->formatted_field_name }}
                                            </h3>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded">
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Poprzednia wartość:</p>
                                                    <p class="font-medium">
                                                        {{ $record->old_value ?: '(brak)' }}
                                                    </p>
                                                </div>
                                                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded">
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nowa wartość:</p>
                                                    <p class="font-medium">
                                                        {{ $record->new_value ?: '(brak)' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                                            @if ($record->user)
                                                Zmienione przez: {{ $record->user->name }}
                                            @else
                                                Zmienione przez: System
                                            @endif
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <div class="mt-4">
                            {{ $history->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">Brak dostępnej historii zmian dla tego zadania.</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-end">
                <a href="{{ route('tasks.index') }}" class="text-gray-500 hover:text-gray-700">
                    &larr; Wróć do listy zadań
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
