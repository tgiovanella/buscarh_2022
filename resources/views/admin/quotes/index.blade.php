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
                        <form id="formfilter" class="form form-search" novalidate>
                            @csrf
                            <strong>Filtros</strong>
                            <div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label for="initial" class="control-label font-weight-bold">{{ __('Periodo Inicial') }}*</label>
                                            <input type="date" class="form-control" name="initial" id="initial" required />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label for="end" class="control-label font-weight-bold">{{ __('Periodo Final') }}*</label>
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
                                                        {{__('Categorias')}}
                                                    </label>
                                                    <select class="js-example-basic-multiple form-control" name="subcategory_id[]" id="subcategory_id" multiple="multiple">

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
                                                    <label for="operation_uf" class="control-label font-weight-bold">{{ __('UF(s) de Atuação') }}</label>
                                                    <select class="js-example-basic-multiple form-control" name="operation_uf[]" id="operation_uf" multiple="multiple">
                                                        @foreach($ufs as $item)
                                                        <option value="{{ $item->id }}">{{ $item->letter }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="operation_city" class="control-label font-weight-bold">{{ __('Cidades de Atuação') }}</label>
                                                    <select class="js-example-basic-multiple form-control" name="operation_city[]" id="operation_city" multiple="multiple">
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
                                <div class="table-responsive">
                                    <table id="table_search" class="table table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Titulo da Cotação</th>
                                                <th>Data</th>
                                                <th>Categorias</th>
                                                <th>Cidades</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->

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
                <td colspan="4">
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
@push('styles')
<style>
    .form-control.is-valid,
    .was-validated .form-control:valid {
        border-color: var(--primary);
        padding-right: calc(1.5em + .75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2397d700' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: center right calc(.375em + .1875rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem)
    }

    .form-control.is-valid:focus,
    .was-validated .form-control:valid:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 .2rem rgba(125, 200, 85, .25)
    }

    .form-control.is-valid~.valid-feedback,
    .form-control.is-valid~.valid-tooltip,
    .was-validated .form-control:valid~.valid-feedback,
    .was-validated .form-control:valid~.valid-tooltip {
        display: block
    }

    .was-validated textarea.form-control:valid,
    textarea.form-control.is-valid {
        padding-right: calc(1.5em + .75rem);
        background-position: top calc(.375em + .1875rem) right calc(.375em + .1875rem)
    }

    .was-validated select.form-control:invalid+.select2-container>span.selection>span.select2-selection {
        border-color: var(--danger);
    }

    .was-validated select.form-control:invalid+.select2-container--focus>span.selection>span.select2-selection {
        border-color: var(--danger);
        box-shadow: 0 0 0 .2rem rgba(237, 85, 100, .25);
    }

    .was-validated select.form-control:valid+.select2-container>span.selection>span.select2-selection {
        border-color: var(--primary);
    }

    .was-validated select.form-control:valid+.select2-container--focus>span.selection>span.select2-selection {
        border-color: var(--primary);
        box-shadow: 0 0 0 .2rem rgba(125, 200, 85, .25)
    }

    .custom-select.is-valid,
    .was-validated .custom-select:valid {
        border-color: var(--success);
        padding-right: calc((1em + .75rem) * 3 / 4 + 1.75rem);
        background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px, url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2397d700' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") var(--white) no-repeat center right 1.75rem/calc(.75em + .375rem) calc(.75em + .375rem)
    }

    .custom-select.is-valid:focus,
    .was-validated .custom-select:valid:focus {
        border-color: var(--success);
        box-shadow: 0 0 0 .2rem rgba(125, 200, 85, .25)
    }

    .custom-select.is-valid~.valid-feedback,
    .custom-select.is-valid~.valid-tooltip,
    .was-validated .custom-select:valid~.valid-feedback,
    .was-validated .custom-select:valid~.valid-tooltip {
        display: block
    }

    .form-control-file.is-valid~.valid-feedback,
    .form-control-file.is-valid~.valid-tooltip,
    .was-validated .form-control-file:valid~.valid-feedback,
    .was-validated .form-control-file:valid~.valid-tooltip {
        display: block
    }

    .form-check-input.is-valid~.form-check-label,
    .was-validated .form-check-input:valid~.form-check-label {
        color: var(--primary)
    }

    .form-check-input.is-valid~.valid-feedback,
    .form-check-input.is-valid~.valid-tooltip,
    .was-validated .form-check-input:valid~.valid-feedback,
    .was-validated .form-check-input:valid~.valid-tooltip {
        display: block
    }
</style>
@endpush