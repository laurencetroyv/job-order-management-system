<main class="mx-auto flex w-full max-w-3xl justify-center px-4 py-8">
    <div class="w-full p-6 sm:p-8">
        <div class="space-y-2 text-center">
            <flux:heading level="1" size="xl">Create your profile</flux:heading>
            <flux:text>This is how you will appear in the system.</flux:text>
            <flux:text size="sm">This account will be the super administrator.</flux:text>
        </div>

        <form class="mt-8 space-y-6" wire:submit="onSubmit">
            <div class="flex flex-col items-center gap-3">
                <label for="avatar-upload"
                       class="group relative cursor-pointer rounded-full focus-within:outline-2 focus-within:outline-offset-4 focus-within:outline-zinc-950 dark:focus-within:outline-white">
                    @if ($form->photo)
                        <img src="{{ $form->photo->temporaryUrl() }}" class="size-32 rounded-full object-cover"
                             alt="Selected avatar preview"/>
                    @else
                        <flux:avatar circle size="xl" class="size-32 text-4xl"/>
                    @endif

                    <span
                        class="absolute inset-0 flex items-center justify-center rounded-full bg-black/45 text-sm font-medium text-white opacity-0 transition group-hover:opacity-100 group-focus-within:opacity-100">
                            Change photo
                        </span>

                    <input id="avatar-upload" wire:model="form.photo" type="file"
                           accept="image/png,image/jpeg,image/webp" class="sr-only"/>
                </label>

                <div class="text-center">
                    <flux:text size="sm">Profile photo <span class="text-zinc-400">(optional)</span></flux:text>
                    <flux:error name="photo"/>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <flux:input wire:model="form.firstName" label="First name" placeholder="Your first name"
                            autocomplete="given-name" maxlength="32" required/>
                <flux:input wire:model="form.middleName" label="Middle name" placeholder="Your middle name"
                            autocomplete="additional-name" maxlength="32"/>
                <flux:input wire:model="form.lastName" label="Last name" placeholder="Your last name"
                            autocomplete="family-name" maxlength="32" required/>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <flux:input wire:model="form.email" label="Email address" type="email" placeholder="you@example.com"
                            autocomplete="email" maxlength="254" spellcheck="false" required/>
                <flux:input wire:model="form.password" label="Password" type="password"
                            placeholder="At least 8 characters" autocomplete="new-password" viewable maxlength="32"
                            required/>
            </div>

            <flux:button variant="primary" type="submit" class="w-full" wire:target="photo,onSubmit">
                <div class="flex flex-row gap-2">
                    <flux:icon.loading class="not-in-data-loading:hidden"/>
                    <span>Create Super Administrator</span>
                </div>
            </flux:button>

            <flux:text size="sm" class="text-center">You can add a profile photo later.</flux:text>
        </form>
    </div>
</main>
