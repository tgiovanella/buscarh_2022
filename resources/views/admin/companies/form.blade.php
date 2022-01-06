@if($method == 'create')
@php($action = route('admin.companies.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.companies.update',$company->id))
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

            $('.select-ajax-users').select2({
                ajax: {
                    url: function (params) {
                        console.log(params.term);
                        return '/api/users-like/' + params.term;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        }
                    }
                }
            });



    });
</script>
@endpush




<form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}




    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
            <label for="name">{{ __('general.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $company->name) }}"
                placeholder="" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('name') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('fantasy')) has-error @endif">
            <label for="fantasy">{{ __('general.fantasy') }}</label>
            <input type="text" name="fantasy" id="fantasy" class="form-control"
                value="{{ old('fantasy', $company->fantasy) }}" placeholder="" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('fantasy') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('cpf_cnpj')) has-error @endif">
            <label for="cpf_cnpj">{{ __('general.cpf_cnpj') }}</label>
            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control"
                value="{{ old('cpf_cnpj', $company->cpf_cnpj) }}" placeholder="" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('cpf_cnpj') }}</div>
        </div>
    </div>




    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('categories')) has-error @endif">
            <label for="uf">{{ __('general.categories') }}</label>
            <select class="form-control js-select2" name="subcategory_id[]" id="subcategory_id" multiple="multiple"
                required>

                @forelse($categories as $subcategories)
                <optgroup label="{{$subcategories->name}}">
                    @foreach($subcategories->subcategories as $item)
                    <option value="{{ $item->id }}" @if(in_array($item->id,$subcategories_selected)) selected
                        @endif>{{ $item->name }}</option>
                    @endforeach
                </optgroup>
                @empty

                @endforelse
            </select>
            <div class="help-block with-errors">{{ $errors->first('city_id') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('operation_uf')) has-error @endif">
            <label for="uf">{{ __('UF(s) de Atuação') }}</label>




            <select class="form-control js-select2" name="operation_uf[]" id="operation_uf" multiple="multiple"
                required>
                @foreach($ufs as $item)
                <option value="{{ $item->id }}" @if(in_array($item->id,$operation_ufs)) selected
                    @endif>{{ $item->letter }}
                </option>
                @endforeach
            </select>
            <div class="help-block with-errors">{{ $errors->first('city_id') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('operation_city')) has-error @endif">
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
        <div class="form-group col-md-6 @if($errors->has('site')) has-error @endif">
            <label for="site">{{ __('general.site') }}</label>
            <input type="text" name="site" id="site" class="form-control" value="{{ old('site', $company->site) }}"
                placeholder="" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('site') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('site')) has-error @endif">
            <label for="phone">{{ __('general.phone') }}</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $company->phone) }}"
                placeholder="" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('phone') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('site')) has-error @endif">
            <label for="cep">{{ __('general.cep') }}</label>
            <input type="text" name="cep" id="cep" class="form-control" value="{{ old('cep', $company->cep) }}"
                placeholder="" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('cep') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3 @if($errors->has('uf')) has-error @endif">
            <label for="uf">{{ __('general.uf') }}</label>
            <select name="uf" id="uf" class="form-control" required>
                <option value="">-- Selecione um UF --</option>
                @forelse ($ufs as $uf)
                <option value="{{ $uf->id }}" {{ old('uf', @$company->city->state->id) == $uf->id ? 'selected' : '' }}>
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
                <option value="{{ $city->id }}" {{ old('city_id', $company->city_id) == $city->id ? 'selected' : '' }}>
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


    <!-- precisa tratar o dono -->

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('owner_id')) has-error @endif">
            <label for="uf">{{ __('Dono') }}</label>
            <select class="form-control select-ajax-users" name="owner_id" id="owner_id">
                @if($company->owner)
                <option value="{{ $company->owner_id }}" selected>{{ $company->owner->name }} -
                    {{ $company->owner->email }} </option>
                @endif
            </select>
            <div class="help-block with-errors">{{ $errors->first('owner_id') }}</div>

            @if(!$company->owner)
            <div class="text-danger">Não existe um dono vinculado a empresa.</div>
            @endif
        </div>
    </div>

    {{-- <div class="row">
        <div class="form-group col-md-6 @if($errors->has('owner_id')) has-error @endif">
            <label for="owner_id">{{ __('general.owner_id') }}</label>
    <input type="text" name="owner_id" id="owner_id" class="form-control"
        value="{{ old('owner_id', @$company->owner->name) }}" placeholder="" disabled>
    <div class="help-block with-errors">{{ $errors->first('owner_id') }}</div>
    </div>
    </div> --}}

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('email')) has-error @endif">
            <label for="email">{{ __('general.email') }}</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $company->email) }}"
                placeholder="" required>
            <div class="help-block with-errors">{{ $errors->first('email') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('responsible')) has-error @endif">
            <label for="responsible">{{ __('general.responsible') }}</label>
            <input type="text" name="responsible" id="responsible" class="form-control"
                value="{{ old('responsible', $company->responsible) }}" placeholder="" required>
            <div class="help-block with-errors">{{ $errors->first('responsible') }}</div>
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
