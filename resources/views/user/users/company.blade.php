@extends('user.layouts.page')

@if($method == 'create')
@php($action = route('user.users.company.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('user.users.company.update',$company))
@php($method_field = method_field('PUT'))
@endif

@push('scripts')
<script>
    $(document).ready(function() {
            //busca cidade

            //ao trocar a uf muda  o conjunto de cidades
            $('#uf').change(function() {

                let uf = $(this).val();

                $.ajax({
                    type: "get",
                    url: "/api/cities/" + uf,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        $('#city_id').empty();
                        $("#city_id").append('<option>-- selecione uma cidade --</option>');
                        // $.each(response,function(key,value){
                        //     $("#city").append('<option value="'+vale.id+'">'+value.title+'</option>');
                        // });
                        $(response).each(function(index) {
                            console.log(response[index]);
                            $("#city_id").append('<option value="'+response[index].id+'">'+response[index].title+'</option>');

                        });

                    }
                });

            });


            $('.select-ajax-cities').select2({
                ajax: {
                    url: function (params) {
                        console.log(params.term);
                        return '/api/cities-like/' + params.term;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        }
                    }
                }
            });

        $(document).ready(function() {
            $('.js-select2').select2();
        });


    });
</script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Cadastro de Empresa</h2>
        <hr>

        <form data-toggle="validator" role="form" class="form" action="{{ $action }}" method="post"
            id="registrationForm">

            {{ $method_field }}
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="control-label font-weight-bold">
                            Razão Social <span class="required" title="Obrigatório">*</span>
                        </label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Razão social"
                            title="Entre com a razão social." value="{{ old('name',$company->name) }}" required
                            autofocus>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fantasy" class="control-label font-weight-bold">
                            Nome Fantasia <span class="required" title="Obrigatório">*</span>
                        </label>
                        <input type="text" class="form-control" name="fantasy" id="fantasy" placeholder="Seu nome"
                            title="Entre com o nome fantasia." value="{{ old('fantasy',$company->fantasy) }}" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cpf_cnpj" class="control-label font-weight-bold">
                            CPF/CNPJ <span class="required" title="Obrigatório">*</span>
                        </label>
                        <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" placeholder="CPF/CNPJ"
                            title="Entre com o CPF/CNPJ." value="{{ old('cpf_cnpj',$company->cpf_cnpj) }}" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cpf_cnpj" class="control-label font-weight-bold">
                            Categoria
                        </label>
                        <select class="js-example-basic-multiple form-control" name="subcategory_id[]"
                            id="subcategory_id" multiple="multiple" required>

                            @forelse($categories as $subcategories)
                            <optgroup label="{{$subcategories->name}}">
                                @foreach($subcategories->subcategories as $item)
                                <option value="{{ $item->id }}" @if(in_array($item->id,$subcategories_selected))
                                    selected
                                    @endif>{{ $item->name }}</option>
                                @endforeach
                            </optgroup>
                            @empty

                            @endforelse
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 @if($errors->has('operation_uf')) has-error @endif">
                    <label for="uf">{{ __('UF(s) de Atuação') }}</label>




                    <select class="form-control js-select2" name="operation_uf[]" id="operation_uf" multiple="multiple"
                        required>
                        @foreach($ufs as $item)
                        <option value="{{ $item->id }}"  @if(in_array($item->id,$operation_ufs)) selected
                            @endif>{{ $item->letter }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors">{{ $errors->first('city_id') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 @if($errors->has('operation_city')) has-error @endif">
                    <label for="uf">{{ __('Cidades de Atuação') }}</label>


                    <select class="form-control select-ajax-cities" name="operation_city[]" id="operation_city"
                        multiple="multiple">
                        @forelse ($company->operation_cities as $city)
                        <option value="{{ $city->id }}" selected>
                            {{ $city->title }}/{{ $city->state->letter }}</option>
                        @empty

                        @endforelse
                    </select>
                    <div class="help-block with-errors">{{ $errors->first('city_id') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cpf_cnpj" class="control-label font-weight-bold">
                            Site
                        </label>
                        <input type="url" class="form-control" name="site" id="site" placeholder="Site"
                            title="Entre com o site." value="{{ old('site',$company->site) }}">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="phone" class="control-label font-weight-bold">
                            Telefone
                        </label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Telefone"
                            title="Entre com o telefone." value="{{ old('phone',$company->phone) }}">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cep" class="control-label font-weight-bold">
                            CEP
                        </label>
                        <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP"
                            title="Entre com o CEP." value="{{ old('cep',$company->cep) }}">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3 @if($errors->has('uf')) has-error @endif">
                    <label for="uf">{{ __('general.uf') }}</label>
                    <select name="uf" id="uf" class="form-control" required>
                        <option value="">-- Selecione um UF --</option>
                        @forelse ($ufs as $uf)
                        <option value="{{ $uf->id }}"
                            {{ old('uf', @$company->city->state->id) == $uf->id ? 'selected' : '' }}>
                            {{ $uf->letter }}</option>
                        @empty

                        @endforelse
                    </select>
                    <div class="help-block with-errors">{{ $errors->first('uf') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 @if($errors->has('city_id')) has-error @endif">
                    <label for="uf">{{ __('general.city_id') }}</label>
                    <select name="city_id" id="city_id" class="form-control js-select2" required>
                        <option value="">-- Selecione uma cidade --</option>
                        @forelse ($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ old('city_id', $company->city_id) == $city->id ? 'selected' : '' }}>
                            {{ $city->title }}</option>
                        @empty

                        @endforelse
                    </select>
                    <div class="help-block with-errors">{{ $errors->first('city_id') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 @if($errors->has('address')) has-error @endif">
                    <label for="address">{{ __('general.address') }}</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ old('address', $company->address) }}" placeholder="" maxlength="191" required>
                    <div class="help-block with-errors">{{ $errors->first('address') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 @if($errors->has('number')) has-error @endif">
                    <label for="number">{{ __('general.number') }}</label>
                    <input type="number" name="number" id="number" class="form-control"
                        value="{{ old('number', $company->number) }}" placeholder="" min="0" required>
                    <div class="help-block with-errors">{{ $errors->first('number') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 @if($errors->has('district')) has-error @endif">
                    <label for="district">{{ __('general.district') }}</label>
                    <input type="text" name="district" id="district" class="form-control"
                        value="{{ old('district', $company->district) }}" placeholder="" min="0" required>
                    <div class="help-block with-errors">{{ $errors->first('district') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 @if($errors->has('complement')) has-error @endif">
                    <label for="complement">{{ __('general.complement') }}</label>
                    <input type="text" name="complement" id="complement" class="form-control"
                        value="{{ old('complement', $company->complement) }}" placeholder="">
                    <div class="help-block with-errors">{{ $errors->first('complement') }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="resposible" class="control-label font-weight-bold">
                            Responsável
                        </label>
                        <input type="text" class="form-control" name="resposible" id="resposible"
                            placeholder="Responsável" value="{{ old('resposible',$company->resposible) }}">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email" class="control-label font-weight-bold">
                            Email
                        </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                            title="Entre com o Email." value="{{ old('email',$company->email) }}">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <div class="col-xs-12">
                    <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>
                        Salvar</button>
                    <a href="{{ route('user.users.index') }}" class="btn btn-danger"><i
                            class="glyphicon glyphicon-repeat"></i>
                        Cancelar</a>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection
