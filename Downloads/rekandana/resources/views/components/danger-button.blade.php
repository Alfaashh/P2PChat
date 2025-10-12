<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-rose-600 to-red-600 border border-white/10 rounded-md font-semibold text-sm text-white shadow-md hover:from-rose-500 hover:to-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
