<?php

use Livewire\Volt\Component;

new class extends Component {
    public function delete($collectionId)
    {
        $collection = Auth::user()->collections()->findOrFail($collectionId);
        $this->authorize('delete', $collection);
        $collection->delete();
    }

    public function with(): array
    {
        return [
            'collections' => Auth::user()->collections()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($collections->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">You have no collections.</p>
                <p class="text-sm">Let's create your first one now</p>
            
                <x-button primary icon="plus" class="mt-6" href="{{route('collections.create')}}" wire:navigate>
                    Create collection
                </x-button>
            </div>
        @else
            <x-button primary icon="plus" class="mt-6 mb-12" href="{{route('collections.create')}}" wire:navigate>
                Create collection
            </x-button>
            
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($collections as $collection)
                    <x-card wire:key='{{ $collection->id }}'>
                        <div class="px-2 md:px-0">
                            <div class="flex justify-between">
                                <div>
                                    <a href="{{ route('collections.edit', $collection) }}" wire:navigate class="text-xl font-bold hover:underline hover:text-indigo-500">
                                        {{ $collection->title }}
                                    </a>
                                    <p class="mt-2 text-xs">{{ Str::limit($collection->body, 30) }}</p>
                                </div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($collection->send_date)->format('M d, Y') }}</div>
                            </div>
                            <div class="flex items-end justify-between mt-4 space-x-1">
                                <p class="text-xs">Recipient: <span class="font-semibold">{{ $collection->recipient }}</span></p>
                                <div>
                                    <x-button.circle icon="eye"></x-button.circle>
                                    <x-button.circle icon="trash" wire:click="delete('{{ $collection->id }}')"></x-button.circle>
                                </div>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
