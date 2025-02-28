@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => "w-4/6 p-2 border border-gray-300 rounded-md"]) }}>