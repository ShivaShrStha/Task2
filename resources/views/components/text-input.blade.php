@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => "w-4/6 px-4 py-2 border border-gray-300 rounded-md"]) }}>