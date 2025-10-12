<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 btn-ghost rounded-md font-semibold text-xs text-gray-200 tracking-widest hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
