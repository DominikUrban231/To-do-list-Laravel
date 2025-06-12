<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Udostępnione zadanie</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                        Udostępnione zadanie: {{ $task->name }}
                    </h1>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                        </dl>
                                        
                                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded">
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Ten link wygasa: {{ $task->token_expires_at->format('d.m.Y H:i') }}
                                            </p>
                                        </div>
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
                        
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">
                                Zaloguj się do aplikacji
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
