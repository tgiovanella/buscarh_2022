@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-sm-12">
                <h1>{{ $page->title }}</h1>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                {!! $page->body !!}
            </div>
        </div>

    </div>
</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function () {



});
</script>
@endpush
