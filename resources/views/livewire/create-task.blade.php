<form wire:submit.prevent="createTask" class="{{ $creatingTask ? 'opacity-50 pointer-events-none' : '' }}"
      wire:loading.class="opacity-50 pointer-events-none">
    <!-- Action Alert -->
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

    <!-- Project select input -->
    <div class="mb-4">
        <label for="project_id" class="block text-sm font-medium text-gray-700">{{ __('Select Project') }}</label>
        <select id="project_id" name="project_id" wire:model.defer="project_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Select Project</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="project_id" class="mt-2" />
    </div>

    <!-- Name input -->
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
        <input type="text" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.defer="name" />
        <x-jet-input-error for="name" class="mt-2" />
    </div>

    <!-- Description input -->
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
        <textarea id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3" wire:model.defer="description"></textarea>
        <x-jet-input-error for="description" class="mt-2" />
    </div>

    <!-- Start date input -->
    <div class="mb-4">
        <label for="start_date" class="block text-sm font-medium text-gray-700">{{ __('Start Date') }}</label>
        <input type="date" id="start_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.defer="start_date" min="{{ date('Y-m-d') }}" />
        <x-jet-input-error for="start_date" class="mt-2" />
    </div>

    <!-- Duration input -->
    <div class="mb-4">
        <label for="duration" class="block text-sm font-medium text-gray-700">{{ __('Duration (days)') }}</label>
        <input type="number" id="duration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.defer="duration" min="1" />
        <x-jet-input-error for="duration" class="mt-2" />
    </div>

    <!-- Submit button -->
    <div class="mb-4">
        <x-jet-button>
        {{ __('Create Task') }}
        </x-jet-button>
    </div>
</form>
