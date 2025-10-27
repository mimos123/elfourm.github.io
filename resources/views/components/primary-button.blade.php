<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150'
    ]) }}>
    {{ $slot }}
</button>
