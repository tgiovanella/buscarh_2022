@extends('user.layouts.html')
@section('container')
<div class="container-fluid">
    <div id="flash-message" class="alert alert-dismissible my-2 fade show" role="alert">
        <span></span>
        <button onclick="flashclose()" type="button" class="close" aria-label="Close">
            <i aria-hidden="true">&times;</i>
        </button>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Propostas</h4>
                </div>
                <div class="card-body">
                    @if($quotes_avalaibles && $quotes_avalaibles->candidates->count() > 0)
                    <input type="hidden" id="_quote_id" value="{{$quotes_avalaibles->id}}" />
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Empresa Prestadora</th>
                                <th>Preço proposta</th>
                                <th>Data entrega</th>
                                <th class="text-center">Cidade</th>
                                <th class="text-center">Observações</th>
                                <th class="text-center">Anexos</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotes_avalaibles->candidates as $item)
                            <tr>
                                <td width="80">{{ $item->id }}</td>
                                <td width="20%">{{ $item->company->fantasy  }}</td>
                                <td>
                                    {{ number_format($item->price,2,',','.')  }}
                                </td>
                                <td>
                                    {{date('d-m-Y',strtotime($item->deadline))}}
                                </td>
                                <td class="text-center">{{$item->company->city->title}} / {{$item->company->uf}} </td>
                                <!-- link da interacao entre empresa e candidato -->
                                <td class="text-center"><i class="fa fa-comment" aria-hidden="true"></i> {{$item->comments_count}} </td>
                                <td class="text-center">
                                    @if($item->path_file)
                                    <a title="Baixar anexo Proposta" href="{{ Storage::disk('public')->url($item->path_file) }}" download>
                                        <i class="fa fa-file text-info" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    -
                                    @endif
                                </td>

                                <td width="120" class="text-center">
                                    <!-- link do formulario aqui -->
                                    <a href="#" data-src="{{$item}}" onclick="showInfo(event)" class="btn btn-sm btn-info text-white" title="Visualizar Proposta Completa">
                                        <i data-src="{{$item}}" class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" data-src="{{$item}}" onclick="accept(event)" class="btn btn-sm btn-success text-white" title="Aceitar Proposta">
                                        <i data-src="{{$item}}" class="fa fa-check" aria-hidden="true"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning" role="alert">
                        Ainda não existem propostas.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class='modal-header'>
                <h4 class="text-danger center">Atenção !</h4>
            </div>
            <div class="modal-body" id="confirmMessage">
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-danger" id="confirmCancel">Cancelar</button>
                <span style="flex:1 1 auto"></span>
                <button type="button" class="btn btn-primary" id="confirmOk">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal  fade" id="modal_show_proposal" role="dialog" aria-labelledby="modal_show_proposal_label" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Proposta</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body _load">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="infos" class="control-label font-weight-bold">
                            {{__('Nova Mensagem')}}
                        </label>
                        <textarea class="form-control" name="infos" id="infos" cols="30" rows="10" required></textarea>

                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <span style="flex:1"></span>
                <button type="button" class="btn btn-primary" onclick="sendComment(event)">Enviar</button>

            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
    <!-- MODAL CONFIRME-->

</div>

