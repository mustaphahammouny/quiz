@if (session('success'))
    <x-alert :message="session('success')" color="green" />
@elseif (session('error'))
    <x-alert :message="session('error')" color="red" />
@endif
