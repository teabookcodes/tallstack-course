<?php

use Livewire\Volt\Component;

new class extends Component {
    public $collectionTitle;
    public $collectionBody;
    public $collectionRecipient;
    public $collectionSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'collectionTitle' => ['required', 'string', 'min:5'],
            'collectionBody' => ['required', 'string', 'min:20'],
            'collectionRecipient' => ['required', 'email'],
            'collectionSendDate' => ['required', 'date'],
        ]);

        auth()->user()->collections()->create([
            'title' => $this->collectionTitle,
            'body' => $this->collectionBody,
            'recipient' => $this->collectionRecipient,
            'send_date' => $this->collectionSendDate,
            'is_published' => false,
        ]);

        redirect()->route('collections.index');
    }
}; ?>

<div>
    <form wire:submit='submit' class="space-y-4">
        <x-input wire:model='collectionTitle' label="Title" placeholder="Some epic title" />
        <x-textarea wire:model='collectionBody' label="Body" placeholder="Share what you want" />
        <x-input icon="user" wire:model='collectionRecipient' label="Recipient" placeholder="yourfriend@example.com" type="email" />
        <x-input icon="calendar" wire:model='collectionSendDate' label="Send Date" type="date" />
        <div class="pt-4">
            <x-button primary wire:click='submit' spinner>Create collection</x-button>
        </div>
        <x-errors />
    </form>
</div>
