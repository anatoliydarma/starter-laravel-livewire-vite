<label for="{{ $for }}" class=" bg-lime-50 flex items-center p-2 rounded-lg cursor-pointer">
    <input {{ $attributes }} id="{{ $for }}" name="radio" type="radio" checked class="form-radio text-lime-400 focus:ring-lime-300 border-lime-200 w-4 h-4">
    <span class="block ml-2 text-sm font-medium text-gray-700">{{ $label }}</span>
</label>
