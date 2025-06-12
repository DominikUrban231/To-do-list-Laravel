<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Moje zadania
            </h2>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                Dodaj zadanie
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('share_link'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">
                                Link do udostępnienia zadania: 
                                <a href="{{ session('share_link') }}" class="underline" target="_blank">{{ session('share_link') }}</a>
                            </span>
                        </div>
                    @endif

                    <!-- Filtry -->
                    <div class="mb-6">
                        <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-wrap gap-4">
                            <div>
                                <select name="status" class="rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Wszystkie statusy</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <select name="priority" class="rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Wszystkie priorytety</option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority }}" {{ request('priority') == $priority ? 'selected' : '' }}>
                                            {{ ucfirst($priority) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <input type="date" name="due_date" value="{{ request('due_date') }}" class="rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            
                            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filtruj
                            </button>
                            
                            @if(request('status') || request('priority') || request('due_date'))
                                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Resetuj filtry
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Lista zadań -->
                    @if ($tasks->count())
                        
                        
                        <!-- Widok kart dla urządzeń mobilnych -->
                        <div class="grid grid-cols-1 gap-4 md:hidden mt-4">
                            @foreach ($tasks as $task)
                                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between items-start mb-2">
                                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:underline text-lg font-medium">
                                            {{ $task->name }}
                                        </a>
                                        <span class="px-2 py-1 rounded text-xs font-semibold whitespace-nowrap
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
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-2 mb-3">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Priorytet:</p>
                                            <p class="font-medium
                                                @if($task->priority == 'high')
                                                    text-red-600 dark:text-red-400
                                                @elseif($task->priority == 'medium')
                                                    text-yellow-600 dark:text-yellow-400
                                                @else
                                                    text-green-600 dark:text-green-400
                                                @endif"
                                            >
                                                {{ ucfirst($task->priority) }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Termin:</p>
                                            <p class="font-medium {{ $task->due_date->isPast() && $task->status != 'done' ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-gray-300' }}">
                                                {{ $task->due_date->format('d.m.Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-end space-x-2 mt-2">
                                        <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                                            Edytuj
                                        </a>
                                        <a href="{{ route('tasks.history', $task) }}" class="px-3 py-1 bg-gray-500 text-white text-xs rounded hover:bg-gray-600">
                                            Historia
                                        </a>
                                        <form action="{{ route('tasks.share', $task) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600">
                                                Udostępnij
                                            </button>
                                        </form>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Czy na pewno chcesz usunąć to zadanie?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                                Usuń
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Paginacja -->
                        <div class="mt-4">
                            {{ $tasks->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="py-8 text-center text-gray-500 dark:text-gray-400">
                            Brak zadań. <a href="{{ route('tasks.create') }}" class="text-blue-500 hover:underline">Dodaj pierwsze zadanie</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
