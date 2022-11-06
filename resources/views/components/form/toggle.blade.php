<label class="relative flex items-center justify-start space-x-3 text-gray-800 cursor-pointer group" for="toggle{{ $unique }}">
    <div class="relative z-10 w-12 h-6 transition-all duration-200 ease-linear rounded-full
  {{ $property ? ' bg-green-500' : ' bg-lime-200 group-hover:bg-lime-300' }} ">
        <div class="absolute z-0 left-0 w-6 h-6 mb-2 transition-all duration-200 ease-linear transform bg-white border-2 rounded-full {{ $property ? 'translate-x-full border-green-500' : 'translate-x-0 border-lime-200 group-hover:border-lime-300' }} ">
        </div>

        <input {{ $attributes }} type="checkbox" name="toggle{{ $unique }}" id="toggle{{ $unique }}" class="relative z-10 w-full h-full appearance-none cursor-pointer active:outline-none focus:outline-none" />
    </div>
    <div class="text-sm">{{ $lable }}</div>
</label>
