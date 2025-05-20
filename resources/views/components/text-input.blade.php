@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 
        'border-gray-300 border-gray-700 bg-white text-black border-yellow-500 border-yellow-600 ring-yellow-500 ring-yellow-600 rounded-md shadow-sm'
    ]) }}>
