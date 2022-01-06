@extends('user.layouts.page')

{{-- @if($method == 'create') --}}
{{-- @php($action = '#') --}}
{{-- @php($method_field = method_field('POST')) --}}
{{-- @else --}}
{{-- @php($action = '#') --}}
{{-- @php($method_field = method_field('PUT')) --}}
{{-- @endif --}}

{{-- token: String,
name_plane: String,
value_plane: Number,
test_plane: Number,
category: String,
subcategory: String --}}

@section('content')
<checkout-pagseguro csrf={{ csrf_token() }} token="{{ @$ads->token_id }}" ads_id="{{ @$ads->id }}"
    name_plane="{{ @$ads->order_payment->plane->name }}" reference="{{ @$ads->order_payment->plane->reference  }}"
    plane_code="{{ @$ads->order_payment->plane->code }}"
    value_plane="{{ @$ads->order_payment->plane->amount_per_payment }}"
    test_plane="{{ @$ads->order_payment->plane->trial_period_duration }}"
    category="{{ @$ads->subcategory->category->name }}" subcategory="{{ @$ads->subcategory->name }}"
    user="{{ Auth::user() }}">
</checkout-pagseguro>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ PagSeguro::getUrl()['javascript'] }}"></script>
<script>
    $(document).ready(function() {
        console.log(PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}')); //PagSeguroRecorrente tem um método identico,

        // $('#senderHash').val(PagSeguroDirectPayment.getSenderHash());

        // console.log(PagSeguroDirectPayment.getSenderHash())
    })
</script>
@endpush
