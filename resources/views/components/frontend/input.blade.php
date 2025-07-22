@props(['type', 'name', 'label', 'placeholder', 'value' => '', 'focus' => false])
<div class="w-full mb-6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>
    <div class="relative">
        <input type="{{ $type }}" name="{{ $name }}" id="{{ str_replace(' ', '_', strtolower($name)) }}"
            placeholder="{{ $placeholder }}" value="{{ $value }}" autofocus="{{ $focus }}"
            class="mt-2 block w-full py-2 px-4 rounded-md focus:rounded-none  border-b-2 bg-gray-100 focus:bg-white border-gray-100 focus-visible:outline-none focus:border-0 focus:border-b-indigo-500 focus:border-b-2 sm:text-sm placeholder:text-sm">
    </div>
</div>
