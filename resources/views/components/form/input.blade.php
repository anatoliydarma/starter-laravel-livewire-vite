@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {{  $attributes->merge(['type' => 'text',  'class' => 'form-input text-base placeholder-gray-400 form-input bg-slate-50 border-1 rounded-lg hover:border-slate-300 border-slate-200 focus:outline-none focus:bg-white focus:ring-0'])  }}>
