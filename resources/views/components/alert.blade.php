@props(['message', 'color'])

<div class="mb-4 rounded-lg bg-{{ $color }}-100 px-6 py-5 text-base text-{{ $color }}-700" role="alert">
    {{ $message }}
</div>
