@props([
'data' => [],
'inputId' => 'tagify',
'editTags' => false,
'noNewTags' => true,
'max' => 10,
])
<div x-data="tagify{{ $inputId }}">
    <div wire:ignore x-on:change="selected = $event.target.value">
        <input id="tagify-{{ $inputId }}" type="text" x-bind:value="selected" class="w-full text-sm rounded-lg border-slate-300 form-input focus:ring focus:ring-blue-400 bg-slate-50">
    </div>
    @once
    @push('header')
    <link rel="stylesheet" href="https://unpkg.com/@yaireo/tagify/dist/tagify.css">
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    @endpush
    @endonce
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tagify{{ $inputId }}', () => ({
                selected: @entangle($attributes - > wire('model'))
                , tagify: null
                , whitelist: @js($data)
                , init() {
                    var inputElm = document.getElementById('tagify-{{ $inputId }}');
                    this.tagify = new Tagify(inputElm, {
                        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                        , whitelist: this.whitelist
                        , dropdown: {
                            classname: "w-full"
                            , enabled: 0
                            , maxItems: 100
                            , position: "all"
                            , closeOnSelect: true
                            , highlightFirst: true
                            , fuzzySearch: true
                        , }
                        , addTagOnBlur: false
                        , editTags: @js($editTags)
                        , maxTags: @js($max)
                        , skipInvalid: true
                        , enforceWhitelist: @js($noNewTags)
                    });
                }
            , }))
        })
    </script>
</div>
