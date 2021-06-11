<div {{ $attributes->merge(['class' => 'table']) }}>
    <div class="table-header-group sticky top-0 bg-white">
        {{ $header }}
    </div>
    <div class="table-row-group">
        {{ $body }}
    </div>
</div>
