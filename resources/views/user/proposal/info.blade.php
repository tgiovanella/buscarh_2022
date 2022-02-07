<div class="row p-0">
    <form id="poposal-form">

    <input type="hidden" name="proposal_id" value="{{$candidate->id}}" />
    <input type="hidden" name="company_id" value="{{$candidate->company->id}}" />
    </form>
 
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Proposta de: {{$candidate->company->fantasy}}<strong></h4>
            </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-5">
                                <p>Valor proposta: <strong>R$ {{ number_format($candidate->price,2,',','.')  }}</strong></p>
                            </div>
                            <div class="col-sm-7">
                                <p>Data entrega: <strong>{{date('d-m-Y',strtotime($candidate->deadline))}}</strong></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-5">
                                <p>Impostos inclusos? <strong>{{ $candidate->taxes ==1 ? 'Sim' : 'Não'  }}</strong></p>
                            </div>
                            <div class="col-sm-7">
                                <p>Despesas inclusas? <strong>{{ $candidate->expenditure ==1 ? 'Sim' : 'Não' }}</strong></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <p>Descrição: <strong>{{$candidate->comment}}</strong></p>
                    </li>
                </ul>
        </div>
    </div>
</div>