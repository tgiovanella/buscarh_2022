<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Nova Cotação</h2>
        <hr>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="quot_title" class="control-label font-weight-bold">{{ __('Titulo Cotação') }}*</label>
                <input type="text" class="form-control" name="title" id="quot_title" required />
            </div>
            <div class="col-md-12 form-group">

                <label for="cpf_cnpj" class="control-label font-weight-bold">
                    {{__('Categorias')}}*
                </label>
                <select class="js-example-basic-multiple form-control" name="subcategory_id[]" id="subcategory_id" multiple="multiple" required>

                    @forelse($categories as $subcategories)
                    <optgroup label="{{$subcategories->name}}">
                        @foreach($subcategories->subcategories as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </optgroup>
                    @empty

                    @endforelse
                </select>
                <div class="invalid-feedback">
                    Por favor, informe as Categorias
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label for="operation_uf" class="control-label font-weight-bold">{{ __('UF(s) de Atuação') }}*</label>
                <select class="js-example-basic-multiple form-control" name="operation_uf[]" id="operation_uf" multiple="multiple" required>
                    @foreach($ufs as $item)
                    <option value="{{ $item->id }}">{{ $item->letter }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, informe o UF de Atuação
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label for="operation_city" class="control-label font-weight-bold">{{ __('Cidades de Atuação') }}*</label>
                <select class="js-example-basic-multiple form-control" name="operation_city[]" id="operation_city" multiple="multiple" required>
                    <option value="">
                        -- selecione as cidades --
                    </option>

                </select>
                <div class="invalid-feedback">
                    Por favor, informe as Cidades de Atuação
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label for="infos" class="control-label font-weight-bold">
                    {{__('Informações Adicionais')}}
                </label>
                <textarea class="form-control" name="infos" id="infos" cols="30" rows="10" required></textarea>

            </div>
        </div>

    </div>
</div>