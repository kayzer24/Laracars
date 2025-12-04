@props(['title' => '', 'bodyClass' => null, 'footerLinks' => ''])
<x-base-layout :$title :$bodyClass>
    <x-layouts.header/>
    {{ $slot }}
    <x-layouts.footer />
</x-base-layout>
