<a {{ $attributes->merge([
        'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 bg-white text-gray-700 hover:bg-blue-200 focus:outline-none focus:bg-blue-100 transition duration-150 ease-in-out',
        'style' => 'bottom: 100%;'
    ]) }}>
    {{ $slot }}
</a>
