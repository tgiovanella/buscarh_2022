@if($method == 'create')
@php($action = route('admin.ads.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.ads.update',$ad))
@php($method_field = method_field('PUT'))
@endif


@push('scripts')
<script>
    $(document).ready(function() {



        //configura as medidas do banners
        $('#advert_configuration_id').change(function() {
            let width = $(this).find(':selected').data('width');
            let height = $(this).find(':selected').data('height');

            $('#width-file').html(width);
            $('#height-file').html(height);
        })

        //remove
        $('#btnDeleteFile').click(function () {


            var data = {
                id : $('#imgBanner').data('ad'),
                banner_id : $('#imgBanner').data('id'),
                _token : $('[name=_token]').val(),
            };

            console.log(data);

            $.ajax({
                type: 'POST',
                url: '/admin/ads/' + data.id + '/remove-file',
                data: data,
                dataType: 'json'
            }).done(function (status) {
                console.log(status);

                if(!status.error) {
                    $('#rowImgBanner').hide();
                    $('#rowBanner').show();
                    $('#banner').prop('required',true);
                }


            }).fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });

        });


        //empresa localiza
        $('.select-ajax-companies').select2({
            ajax: {
                url: function (params) {
                    // console.log(params.term);
                    return '/api/companies-like/' + params.term;
                },
                processResults: function(data) {
                    // console.log(data);
                    return {
                        results: data
                    }
                }
            }
        });

        $('#company_id').change(function(){
            let company_id = $(this).val();


            // companies/{id}

            $.ajax({
                type: 'GET',
                url: '/api/companies/' + company_id,
                // data: data,
                dataType: 'json'
            }).done(function (status) {
                console.log(status);

                $('#email_payment').val(status.email);
                $('#responsible_payment').val(status.responsible);

                // if(!status.error) {
                //     $('#rowImgBanner').hide();
                //     $('#rowBanner').show();
                //     $('#banner').prop('required',true);
                // }


            }).fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });

        });

        $('input[name=has_company]').change(function() {
            let has_company = $(this).val();

            console.log(has_company);

            if(has_company == 1) {
                $('.group-company').show();
            } else {
                $('.group-company').hide();
            }

        })

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

