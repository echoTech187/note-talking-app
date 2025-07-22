@props([
    'size' => '24',
    'text' => '',
    'textSize' => '2xl',
    'class' => 'flex flex-col items-center justify-center w-full"',
])
<div class="{{ $class }}">
    <div class="w-{{ $size }} h-{{ $size }}">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-full h-full">
    </div>
    @if ($text !== '')
        <span class="text-{{ $textSize }} font-bold text-[#444444] dark:text-[#efefef]">{{ $text }}</span>
    @endif
</div>
