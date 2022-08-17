@props(['disabled' => false, 'rows' => '4'])
<textarea {{ $disabled ? 'disabled' : '' }} {{  $attributes->merge(['type' => 'text',  'class' => 'w-full text-base placeholder-gray-400 form-textarea form-input bg-slate-50 border-1 rounded-lg hover:border-slate-300 border-slate-200 focus:outline-none focus:bg-white focus:ring-0'])  }} rows="{{ $rows }}"></textarea>
