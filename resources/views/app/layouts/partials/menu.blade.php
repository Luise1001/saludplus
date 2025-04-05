<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="{{ $permissions->first()->menu->icon }} fs-2">
                @for ($i = 1; $i < $permissions->first()->menu->icon_items; $i++)
                    <span class="path{{ $i }}"></span>
                @endfor
            </i>
        </span>
        <span class="menu-title">{{ Str::upper($permissions->first()->menu->name) }} </span>
        <span class="menu-arrow"></span>
    </span>

    <div class="menu-sub menu-sub-accordion">
        @foreach ($permissions as $item)
            @include('app.layouts.partials.menu-item', [
                'item' => $item,
            ])
        @endforeach
    </div>
</div>
