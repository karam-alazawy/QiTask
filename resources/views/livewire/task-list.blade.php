<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tasks') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Column 1: New Task Form -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="font-semibold text-lg mb-4">{{ __('New Task') }}</h3>
                        @livewire('create-task')
                    </div>
                </div>
            </div>

            <!-- Column 2: Tasks List -->
            <div class="w-full lg:w-3/4">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="font-semibold text-lg mb-4">{{ __('Tasks List') }}</h3>

                        <!-- Action Alerts -->
                        @if (session()->has('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-md mb-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h3 class="font-medium">{{ __('Success') }}</h3>
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('failed'))
                        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-md mb-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-9v4a1 1 0 11-2 0v-4a1 1 0 112 0zm-1-4a1 1 0 011-1h.5a1 1 0 010 2h-1a1 1 0 01-1-1zM9 13a1 1 0 112 0v1a1 1 0 11-2 0v-1zm8-3a1 1 0 110 2h-1a1 1 0 110-2h1z"
                                        clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h3 class="font-medium">{{ __('Error') }}</h3>
                                    <p>{{ session('failed') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                        <!-- No Records Message -->
                        @empty($tasks)
                            <div class="flex items-center justify-center h-64">
                                <p class="text-gray-600 text-lg">No records created yet.</p>
                            </div>
                        @else
                            <!-- Tasks Table -->
                            @foreach($tasks as $group => $groupTasks)
                                <div class="mb-4">
                                    <h3 class="font-semibold text-lg py-4">{{ $group }}</h3>
                                    <div class="overflow-x-auto">
                                        <table class="w-full divide-y divide-gray-200">
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($groupTasks as $task)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-2">
                                                            <h1 class="font-semibold">{{ $task->name ?? '' }}</h1>
                                                            <p class="text-sm text-gray-600">{{ $task->description ?? '' }}</p>
                                                        </td>
                                                        <td class="px-4 py-2">
                                                            <span class="p-2 inline-flex items-center text-sm border border-indigo-400 text-indigo-700 rounded-md">
                                                                {{ $task->project->name ?? '' }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-2">
                                                            <p class="text-sm text-gray-600">
                                                                Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('d, M Y') }}
                                                            </p>
                                                        </td>
                                                        <td class="px-4 py-2 text-right">
                                                            <x-jet-button wire:click="markAsCompleted({{ $task->id }})" wire:loading.attr="disabled">
                                                                {{ __('Completed') }}
                                                            </x-jet-button>
                                                        </td>
                                                        <td class="px-4 py-2 text-right">
                                                            <x-jet-button wire:click="deleteTask({{ $task->id }})" wire:loading.attr="disabled">
                                                                {{ __('Delete') }}
                                                            </x-jet-button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
