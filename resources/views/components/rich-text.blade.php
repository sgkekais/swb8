{{--@push('scripts')--}}
{{--    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>--}}
{{--@endpush--}}

@props(
    ['initialValue' => '']
)

{{--<div x-data="{textEditor:@entangle($attributes->wire('model'))}"--}}
{{--     x-init="()=>{var element = document.querySelector('trix-editor');--}}
{{--                element.editor.insertHTML(textEditor);}"--}}
{{--     wire:ignore>--}}

{{--    <input x-ref="editor"--}}
{{--           id="editor-x"--}}
{{--           type="hidden"--}}
{{--           name="content">--}}

{{--    <trix-editor  input="editor-x"--}}
{{--                  x-on:trix-change="textEditor=$refs.editor.value;"--}}
{{--    ></trix-editor>--}}
{{--</div>--}}

<div
    wire:ignore
    {{ $attributes }}
    x-data
    @trix-blur = "$dispatch('change', $event.target.value)"
>
    <input id="x" value="{{ $initialValue->match_details }}" type="hidden">
    <trix-editor input="x" class="trix-content"></trix-editor>
</div>