<form data-toggle="validator" id="frmAds" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}

    <div class="row">
        <div class="col-md-12">
            <label for="">Configuração de Anúncio</label>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px;">
        @forelse ($ads_config as $item)
        <div class="col-md-3">
            <label class="text-center">
                <input type="radio" class="radio-image" name="advert_configuration_id" value="{{ $item->id }}"
                    @if($item->id==$ad->advert_configuration_id)
                checked @endif>
                <img src="{{ asset(config('myconfig.img_type_ads.'.$item->type)) }}" class="img-responsive">
                {{ $item->title }}
            </label>
        </div>
        @empty

        @endforelse
        <div class="help-block with-errors">{{ $errors->first('advert_configuration_id') }}</div>

    </div>


    {{-- <div class="row">

        <div class="form-group col-md-6 @if($errors->has('advert_configuration_id')) has-error @endif">
            <label for="page_block_id">Configuração de Anúncio</label>
            <select class="form-control" name="advert_configuration_id" id="advert_configuration_id">
                <option value="">-- selecione um bloco --</option>
                @forelse ($ads_config as $item)
                <option value="{{ $item->id }}" @if($item->id ==
    old('advert_configuration_id',$ad->advert_configuration_id)) selected @endif
    data-width="{{ $item->width }}" data-height="{{ $item->height }}">
    {{ $item->title }} - {{ $item->value }} R$/mês - {{ config('myconfig.type_ads.'.$item->type) }}
    </option>
    @empty

    @endforelse
    </select>
    <div class="help-block with-errors">{{ $errors->first('advert_configuration_id') }}</div>

    </div>
    </div> --}}


    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('title')) has-error @endif">
            <label for="title">{{ __('Título') }}</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $ad->title) }}"
                placeholder="{{ __('Insira o titulo do anúncio') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('title') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('description')) has-error @endif">
            <label for="description">{{ __('Descrição/Observação') }}</label>

            <textarea class="form-control" placeholder="{{ __('Insira o conteúdo da página') }}" name="description"
                id="description">{!! old('description', $ad->description) !!}</textarea>
            <div class="help-block with-errors">{{ $errors->first('description') }}</div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('url')) has-error @endif">
            <label for="name">{{ __('URL (site que será direcionado)') }}</label>
            <input type="url" name="site" id="site" class="form-control" value="{{ old('site', $ad->site) }}"
                placeholder="{{ __('Insira a URL') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('site') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('categories')) has-error @endif">
            <label for="uf">{{ __('general.categories') }}</label>
            <select class="form-control js-select2" name="subcategory_id" id="subcategory_id"
                required>

                <option value="">-- selecione uma subcategoria --</option>

                @forelse($categories as $subcategories)
                <optgroup label="{{$subcategories->name}}">
                    @foreach($subcategories->subcategories as $item)
                    <option value="{{ $item->id }}" @if($item->id == $ad->subcategory_id) selected
                        @endif>{{ $item->name }}</option>
                    @endforeach
                </optgroup>
                @empty

                @endforelse
            </select>
            <div class="help-block with-errors">{{ $errors->first('city_id') }}</div>
        </div>
    </div>



    @if($ad->file_id)
    <div class="row" id="rowImgBanner">
        <div class="form-group col-md-12 @if($errors->has('banner')) has-error @endif">
            <label for="banner">{{ __('Banner') }}</label>
            <img src="{{ asset( @$ad->file->path ) }}" alt="{{ @$ad->file->path }}" id="imgBanner"
                style="width: 25%; display: block; margin-bottom: 5px; " class="mb-3 img-thumbnail"
                data-id="{{ $ad->file_id}}" data-ad="{{ $ad->id}}">

            <p>
                <button type="button" class="btn btn-sm" name="delete" id="btnDeleteFile"><i class="fa fa-remove"></i>
                    Remove</button>
            </p>
        </div>
    </div>
    @endif

    {{-- fazer isso no jquery depois --}}
    @if($ad->type != 5)
    <div class="row" id="rowBanner" style="@if($ad->file_id) display:none @endif">
        <div class="form-group col-md-12 @if($errors->has('banner')) has-error @endif">
            <label for="banner">{{ __('Banner') }}</label>
            <input type="file" id="banner" name="banner" @if(!$ad->file_id) required @endif >
            <p class="help-block">{!! __('messages.file_image') !!}</p>
            <div class="help-block with-errors">{{ $errors->first('banner') }}</div>
        </div>
    </div>
    @endif


    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Configurações de Empresa </legend>


        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12 form-group @if($errors->has('has_company')) has-error @endif"">
                    <label for=" has_company">Deseja Vincular uma Empresa?</label>
                <div class="form-check  form-check-inline">

                    @foreach(config('myconfig.yes_no') as $key => $item)
                    <label class="form-check-label" style="margin-right: 10px;">
                        <input class="form-check-input" type="radio" name="has_company" id="has_company{{ $key }}"
                            value="{{ $key }}" @if($key==$ad->has_company || (!isset($ad->has_company) && $key == 1))
                        checked @endif required>
                        {{ $item }}
                    </label>
                    @endforeach

                </div>
                <div class="help-block with-errors">{{ $errors->first('status') }}</div>
            </div>
        </div>

        <div class="row group-company" @if($ad->
            has_company !=
            1)
            style="display:none" @endif>
            <div class="form-group  col-md-12 @if($errors->has('company_id')) has-error @endif">
                <label for="uf">{{ __('Buscar Empresa') }}</label>
                <select class="form-control select-ajax-companies col-md-12" name="company_id" id="company_id">
                    @if(isset($ad->company))
                    <option value="{{ @$ad->company_id }}" selected>{{ @$ad->company->name }} - CNPJ:
                        {{ @$ad->company->cpf_cnpj }} - Cidade/UF:
                        {{ @$ad->company->city->title }}/{{ @$ad->company->uf }}
                    <option>
                        @endif
                </select>
                <div class="help-block with-errors">{{ $errors->first('company_id') }}</div>
            </div>
        </div>



        <div class="row">
            <div class="form-group col-md-5 @if($errors->has('email_payment')) has-error @endif">
                <label for="email_payment">{{ __('Email de Cobrança') }}</label>
                <input type="email" name="email_payment" id="email_payment" class="form-control"
                    value="{{ old('email_payment', $ad->email_payment) }}" placeholder="{{ __('Insira a Email') }}"
                    maxlength="191" required>
                <div class="help-block with-errors">{{ $errors->first('email_payment') }}</div>
            </div>

            <div class="form-group col-md-4 @if($errors->has('responsible_payment')) has-error @endif">
                <label for="responsible_payment">{{ __('Responsável Financeiro') }}</label>
                <input type="text" name="responsible_payment" id="responsible_payment" class="form-control"
                    value="{{ old('responsible_payment', $ad->responsible_payment) }}"
                    placeholder="{{ __('Responsável Financeiro') }}" maxlength="191" required>
                <div class="help-block with-errors">{{ $errors->first('responsible_payment') }}</div>
            </div>

            <div class="form-group col-md-3 @if($errors->has('phone')) has-error @endif">
                <label for="phone">{{ __('Telefone do Responsável') }}</label>
                <input type="text" name="phone" id="responsible_payment" class="form-control"
                    value="{{ old('phone', $ad->phone) }}" placeholder="{{ __('Telefone do Responsável') }}"
                    maxlength="191" required>
                <div class="help-block with-errors">{{ $errors->first('phone') }}</div>
            </div>
        </div>



    </fieldset>



    <div class="row" style="margin-bottom: 10px;">

        <div class="col-md-12 form-group @if($errors->has('status')) has-error @endif"">
            <label for=" status">Status</label>
            <div class="form-check  form-check-inline">

                @foreach(config('myconfig.status_ads') as $key => $item)
                <label class="form-check-label" style="margin-right: 10px;">
                    <input class="form-check-input" type="radio" name="status" id="status" value="{{ $key }}"
                        @if($key==$ad->status || (!isset($ad->status) && $key == 1)) checked @endif required>
                    {{ $item }}
                </label>
                @endforeach

            </div>
            <div class="help-block with-errors">{{ $errors->first('status') }}</div>
        </div>

    </div>


    <input type="hidden" name="type_submit" id="type_submit" value="">


    <div class="row">
        <div class="form-group col-md-12">
            <a href="{{ url()->previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                Cancelar</a>
            <button type="submit" id="save" class="btn btn-success"><i class="fa fa-save"></i>
                Salvar</button>
            <button type="submit" id="payment" class="btn btn-primary"><i class="fa fa-envelope"></i> Salvar e
                Faturar</button>
        </div>
    </div>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Configurações de Assinatura/Planos</legend>
        <div class="row">
            <div class="col-md-12">

                @if($ad->order_payment)
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Plano</th>
                            <th>Período</th>
                            <th>Período de Teste</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ @$ad->order_payment->plane->name }}</td>
                            <td>{{ __('messages.'.$ad->order_payment->plane->period) }}</td>
                            <td>@if($ad->order_payment->trial_expired_at)
                                {{ convertDate($ad->order_payment->trial_expired_at) }} @endif</td>
                            <td>R$ {{ @$ad->order_payment->plane->amount_per_payment }}</td>


                        </tr>
                    </tbody>
                </table>
                @else
                @alert(['type' => 'warning'])
                O anúncio ainda <b>não foi faturado</b>. Clique em Faturar para gerar o link de pagamento e encaminhar
                ao
                cliente.
                @endalert
                @endif
            </div>
        </div>

    </fieldset>

</form>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#save').click(function(event) {
            event.preventDefault();
            $('#type_submit').val('save');
            $('form#frmAds').submit();
        });

        $('#payment').click(function(event) {
            event.preventDefault();
            $('#type_submit').val('payment');
            $('form#frmAds').submit();
        });
    });
</script>
@endpush
