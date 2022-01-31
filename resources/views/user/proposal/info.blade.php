<div class="row p-0">
    <form id="poposal-form">

    <input type="hidden" name="proposal_id" value="{{$candidate->id}}" />
    <input type="hidden" name="company_id" value="{{$candidate->company->id}}" />
    </form>
 
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$candidate->company->fantasy}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-5">Valor proposta: </dt>
                            <dd class="col-sm-7">R$ {{ number_format($candidate->price,2,',','.')  }}</dd>
                            <dt class="col-sm-5">Data entrega: </dt>
                            <dd class="col-sm-7"> {{date('d-m-Y',strtotime($candidate->deadline))}} </dd>
                            <dt class="col-sm-12">Descrição: </dt>
                        </dl>
                        <div class="row">
                            <div class="col">
                                <p>{{$candidate->comment}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>