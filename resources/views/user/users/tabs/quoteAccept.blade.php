
@if(count($accepts) > 0)
    <h2>Propostas Aceitas</h2>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>Data Cotação</th>
                <th>Título da Cotação</th>
                <th>Solicitante</th>
                <th>Pesquisa de Satisfação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accepts as $item)
                <tr>
                    <td>{{ date('d/m/Y', strtotime($item->quote->created_at)) }}</td>
                    <td>{{$item->quote->title}}</td>
                    <td>{{$item->company->name}}</td>
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
        Não existem informações a serem exibidas.
    </div>
@endif
