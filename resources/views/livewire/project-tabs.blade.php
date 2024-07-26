<div class="w-full max-w-7xl mx-auto p-4 sm:p-6">
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('All Tasks') }}</h3>
            <hr class="border-gray-300 mb-4">
            <!-- Action Alert -->
            <div>
                @if(empty($tasks))
                    <div class="flex flex-col items-center justify-center h-64">
                        <p class="text-lg text-gray-600">
                            No records created yet.
                        </p>
                    </div>
                @else
                    @foreach($tasks as $group => $groupTasks)
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $group }}</h3>
                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100 text-left text-sm font-medium text-gray-600">
                                        <tr>
                                            <th class="px-4 py-2">Task</th>
                                            <th class="px-4 py-2">Project</th>
                                            <th class="px-4 py-2">Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($groupTasks as $task)
                                            <!-- Row -->
                                            <tr class="border-b hover:bg-gray-50">
                                                <!-- Column -->
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <h1 class="font-semibold text-gray-800">{{ $task->name ?? "" }}</h1>
                                                    <p class="text-sm text-gray-600">{{ $task->description ?? "" }}</p>
                                                </td>
                                                <!-- Column -->
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm border border-indigo-400 text-indigo-700 bg-indigo-100">
                                                        {{ $task->project->name ?? "" }}
                                                    </span>
                                                </td>
                                                <!-- Column -->
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <p class="text-sm text-gray-600">
                                                        Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('d, M Y') }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
