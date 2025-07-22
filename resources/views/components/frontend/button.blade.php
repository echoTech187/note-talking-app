@props([
    'type' => 'button',
    'class' =>
        'w-full  border bg-blue-500 text-sm font-bold text-gray-100 hover:bg-blue-700 hover:text-gray-100 cursor-pointer',
    'onclick' => null,
])
<div {{ $attributes->merge(['class' => 'flex justify-center']) }}>
    <button type="{{ $type }}" class="{{ $class }} px-4 py-2" onclick="{{ $onclick }}">
        {{ $slot }}
    </button>
</div>
