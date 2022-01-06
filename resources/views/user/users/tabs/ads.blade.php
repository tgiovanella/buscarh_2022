@if(count($user->ads))
<div class="row">
    <div class="col">
        <a href="{{ route('user.ads.create') }}" class="btn btn-primary mb-3 pull-right"><i class="fa fa-plus-circle"
                aria-hidden="true"></i>
            Anunciar</a>
    </div>
</div>

<table class="table table-striped table-hover table-sm">
    <thead>
        <tr>
            <th>Data</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th class="text-center">Posição</th>
            <th>URL</th>
            <th class="text-center">Status</th>
            <th class="text-center"></th>
            <th class="text-center" style="width: 10%">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->ads as $item)
        <tr>
            <td>{{ convertDate($item->created_at) }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ @$item->configuration->title }}</td>
            <td class="text-center">
                <img src="{{ asset(config('myconfig.img_type_ads.'.@$item->configuration->type)) }}" class="text-center"
                    width="30px"></td>
            <td>{{ $item->site }}</td>
            <td class="text-center">{!! labels_status_ads($item->status) !!}</td>

            <td class="text-center">
                @if($item->status == App\Advert::STATUS_APPROVED)
                <a href="{{ route('user.checkout.create',md5($item->id) . '-' . $item->token_id . '-' . md5(date('dmyHsi')) ) }}"
                    style=" " class="btn btn-success btn-sm"><i class="fa fa-money" aria-hidden="true"></i> Pagar</a>

                @endif
            </td>

            <td class="text-center">
                @actions(['item'=>$item, 'user' => true, 'route' => 'user.users.ads','btns' => 'edit'])
                {{-- botão de ação --}}
                @endactions()
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@else
<div class="alert alert-warning" role="alert">
    Não existem anúncios cadastradas.
</div>
@endif


@push('styles')
<style>
    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: bold;
        line-height: 1;
        color: @label-color;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }


    .label-default {
        background: #6c757d;
        color: #f8f9fa;
    }

    .label-primary {
        background: #007bff;
        color: #f8f9fa;

    }

    .label-success {
        background: #28a745;
        color: #f8f9fa;

    }

    .label-info {
        background: #17a2b8;
        color: #f8f9fa;

    }

    .label-warning {
        background: #ffc107;
    }

    .label-danger {
        background: #dc3545;
        color: #f8f9fa;

    }
</style>

@endpush
