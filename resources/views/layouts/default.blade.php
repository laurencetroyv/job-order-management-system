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
<flux:header container class="pt-4">
    <flux:brand href="/" logo="/mrxuh-logo-new-2026-small.jpg"/>
    <flux:spacer/>
    <flux:brand name="Maria Reyna Xavier University Hospital"/>
</flux:header>
{{ $slot }}
@persist('toast')
<flux:toast.group position="top end">
    <flux:toast/>
</flux:toast.group>
@endpersist

@livewireScripts
@fluxScripts
</body>
</html>
