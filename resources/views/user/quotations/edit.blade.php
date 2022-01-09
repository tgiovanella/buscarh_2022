<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>{{$title}}</h2>
        <hr>
       <input type="hidden" name="id" value="{{$quot->id_quotation}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cpf_cnpj" class="control-label font-weight-bold">
                        Categorias
                    </label>
                    <select class="js-example-basic-multiple form-control" name="subcategory_id[]" id="subcategory_id" multiple="multiple" required>

                        @forelse($categories as $subcategories)
                        <optgroup label="{{$subcategories->name}}">
                            @foreach($subcategories->subcategories as $item)
                            <option value="{{ $item->id }}" {{in_array($item->id,$subcategories_selected) ?  'selected':''}}>
                                {{ $item->name }}
                            </option>
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
            <div class="form-group col-md-12">
                <label for="uf">{{ __('UF(s) de Atuação') }}</label>
                <select class="form-control js-select2" name="operation_uf[]" id="operation_uf" multiple="multiple" required>
                    @foreach($ufs as $item)
                    <option value="{{ $item->id }}" {{in_array($item->id,$operation_ufs) ?  'selected':''}}>{{ $item->letter }}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="uf">{{ __('Cidades de Atuação') }}</label>
                <select class="form-control select-ajax-cities" name="operation_city[]" id="operation_city" multiple="multiple" require>
                    @forelse ($company->operation_cities as $city)
                    <option value="{{ $city->id }}" selected>
                        {{ $city->title }}/{{ $city->state->letter }}
                    </option>
                    @empty

                    @endforelse
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="infos" class="control-label font-weight-bold">
                        Informações Adicionais
                    </label>
                    <textarea name="infos" id="infos" cols="30" rows="10">{{$company->additional_info}}</textarea>
                </div>
            </div>
        </div>

    </div>
</div>