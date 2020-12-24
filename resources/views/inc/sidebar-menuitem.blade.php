<li class="nav-main-item">
    <a class="nav-main-link{{ request()->is($routename) ? ' active' : '' }}" href="{{ $url }}">
        <i class="nav-main-link-icon {{ $icon ?? 'si si-cursor' }}"></i>
        <span class="nav-main-link-name">{{ $title  }}</span>
    </a>
</li>