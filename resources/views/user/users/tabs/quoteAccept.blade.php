
@if(count($accepts) > 0)
    <h2>Propostas Aceitas</h2>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>Título da Cotação</th>
                <th>Categoria</th>
                <th>Pesquisa de Satisfação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accepts as $item)
                <tr>
                    <td>{{$item->user_id}}</td>
                    <td>{{$item->comment}}</td>
                    <td>
                        @if($item->nps_answer)
                            <button class="btn btn-sm btn-secondary text-white" title="Formulário Respondido">
                                <span>Enviado</span>
                            </button>
                        @else
                            <button onclick="openModalNps()" class="btn btn-sm btn-success text-white" title="Responder Formulário">
                                <span>Responder</span>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal NPS -->
    <div class="modal fade" id="modalNps" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class='modal-header'>
                    <h4 class="text-primary center">Pesquisa de Satisfação</h4>
                </div>
                <div class="modal-body" id="">
                <input type="hidden" id="user_id" value="{{$item->user_id}}">
                    <input type="hidden" id="company_id" value="{{$item->company_id}}">
                    <input type="hidden" id="quote_id" value="{{$item->quote_id}}">
                    <input type="hidden" id="id" value="{{$item->id}}">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Você recomendaria este processo de cotação do site BuscaRHweb para outras empresas/profissionais de RH ?</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="answer" id="answer" value="1">
                            <label class="form-check-label" for="inlineRadio1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="answer" id="answer" value="0">
                            <label class="form-check-label" for="inlineRadio2">Não</label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="" for="inlineRadio1">Comentários</label>
                            <textarea class="form-control" name="" id="comment" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <span style="flex:1 1 auto"></span>
                    <button type="button" class="btn btn-success" onclick="sendNps(event)" id="">Enviar</button>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-primary" role="alert">
        xxxxxxxxxxxx
    </div>
@endif
<script>
    const csrf = "{{csrf_token()}}";
    function openModalNps()
    {
        $('#modalNps').modal();
    }
    const sendNps = (event) => {
        event.target.disabled = true

        const form = new FormData();
        form.append('user_id', $('#user_id').val());
        form.append('company_id', $('#company_id').val());
        form.append('quote_id',  $('#quote_id').val());
        form.append('comment',  $('#comment').val());
        form.append('answer',  $('#answer').val());
        form.append('id',  $('#id').val());


        requestPost('/users/quotes-nps', form).then(resp => {
            if (resp.type === 'success') {
                $('#modalNps').modal('hide');
                sessionStorage.setItem('success', resp.message);
                flashsuccess(sessionStorage.getItem('success'));
                window.location.reload();
                return null;
            }
            flasherror(resp.message);

        }).finally(() => {
            event.target.disabled = false;
            $('#comment-modal').modal('close');
        });
        event.preventDefault();
    }
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
    async function requestPost(url, form) {
        return await fetch(url, {
            'method': 'POST',
            'Content-Type': 'multipart/form-data',
            "headers": {
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest',
            },
            'body': form
        }).then(async (resp) => await resp.json());
    };
</script>