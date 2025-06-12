<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edytuj zadanie
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nazwa zadania -->
                        <div class="mb-4">
                            <x-input-label for="name" value="Nazwa zadania" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                value="{{ old('name', $task->name) }}" required maxlength="255" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Opis -->
                        <div class="mb-4">
                            <x-input-label for="description" value="Opis (opcjonalnie)" />
                            <textarea id="description" name="description" rows="4"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Priorytet -->
                        <div class="mb-4">
                            <x-input-label for="priority" value="Priorytet" />
                            <select id="priority" name="priority" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @foreach ($priorities as $priority)
                                    <option value="{{ $priority }}" {{ old('priority', $task->priority) == $priority ? 'selected' : '' }}>
                                        {{ ucfirst($priority) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $task->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Data wykonania -->
                        <div class="mb-6">
                            <x-input-label for="due_date" value="Termin wykonania" />
                            <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full"
                                value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" 
                                min="{{ $task->due_date < now() ? $task->due_date->format('Y-m-d') : now()->format('Y-m-d') }}" required />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>

                        <!-- Przyciski -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('tasks.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                                Anuluj
                            </a>
                            <x-primary-button>
                                Zaktualizuj zadanie
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
