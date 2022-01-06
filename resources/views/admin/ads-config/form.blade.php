@if($method == 'create')
@php($action = route('admin.ads-config.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.ads-config.update',$ads_config))
@php($method_field = method_field('PUT'))
@endif


@push('scripts')
<script>
    $(document).ready(function() {
        //busca cidade
    });
</script>
@endpush

@push('styles')
<style>
    /* HIDE RADIO */
    [type=radio].radio-image {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio].radio-image+img {
        cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio].radio-image:checked+img {
        outline: 2px solid #f00;
    }
</style>
@endpush



<form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('title')) has-error @endif">
            <label for="title">{{ __('Título') }}</label>
            <input type="text" name="title" id="title" class="form-control"
                value="{{ old('title', $ads_config->title) }}" placeholder="{{ __('Insira o título') }}" maxlength="191"
                required>
            <div class="help-block with-errors">{{ $errors->first('title') }}</div>
        </div>
    </div>

    {{-- 'type_ads' => [
    1 => 'Slide com logo',
    2 => 'Nuvem de logo',
    3 => 'Banners full por categoria',
    4 => 'Banner a direita'
    ],

    //TIPO
    const TYPE_SLIDE = 1;
    const TYPE_CLOUD = 2;
    const TYPE_FULL = 3;
    const TYPE_SIDEBAR = 4; --}}

    <div class="row">
        <div class="col-md-12">
            <label>Tipo do Anúncio</label>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-3">
            <label class="text-center">
                <input type="radio" class="radio-image" name="type" value="{{ App\Advert::TYPE_FULL }}"
                    @if(App\Advert::TYPE_FULL==$ads_config->type)
                checked @endif>
                <img src="{{ asset(config('myconfig.img_type_ads.'.App\Advert::TYPE_FULL)) }}" class="img-responsive">
                Banner Full
            </label>
        </div>

        <div class="col-md-3">
            <label class="text-center">
                <input type="radio" class="radio-image" name="type" value="{{ App\Advert::TYPE_SLIDE }}"
                    @if(App\Advert::TYPE_SLIDE==$ads_config->type)
                checked @endif>
                <img src="{{ asset(config('myconfig.img_type_ads.'.App\Advert::TYPE_SLIDE)) }}" class="img-responsive">
                Slide Logo
            </label>
        </div>

        <div class="col-md-3">
            <label class="text-center">
                <input type="radio" class="radio-image" name="type" value="{{ App\Advert::TYPE_CLOUD }}"
                    @if(App\Advert::TYPE_CLOUD==$ads_config->type)
                checked @endif>
                <img src="{{ asset(config('myconfig.img_type_ads.'.App\Advert::TYPE_CLOUD)) }}" class="img-responsive">
                Nuvem de Logo
            </label>
        </div>

        <div class="col-md-3">
            <label class="text-center">
                <input type="radio" class="radio-image" name="type" value="{{ App\Advert::TYPE_SIDEBAR }}"
                    @if(App\Advert::TYPE_SIDEBAR==$ads_config->type)
                checked @endif>
                <img src="{{ asset(config('myconfig.img_type_ads.'.App\Advert::TYPE_SIDEBAR)) }}"
                    class="img-responsive">
                Logo Sidebar
            </label>
        </div>

        <div class="col-md-3">
            <label class="text-center">
                <input type="radio" class="radio-image" name="type" value="{{ App\Advert::TYPE_HIGHLIGHT }}"
                    @if(App\Advert::TYPE_HIGHLIGHT==$ads_config->type)
                checked @endif>
                <img src="{{ asset(config('myconfig.img_type_ads.'.App\Advert::TYPE_HIGHLIGHT)) }}"
                    class="img-responsive">
                Destaque
            </label>
        </div>
    </div>

    {{-- <div class="row">
        <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
            <label for="type">Tipo do Anúncio</label>
            <select class="form-control" name="type" id="type" required>
                <option value="">-- selecione um bloco --</option>
                @forelse (config('myconfig.type_ads') as $key => $item)
                <option value="{{ $key }}" @if($key==$ads_config->type) selected @endif>{{ $item }}</option>
    @empty

    @endforelse
    </select>
    <div class="help-block with-errors">{{ $errors->first('type') }}</div>
    </div>
    </div> --}}

    {{-- <div class="row">
        <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
            <label for="position">Posição do Anúncio</label>
            <select class="form-control" name="position" id="position" required>
                <option value="">-- selecione um bloco --</option>
                @forelse (config('myconfig.position_ads') as $key => $item)
                <option value="{{ $key }}" @if($key==$ads_config->position) selected @endif>{{ $item }}</option>
    @empty

    @endforelse
    </select>
    <div class="help-block with-errors">{{ $errors->first('position') }}</div>
    </div>
    </div> --}}


    <div class="row">
        <div class="form-group col-md-3 @if($errors->has('amount')) has-error @endif">
            <label for="amount">{{ __('Quantidade Máxima de Anúncios') }}</label>
            <input type="text" name="amount" id="amount" class="form-control"
                value="{{ old('amount', $ads_config->amount) }}" placeholder="{{ __('Insira a quantidade máxima') }}"
                maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('amount') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3 @if($errors->has('height')) has-error @endif">
            <label for="height">{{ __('Altura') }}</label>
            <input type="number" name="height" id="height" class="form-control"
                value="{{ old('height', $ads_config->height) }}"
                placeholder="{{ __('Insira a altura máxima do banner') }}" maxlength="191" min="1" required>
            <div class="help-block with-errors">{{ $errors->first('height') }}</div>
        </div>

        <div class="form-group col-md-3 @if($errors->has('width')) has-error @endif">
            <label for="width">{{ __('Largura') }}</label>
            <input type="number" name="width" id="width" class="form-control"
                value="{{ old('width', $ads_config->width) }}"
                placeholder="{{ __('Insira a largura máxima do banner') }}" maxlength="191" min="1" required>
            <div class="help-block with-errors">{{ $errors->first('width') }}</div>
        </div>
    </div>




    <div class="row">
        <div class="form-group col-md-12 @if($errors->has('plane_id')) has-error @endif">
            <label for="plane_id">Plano de Assinatura</label>
            <select class="form-control" name="plane_id" id="plane_id" required>
                <option value="">-- selecione um plano --</option>
                @forelse ($planes as $key => $item)
                <option value="{{ $item->id }}" @if($item->id==$ads_config->plane_id) selected @endif>{{ $item->name }}
                    -
                    {{ $item->amount_per_payment }} R$ {{ __('general.planes.'. $item->period) }} com
                    {{ $item->trial_period_duration }} dias de teste.</option>
                @empty

                @endforelse
            </select>
            <div class="help-block with-errors">{{ $errors->first('position') }}</div>
        </div>
    </div>


    <div class="row" style="margin-bottom: 10px;">

        <div class="col-md-12 form-group @if($errors->has('status')) has-error @endif"">
            <label for=" status">Status</label>
            <div class="form-check  form-check-inline">
                <label class="form-check-label" style="margin-right: 10px;">
                    <input class="form-check-input" type="radio" name="status" id="status" value="1"
                        @if($ads_config->status == 1) checked @endif required> Ativo
                </label>

                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="status" id="status" value="0"
                        @if($ads_config->status ==
                    0 && isset($ads_config->status)) checked @endif required> Inativo
                </label>
            </div>
            <div class="help-block with-errors">{{ $errors->first('status') }}</div>
        </div>

    </div>


    <div class="row">
        <div class="form-group col-md-12">
            <a href="{{ url()->previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                Cancelar</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
        </div>
    </div>

</form>
