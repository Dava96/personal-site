<div class=" flex justify-end">
    <button {{$attributes(['class' => 'bg-gray-700 text-white font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-800',
                    'type' => 'submit'])}}>
        {{$slot}}
    </button>
</div>
