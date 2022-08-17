@props(['key' => 1])
<div x-data="{
content: @entangle($attributes->whereStartsWith('wire:model')->first()).defer }" x-init="editor = new Editor({
            el: document.getElementById('editor{{ $key }}'), height: '400px' , initialEditType: 'wysiwyg' ,
            previewStyle: 'vertical' , usageStatistics: false, initialValue: content, language: 'ru-RU' , toolbarItems: [
            ['heading', 'bold' , 'italic' ], ['hr', 'quote' ], ['ul', 'ol' , 'indent' , 'outdent' ], ['table', 'image' , 'link'
            ],],
            events: {
                change: function() {
                 content = editor.getMarkdown();
                }
            },
            });" wire:ignore class="relative">
    <div class="absolute z-40 top-2 right-4">
        <x-dashboard.file-manager />
    </div>
    <div id="editor{{ $key }}" class="block w-full rounded-lg border-slate-300"></div>

    @once
    @push('header-js')
    <script type="text/javascript" src="/js/editor.js"></script>
    @endpush
    @endonce
</div>
