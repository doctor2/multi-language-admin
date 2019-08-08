<div class="col-md-3">
    @foreach($laravelAdminMenus as $section)
        @if($section->getItems())
            <div class="card">
                <div class="card-header">
                    {{ $section->getSection() }}
                </div>

                <div class="card-body">
                    <ul class="nav flex-column nav-pills" role="tablist">
                        @foreach($section->getItems() as $menu)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($menu->isActive()) active @endif" href="{{ $menu->getUrl() }}">
                                    {{ $menu->getTitle() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br/>
        @endif
    @endforeach
</div>
