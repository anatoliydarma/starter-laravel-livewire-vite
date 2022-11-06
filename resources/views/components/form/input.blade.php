@props(['disabled' => false])
<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => 'text',  'class' => 'form-input text-base placeholder-gray-400 bg-slate-50/50 border-1 rounded-lg hover:border-slate-300 border-slate-200 focus:outline-none focus:bg-white focus:ring-0 placeholder:text-slate-400 disabled:cursor-not-allowed disabled:bg-slate-50']) }}>
