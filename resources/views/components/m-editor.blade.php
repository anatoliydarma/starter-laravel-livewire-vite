@props([
'id' => 'editor-'. str()->random(8),
'height' => '600px',
'name' => null,
'value' => null,
'noMargin' => false,
'readonly' => false,
'disabled' => false,
'toolbar' => true
])

<div wire:ignore class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">
    <div x-data="{
	height: '{{ $height }}',
	tab: 'write',
	@if ($attributes->has('wire:model.defer'))
	 content: @entangle($attributes->wire('model')),
	@else
	 content: {{ collect($value) }},
	@endif
	showConvertedMarkdown: false,
	convertedContent: '',
	convertedMarkdown() {
	 this.showConvertedMarkdown = true;
	 this.convertedContent = md.render(this.content);
	},
	replaceSelectedText(replacementText, newCharactersLength) {
		// 1. obtain the object reference for the textarea
		const textareaRef = this.$refs.input;
		// 2. obtain the index of the first selected character
		let start = textareaRef.selectionStart;
		// 3. obtain the index of the last selected character
		let finish = textareaRef.selectionEnd;
		// 4. obtain all the text content
		const allText = textareaRef.value;
		// 5. Bind 'allText' to the 'content' data object
		this.content = allText.substring(0, start) + replacementText + allText.substring(finish, allText.length);
		// 6. Put the cursor to the end of selected text
		this.$nextTick(() => this.setCursorPosition(this.$refs.input, finish + newCharactersLength));
	},
	setCursorPosition(el, pos) {
	 el.focus();
	 el.setSelectionRange(pos, pos);
	},
	toggleMenu(value) {
		let selectedString = document.getSelection();
		let linkText = selectedString.toString().startsWith('http') ? selectedString : 'Your link';
		switch (value) {
			case 'bold':
			this.replaceSelectedText(`**${selectedString}**`, 4);
			break;
			case 'italic':
			this.replaceSelectedText(`*${selectedString}*`, 2);
			break;
			case 'quote':
			this.replaceSelectedText(`> ${selectedString}`, 2);
			break;
			case 'link':
			this.replaceSelectedText(`[${selectedString}](${linkText})`, 4);
			break;
            case 'footnote':
            this.replaceSelectedText(`${selectedString}[^1]`, 2);
            break;
		}
	},
	}" class="relative" x-cloak wire:ignore>

        <div class="flex items-center pr-4 border border-b-0 text-slate-400 border-slate-300 bg-slate-100 rounded-t-md">
            <div class="flex-1">
                <button type="button" class="inline-block px-4 py-2 font-semibold" :class="{ 'bg-slate-200': tab === 'write' }" x-on:click.prevent="tab = 'write'; showConvertedMarkdown = false">
                    <x-tabler-pencil class="w-5 h-5 text-slate-500 group-hover:text-slate-600 " /></button>
                <button type="button" class="inline-block px-4 py-2 font-semibold" :class="{ 'bg-slate-200': tab === 'preview' && showConvertedMarkdown === true }" x-on:click.prevent="tab = 'preview'; convertedMarkdown()">
                    <x-tabler-eye class="w-5 h-5 text-slate-500 group-hover:text-slate-600 " /></button>
            </div>
            @if ($toolbar)
            <button title="bold" x-tooltip="'bold'" type="button" class="inline-block px-2 py-2 group hover" x-on:click.prevent="toggleMenu('bold')">
                <x-tabler-bold class="w-5 h-5 text-slate-500 group-hover:text-slate-600" />
            </button>
            <button title="italic" x-tooltip="'italic'" type="button" class="inline-block px-2 py-2 group hover" x-on:click.prevent="toggleMenu('italic')">
                <x-tabler-italic class="w-5 h-5 text-slate-500 group-hover:text-slate-600" />
            </button>

            <button title="quote" x-tooltip="'quote'" type="button" class="inline-block px-2 py-2 group hover" x-on:click.prevent="toggleMenu('quote')">
                <x-tabler-quote class="w-5 h-5 text-slate-500 group-hover:text-slate-600 " />
            </button>
            <button title="link" x-tooltip="'link'" type="button" class="inline-block px-2 py-2 group hover" x-on:click.prevent="toggleMenu('link')">
                <x-tabler-link class="w-5 h-5 text-slate-500 group-hover:text-slate-600 " />
            </button>
            <button title="footnote" x-tooltip="'footnote'" type="button" class="inline-block px-2 py-2 group hover" x-on:click.prevent="toggleMenu('footnote')">
                <x-tabler-notes class="w-5 h-5 text-slate-500 group-hover:text-slate-600 " />
            </button>
            @endif

            <div class="relative" x-data="{ open: false }" x-on:click.away="open = false" x-on:close.stop="open = false">
                <button x-tooltip="'Markdown Cheatsheet'" type="button" class="inline-block px-2 py-2 rounded-lg group hover" x-on:click="open = ! open">
                    <x-tabler-info-circle class="w-5 h-5 text-slate-500 group-hover:text-slate-600 " />
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-50 mt-2 -mr-5 origin-top-right rounded-md shadow-lg w-80" style="display: none;" x-on:click="open = false">
                    <div class="p-4 text-sm bg-white rounded-md ring-1 ring-black ring-opacity-5">
                        <div class="px-2 py-1 mb-2 text-xs font-medium tracking-wider text-center text-gray-600 uppercase border border-gray-100 rounded bg-gray-50">Markdown Notes</div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Heading</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">## Heading H2</div>
                        </div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Bold</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">**bold text**</div>
                        </div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Italic</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">*italicized text*</div>
                        </div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Blockquote</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">> blockquote</div>
                        </div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Ordered List</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">
                                1. First <br>
                                2. Second
                            </div>
                        </div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Unordered List</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">
                                - First <br>
                                - Second
                            </div>
                        </div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Horizontal Rule</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">---</div>
                        </div>
                        <div class="flex py-1">
                            <div class="flex-1 flex-shrink-0 pr-5 text-right text-gray-500">Link</div>
                            <div class="flex-1 mt-1 font-mono text-xs text-gray-800">[title](url)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <textarea spellcheck="false" x-show="! showConvertedMarkdown" id="{{ $id }}" x-ref="input" x-model="content" name="{{ $name }}" class="relative block w-full px-5 py-6 overflow-y-auto font-mono text-sm text-gray-700 transition duration-150 ease-in-out border resize-none bg-slate-50 focus:bg-white border-slate-300 form-textarea rounded-b-md focus:outline-none focus:border-slate-500 focus:ring-1 focus:ring-slate-500" :style="`height: ${height}; max-width: 100%`" data-enable-grammarly="false"></textarea>

        <div x-show="showConvertedMarkdown">
            <div x-html="convertedContent" class="w-full p-5 overflow-y-auto leading-6 prose bg-white border shadow-sm border-slate-300 max-w-none prose-indigo rounded-b-md" :style="`height: ${height}; max-width: 100%`"></div>
        </div>
    </div>

</div>
