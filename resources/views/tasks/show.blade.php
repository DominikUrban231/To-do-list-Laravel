<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $task->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                    Edytuj
                </a>
                <a href="{{ route('tasks.history', $task) }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white font-bold rounded">
                    Historia zmian
                </a>
                <form action="{{ route('tasks.share', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-bold rounded">
                        Udostępnij
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('share_link'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">
                        Link do udostępnienia zadania: 
                        <a href="{{ session('share_link') }}" class="underline" target="_blank">{{ session('share_link') }}</a>
                    </span>
                </div>
            @endif
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Szczegóły zadania</h3>
                            
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            @if($task->status == 'to-do') 
                                                bg-gray-200 text-gray-800
                                            @elseif($task->status == 'in progress')
                                                bg-blue-200 text-blue-800
                                            @else
                                                bg-green-200 text-green-800
                                            @endif"
                                        >
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </dd>
                                </div>
                                
                                <div>
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Priorytet:</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            @if($task->priority == 'low') 
                                                bg-green-200 text-green-800
                                            @elseif($task->priority == 'medium')
                                                bg-yellow-200 text-yellow-800
                                            @else
                                                bg-red-200 text-red-800
                                            @endif"
                                        >
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </dd>
                                </div>
                                
                                <div>
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Termin:</dt>
                                    <dd class="mt-1 @if($task->due_date->isPast() && $task->status != 'done') text-red-600 font-bold @endif">
                                        {{ $task->due_date->format('d.m.Y') }}
                                    </dd>
                                </div>
                                
                                <div>
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Data utworzenia:</dt>
                                    <dd class="mt-1">
                                        {{ $task->created_at->format('d.m.Y H:i') }}
                                    </dd>
                                </div>
                                
                                <div>
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Ostatnia aktualizacja:</dt>
                                    <dd class="mt-1">
                                        {{ $task->updated_at->format('d.m.Y H:i') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Opis</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                                @if ($task->description)
                                    <p class="whitespace-pre-line">{{ $task->description }}</p>
                                @else
                                    <p class="text-gray-500 dark:text-gray-400">Brak opisu</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('tasks.index') }}" class="text-gray-500 hover:text-gray-700">
                    &larr; Wróć do listy zadań
                </a>
                
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć to zadanie?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
                        Usuń zadanie
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
