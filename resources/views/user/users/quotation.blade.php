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
                        Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>