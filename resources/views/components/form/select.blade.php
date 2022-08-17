@props(['disabled' => false])
<select {{ $disabled ? 'disabled' : '' }} {{  $attributes->merge(['class' => 'form-select text-base form-input bg-slate-50 border-1 rounded-lg hover:border-slate-300 border-slate-200 focus:outline-none focus:bg-white focus:ring-0'])  }}>
    {{ $slot }}
</select>
