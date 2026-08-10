<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet"/>

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
<flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.header>
        <flux:sidebar.brand
            href="{{ route('index') }}"
            logo="/mrxuh-logo-new-2026-small.jpg"
            name="Maria Reyna Xavier University Hospital"
        />
        <flux:sidebar.collapse
            class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2"/>
    </flux:sidebar.header>

    <flux:sidebar.search placeholder="Search..." kbd="⌘K"/>

    @auth
        <livewire:layouts.sidebar-items/>
    @endauth

    <flux:sidebar.spacer/>

    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        @auth
            <livewire:layouts.dropdown-profile/>
            <livewire:layouts.dropdown-menu/>
        @else
            <p>Unauthenticated</p>
        @endauth
    </flux:dropdown>
</flux:sidebar>

<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
    <flux:spacer/>
    <flux:dropdown position="top" alignt="start">
        <livewire:layouts.dropdown-profile/>
        @auth
            <livewire:layouts.dropdown-profile/>
            <livewire:layouts.dropdown-menu/>
        @else
            <p>Unauthenticated</p>
        @endauth
    </flux:dropdown>
</flux:header>

<flux:main>
    {{ $slot }}
</flux:main>

@persist('toast')
<flux:toast.group position="top end">
    <flux:toast/>
</flux:toast.group>
@endpersist

@livewireScripts
@fluxScripts
</body>
</html>