<div class="modal fade modal-right" id="comment-modal" tabindex="-1" aria-labelledby="quotLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="_load p-2">
              
            </div>
            <div class="modal-body comment">
               
            </div>
            <div class="resposta p-3" style="margin-bottom:80px">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="comment" class="control-label font-weight-bold">
                            {{__('Novo Comentário')}}
                        </label>
                        <textarea class="form-control" name="comment" id="comment" cols="30" rows="5" required></textarea>

                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-fixed">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cancelar"><i class="glyphicon glyphicon-repeat"></i>Cancelar</button>
                <button class="btn btn-success" onclick="sendComment(event)"><i class="glyphicon glyphicon-ok-sign"></i>
                    Enviar
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const info_modal = $('#comment-modal');
    const state = {};
    const csrf = "{{csrf_token()}}";

    const candidates = [{!! $quotes_avalaibles->candidates ?? null !!}];
    const showInfo = (event) => {
        info_modal.modal('show');

        getInfo(event);
        openCommets(event);
    }

    const sendComment = (event) => {

        event.target.disabled = true
        const comment = $('#comment').val();

        const form = new FormData();
        form.append('proposal_id', state.data.id);
        form.append('company_id', state.data.company_id);
        form.append('quote_id', state.data.quote_id);
        form.append('comment', comment);
        form.append('_token', csrf);

        requestPost('/users/comment-proposal', form).then(resp => {
            if (resp.type === 'success') {
                sessionStorage.setItem('success', resp.message);
                window.location.reload();
                return null;
            }
            flasherror(resp.message);

        }).finally(() => {
            event.target.disabled = false;
            info_modal.modal('close');
        });
        event.preventDefault();
    }

    const getInfo = (event) => {

        const data = $(event.target).data('src');
        state.id = data.id;
        state.data = candidates[0].find((v) => v.id === data.id);

        return fetch(`/users/proposal/${data.id}`, {
                'method': 'GET',
                "headers": {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(async (resp) => await resp.text())
            .then(resp => {
                info_modal.find('div._load').html(resp);
            })
    }

    const accept = (event) => {
        const data = $(event.target).data('src');
        event.target.disabled = true

        const form = new FormData();

        confirmDialog(`<p>[#${data.id} Você deseja <b>aceitar</b> a proposta e fechar negocio?</p><p class="text-danger"><b>Atenção!!</b> Essa ação no pode ser desfeita.</p>`, () => {

            form.append('_token', csrf);
            form.append('id', data.quote_id);
            form.append('proposal_id', data.id);

            requestPost('/users/accept-proposal', form).then(resp => {
                if (resp.type === 'success') {
                    sessionStorage.setItem('success', resp.message);
                    window.location.reload();
                    return null;
                }
                flasherror(resp.message);

            }).finally(() => {
                event.target.disabled = false;
                info_modal.modal('close');
            });
            event.preventDefault();
        });

        event.target.disabled = false;
    }

    function rederComment(data, company) {

        let content = "";

        for (let index = 0; index < data.length; index++) {

            const element = data[index];
            const d = new Date(element.created_at).toLocaleDateString('pt-BR');

            if (element.user_id === null)
                content += `
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">${company} disse:</h5>
            <small>${d}</small>
            </div>
            <p class="mb-1">${element.comment}</p>
        </a>`;
            else
                content += `
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Meu comentário</h5>
            <small>${d}</small>
            </div>
            <p class="mb-1">${element.comment}</p>
        </a>`;
        }
        return content;
    }

    async function openCommets(event) {
        const data = $(event.target).data('src');
        $('#comment-modal').modal('show');
        $('#comment-modal').find('.comment').html(`<div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>`);
        await fetch(`/users/comment-proposal/${data.company_id}/${data.quote_id}`)
            .then(resp => resp.json())
            .then(json => {
                if (json.type === 'success' && json.data.length > 0) {
                    $('.resposta').show();
                  //  state.data = json.data[0];
                    $('#comment-modal').find('.comment').html(rederComment(json.data, data.company.fantasy))
                } else {
                    $('#comment-modal').find('.comment').html('<h4>Não existem comentários<h4>');
                }
            });

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
        }).then(async (resp) => await resp.json());
    };
    const flashsuccess = (msg) => {
        $('#flash-message')
            .show()
            .addClass('alert-success')
            .find('span')
            .html(`<strong>Sucesso!</strong>${msg}`)

        sessionStorage.removeItem('success');
    }
    const flasherror = (msg) => {
        $('#flash-message').show()
            .addClass('alert-danger')
            .find('span')
            .html(`<strong>Error!</strong>${msg}`);
        sessionStorage.removeItem('error');
    }
    const flashclose = () => $('#flash-message').hide();

    function confirmDialog(message, onConfirm, config = {
        confirmText: "Continuar",
        cancelText: "Cancelar"
    }) {
        const {
            confirmText,
            cancelText
        } = config;
        var fClose = function() {
            modal.modal("hide");
        };
        var modal = $("#confirmModal");
        modal.modal("show");
        $("#confirmMessage").empty().append(message);
        $("#confirmOk").text(confirmText).off().one('click', onConfirm).one('click', fClose);
        $("#confirmCancel").text(cancelText).off().one("click", fClose);
    }

    $(function() {
        $('#flash-message').hide()
        $('.card-body').css('height', window.innerHeight - (window.innerHeight * 0.45));
        if (sessionStorage.getItem('success')) {
            flashsuccess(sessionStorage.getItem('success'));
        }
        if (sessionStorage.getItem('error')) {
            flasherror(sessionStorage.getItem('error'));
        }
    })
</script>
@endpush