@foreach($links as $link)
    <a class="dropdown-item" href="{{ url($link->url) }}">{{ $link->name }}</a>
@endforeach
