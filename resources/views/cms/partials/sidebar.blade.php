<nav class="sidebar sidebar-offcanvas" id="sidebar" wire:ignore>
    <ul class="nav">

      @foreach (config('cms_menu.cms') as $item)
      @if (count($item['childern'])>0 && Auth::guard('cms')->user()->hasAnyPermission(explode('|',$item['permission'])))
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#{{ Str::slug($item['title']) }}" aria-expanded="false" aria-controls="{{ Str::slug($item['title']) }}">
            <i class="{{ $item['icon'] }} menu-icon icon-grid" style="margin-right: 1rem!important"></i>
            <span class="menu-title">{{ $item['title'] }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="{{ Str::slug($item['title']) }}">
            <ul class="nav flex-column sub-menu">
                @foreach ($item['childern'] as $child)
                    @if (Auth::guard('cms')->user()->can($child['permission']))
                        <li class="nav-item"> <a class="nav-link" href="{{ $child['url'] }}">{{ $child['title'] }}</a></li>
                    @endif
                @endforeach
                </ul>
              </div>
            </li>
        @else
            @if (Auth::guard('cms')->user()->can($item['permission']))
                <li class="nav-item">
                <a class="nav-link" href="{{ $item['url'] }}">
                    <i class="{{ $item['icon']  }} menu-icon icon-grid"  style="margin-right: 1rem!important"></i>
                    <span class="menu-title">{{ $item['title'] }}</span>
                </a>
                </li>
            @endif
        @endif
      @endforeach
    </ul>
  </nav>
