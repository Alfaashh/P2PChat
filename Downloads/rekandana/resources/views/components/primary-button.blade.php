<button {{ $attributes->merge(['type' => 'submit',
    'class' => 'inline-flex items-center justify-center px-4 py-2 btn-gradient border border-white/10 rounded-md font-semibold text-sm text-white shadow-md hover:scale-[1.02] active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
