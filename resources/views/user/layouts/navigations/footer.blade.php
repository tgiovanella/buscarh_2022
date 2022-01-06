@foreach($links as $link)
    <li class="nav-item"><a clss="nav-link" href="{{ url($link->url) }}">{{ $link->name }}</a></li>
@endforeach
