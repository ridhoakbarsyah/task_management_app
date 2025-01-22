@props(['type' => 'info', 'message'])

@php
    $alertClasses = [
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'error' => 'bg-red-100 border-red-500 text-red-700',
        'info' => 'bg-blue-100 border-blue-500 text-blue-700',
    ][$type];
@endphp

<div class="{{ $alertClasses }} p-4 mb-4 rounded border-l-4" role="alert">
    {{ $message }}
</div>
