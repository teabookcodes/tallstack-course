<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create a collection') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl px-6 mx-auto space-y-4 lg:px-8">
                <x-button icon="arrow-left" class="mb-8" href="{{ route('collections.index') }}">Back</x-button>
                <livewire:collections.create-collection />
        </div>
    </div>
</x-app-layout>
