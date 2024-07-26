<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QI Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col items-center justify-center">
            @livewire('project-tabs')
        </div>
    </div>
    
    
</x-app-layout>

