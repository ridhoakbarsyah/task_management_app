@props(['label', 'type' => 'text', 'id', 'name', 'required' => false])

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" {{ $required ? 'required' : '' }}
        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700">
</div>
