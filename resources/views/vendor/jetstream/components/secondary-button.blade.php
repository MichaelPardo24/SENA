<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-orange-300 rounded-md font-semibold text-xs text-orange-700 uppercase tracking-widest shadow-sm hover:text-orange-500 focus:outline-none focus:border-orange-300 focus:ring focus:ring-orange-200 active:text-orange-800 active:bg-orange-50 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
