@props(['color', 'title'])

<span
    class="inline-flex items-center rounded-md bg-{{ $color }}-50 px-2 py-1 text-xs font-medium text-{{ $color }}-700">
    {{ $title }}
</span>
