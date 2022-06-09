<li class='nav-item'>
    <a href='#' class='nav-link'>
        <p>{{$name}}</p>
    </a>
    <ul class="nav nav-treeview">
        @foreach ($items as $key => $item )
            @if (is_string($key))
                @include("admin.partial.menu.items", ['items' => $item, 'name' => $key])
            @else
                <li class="nav-item">
                    <a href="{{$item['link']}}" class="nav-link">{{$item['name']}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</li>



