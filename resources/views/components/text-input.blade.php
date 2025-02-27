@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => "w-80 p-2 border border-gray-300 rounded-md"]) }}>