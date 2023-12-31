<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Collection;

new #[Layout('layouts.app')] class extends Component {
    public Collection $collection;

    public function mount(Collection $collection)
    {
        $this->authorize('update', $collection);
        $this->fill($collection);
    }
}; ?>

<div class="space-y-2 text-gray-900 dark:text-gray-100">
    <p>{{ $collection->title }}</p>
    <p>{{ $collection->id }}</p>
    <p>{{ $collection->user->email }}</p>
</div>
