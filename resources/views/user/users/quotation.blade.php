<div class="modal fade" id="quot-form-create" tabindex="-1" aria-labelledby="quotLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" class="form" id="registrationFormQuotation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        @include('user.quotations.create')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModalQuotForm(event)"><i class="glyphicon glyphicon-repeat"></i>Cancelar</button>
                    <button class="btn btn-success" type="button" onclick="saveQuotation(event)"><i class="glyphicon glyphicon-ok-sign"></i>
                        Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="quote-sendmail" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Aguarde... Notificações estão sendo enviadas, isso pode demora alguns minutos!</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Eviando...</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- MODAL CONFIRME-->
<div class="modal fade" id="confirmModal" role="dialog" aria-hidden="true" style="display: none; z-index: 1050;">
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
