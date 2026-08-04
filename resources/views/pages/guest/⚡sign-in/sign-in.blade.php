<main class="mx-auto flex w-full max-w-3xl justify-center px-4 py-8">
    <div class="w-lg p-6 sm:p-8">
        <div class="space-y-2 text-center">
            <flux:heading level="1" size="xl">Welcome Back!</flux:heading>
            <flux:text>Log in to your account.</flux:text>
        </div>

        <form class="mt-8 space-y-6" wire:submit="onSubmit">
            <flux:input wire:model="form.email" label="Email Address" type="email" placeholder="Your email address"/>

            <flux:input wire:model="form.password" label="Password" type="password" placeholder="Your password"/>

            <flux:button variant="primary" class="w-full" type="submit">
                <div class="flex flex-row gap-2">
                    <flux:icon.loading class="not-in-data-loading:hidden"/>
                    <span>Log in</span>
                </div>
            </flux:button>
        </form>

    </div>
</main>
