<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#2f6d59] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#3C8C73] active:bg-[#3C8C73] focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-250']) }}>
    {{ $slot }}
</button>
