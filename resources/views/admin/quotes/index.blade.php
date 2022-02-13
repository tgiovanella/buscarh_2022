@extends('admin.layouts.app')

@section('title',__('Relatório de Cotações'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


                <div class="row">
                    <div class="col-md-12">
                        <form id="formfilter" class="form form-search">
                            @csrf
                            <strong>Filtros</strong>
                            <div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label for="initial" class="control-label font-weight-bold">{{ __('Periodo Inicial') }}</label>
                                            <input type="date" class="form-control" name="initial" id="initial" required />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label for="end" class="control-label font-weight-bold">{{ __('Periodo FInal') }}</label>
                                            <input type="date" class="form-control" name="end" id="end" required />
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <label for="subcategory_id" class="control-label font-weight-bold">
                                                {{__('Situação Cotações')}}
                                            </label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" checked value="0">
                                                <label class="form-check-label" for="inlineRadio1">Finalizadas</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Abertas</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="2">
                                                <label class="form-check-label" for="inlineRadio3">Todas</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-md-12 form-group">

                                                    <label for="subcategory_id" class="control-label font-weight-bold">
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
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" onclick="startSearch(event)" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.ads.index') }}" class="btn btn-warning">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row text-left">
                            <div class="col-md-4">
                                <button id="ex" class="btn btn-default bg-green" onclick="exportToExcel(event)" disabled> Exporta Excel</button>
                                <button id="pd" class="btn btn-default bg-red" onclick="exportToPdf(event)" disabled> Baixar PDF</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="table_search" class="table table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Titulo da Cotação</th>
                                            <th>Data</th>
                                            <th>Categorias</th>
                                            <th>Cidades</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-4 text-left"></div>
                    <div class="col-md-7 text-right paginate-count"></div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@endsection
@push('scripts')

<script>
    const bt1 = $('#ex');
    const bt2 = $('#pd');

    function renderTableResult(data) {

        let content = '';
        for (let index = 0; index < data.length; index++) {
            const element = data[index];
            let subcateg = element.subcategories.map(v => `<span class="label label-default">${v.name}</span>`);
            let cities = element.cities.map(v => `<span class="label label-default">${v.title}</span>`);
            let candidates = element.candidates.map(v => `<tr><td> ${element.id} </td><td> ${v.company.name}</td><td> ${Number(v.price).toFixed(2)}</td></tr>`);
            content += `
                <tr>
                    <td>${element.id}</td>
                    <td>${element.title}</td>
                    <td>${new Date(element.created_at).toLocaleDateString('pt-BR')}</td>
                    <td>${subcateg}</td>
                    <td>${cities}</td>
                    
                </tr>
                <tr>
                <td colspan="7">
                    <table style="width:100%;">
                    <tr>
                    <th></th>
                    <th>Candidatos</th>
                    <th>Valor Proposta</th>
                    </tr>
                    ${candidates}
                    </table>
                </td>
                </tr>
            `;
        }
        if (content.length > 0) {
            bt1.attr('disabled', false)
            bt2.attr('disabled', false)
            return content;

        }
        return '<tr><td class="text-center" colspan="7">Nenhum resultado encontrado!</td></tr>';

    }

    function download(response, config) {
        //Convert the Byte Data to BLOB object.
        var blob = new Blob([response], {
            type: config.type
        });

        //Check the Browser type and download the File.
        var isIE = false || !!document.documentMode;
        if (isIE) {
            window.navigator.msSaveBlob(blob, config.file);
        } else {
            var url = window.URL || window.webkitURL;
            link = url.createObjectURL(blob);
            var a = document.createElement("a");
            a.setAttribute("download", config.file);
            a.setAttribute("href", link);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    };

    function exportToExcel(event) {

        const formref = document.getElementById('formfilter');
        const form = new FormData(formref);

        event.target.disabled = true;

        requestPost('/admin/quotes/excel', form).then(async (resp) => await resp.blob()).then(resp => {
            download(resp, {
                type: "application/octetstream",
                file: "cotacoes.xlsx"
            });
        }).finally(() => {
            event.target.disabled = false
        });

    }

    function exportToPdf(event) {

        const formref = document.getElementById('formfilter');
        const form = new FormData(formref);

        event.target.disabled = true;

        requestPost('/admin/quotes/pdf', form).then(async (resp) => await resp.blob()).then(resp => {
            download(resp, {
                type: "application/pdf",
                file: "cotacoes.pdf"
            });
        }).finally(() => {
            event.target.disabled = false
        });

    }

    function startSearch(event) {

        const formref = document.getElementById('formfilter');
        const form = new FormData(formref);
        const table = $('#table_search tbody');

        event.target.disabled = true;

        if (formValidate(event, formref)) {
            table.html(`<tr><td colspan="7"><h4>Buscando...</h4></td></tr>`)
            requestPost('/admin/quotes/search', form).then(async (resp) => await resp.json()).then(resp => {
                console.log(resp);
                table.html(renderTableResult(resp));
            }).finally(() => {
                event.target.disabled = false
            });
        }
        event.target.disabled = false;
    }

    function formValidate(event, form) {
        let errors = false;
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            errors = true;
        }
        form.classList.add("was-validated");
        return errors && (!event.detail || event.detail === 1);
    }

    async function requestPost(url, form) {
        return await fetch(url, {
            'method': 'POST',
            'Content-Type': 'multipart/form-data',
            "headers": {
                'X-CSRF-TOKEN': form.get('_token'),
                'X-Requested-With': 'XMLHttpRequest',
            },
            'body': form
        });
    };

    $(function() {
        let ufs = ''
        $('#subcategory_id').select2();
        $('#operation_uf').select2();
        $('#operation_city').select2();

        $('.select2').css('width', '100%');

        $('#operation_uf').on('change', function(e) {

            e.preventDefault();
            let uf = $(this).val();
            if (uf.length > 0 && ufs !== uf) {

                setTimeout(() => {
                    if (uf.length > 0 && ufs !== uf)
                        $.ajax({
                            type: "get",
                            url: "/api/cities-uf/" + uf,
                            dataType: "json",
                            success: function(response) {
                                let select_city = $("#operation_city");
                                select_city.empty();
                                $(response).each(function(index) {
                                    select_city.append('<option value="' + response[index].id + '">' + response[index].title + '</option>');
                                });
                                ufs = '';
                            }
                        });
                }, 500);
            }
        });
    });
</script>

@endpush