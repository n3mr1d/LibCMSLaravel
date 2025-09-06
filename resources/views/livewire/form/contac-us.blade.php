<div class="max-w-lg mx-auto border-2 dark:border-none mt-12 p-8 bg-white dark:bg-neutral-900 rounded-lg shadow-md">
    <x-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="sendContact" class="space-y-5 mt-6">
        <flux:input
            label="Name"
            name="name"
            icon="user-circle"
            wire:model="name"
            placeholder="Your Name"
            required />
        <flux:input
            label="Email"
            name="email"
            icon="envelope"
            type="email"
            wire:model="email"
            placeholder="you@example.com"
            required />
        <flux:textarea
            label="Message"
            name="message"
            placeholder="Type your message here..."
            rows="5"
            wire:model="message"
            required />
        <div class="pt-2">
            <flux:button type="submit" class="w-full">Send Message</flux:button>
        </div>
    </form>
</div>