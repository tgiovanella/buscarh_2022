
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Solicitante</th>
                <th>Título da Cotação</th>
                <th>Categoria</th>
                <th>Pesquisa de Satisfação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accepts as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->user_id}}</td>
                    <td>{{$item->comment}}</td>
                    <td>xxxxxxxx</td>
                    <td>
                        @if(1==1)
                            <button onclick="openModalNps()" class="btn btn-sm btn-success text-white" title="Responder Formulário">
                                <span>Responder</span>
                            </button>
                        @else
                            <span>Respondido</span>
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
                <div class="row">
                    <div class="col-md-12">
                        <h6>Você recomendaria este processo de cotação do site BuscaRHweb para outras empresas/profissionais de RH ?</h6>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Não</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <span style="flex:1 1 auto"></span>
                <button type="button" class="btn btn-success" id="">Responder</button>
            </div>
        </div>
    </div>
</div>
<script>
    function openModalNps()
    {
        $('#modalNps').modal();
    }
</script>