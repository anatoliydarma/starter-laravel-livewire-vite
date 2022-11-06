@props(['for'])
@error($for)
<span {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>
    {{ $message }}
</span>
@enderror
