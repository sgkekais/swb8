<div {{ $attributes->merge(['class' => 'table w-full']) }}>
    <div class="table-header-group">
        {{ $header }}
    </div>
    <div class="table-row-group">
        {{ $body }}
    </div>
</div>
