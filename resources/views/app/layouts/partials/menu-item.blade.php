<div class="menu-item">
    <a class="menu-link" href="{{ route($item->route) }}">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span class="menu-title text-warning">{{ ucwords($item->display_name)}} </span>
    </a>
</div>