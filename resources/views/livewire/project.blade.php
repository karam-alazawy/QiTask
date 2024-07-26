<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Projects') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Column 1 -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white shadow-md rounded-lg">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="font-semibold text-lg mb-4">{{ __('New Project') }}</h3>
                            <hr class="mb-4">
                            @livewire('create-project')
                        </div>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="w-full lg:w-3/4">
                    <div class="bg-white shadow-md rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="font-semibold text-lg mb-4">{{ __('Projects') }}</h3>
                            <hr class="mb-4">
                            <!-- Action Alert -->
                            <div>
                                @if (session()->has('success'))
                                    <div class="rounded-md bg-green-500 p-4 mb-4">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-white">{{ __('Success') }}</h3>
                                                <p class="text-sm text-white">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (session()->has('failed'))
                                    <div class="rounded-md bg-red-500 p-4 mb-4">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-9v4a1 1 0 11-2 0v-4a1 1 0 112 0zm-1-4a1 1 0 011-1h.5a1 1 0 010 2h-1a1 1 0 01-1-1zM9 13a1 1 0 112 0v1a1 1 0 11-2 0v-1zm8-3a1 1 0 110 2h-1a1 1 0 110-2h1z" clip-rule="evenodd"/>
                                            </svg>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-white">{{ __('Error') }}</h3>
                                                <p class="text-sm text-white">{{ session('failed') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(empty($projects))
                                    <div class="flex flex-col items-center justify-center h-64">
                                        <p class="text-gray-600 text-lg">No records created yet.</p>
                                    </div>
                                @else
                                    <table class="w-full divide-y divide-gray-200">
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($projects as $task)
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="px-4 py-2">
                                                        <h1 class="font-semibold">{{ $task->name ?? "" }}</h1>
                                                        <p class="text-sm text-gray-600">{{ $task->description ?? "" }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
