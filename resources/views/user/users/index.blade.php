@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="flash-message" class="alert alert-dismissible my-2 fade show" role="alert">
            <span></span>
            <button onclick="flashclose()" type="button" class="close" aria-label="Close">
                <i aria-hidden="true">&times;</i>
            </button>
        </div>
        <div class="row">

            <div class="col-sm-12">

                <ul class="nav nav-tabs" id="tabUser" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="company-tab" data-toggle="tab" href="#company" role="tab" aria-controls="company" aria-selected="false">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ads-tab" data-toggle="tab" href="#ads" role="tab" aria-controls="ads" aria-selected="false">Anúncios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="quot-tab" data-toggle="tab" href="#quot" role="tab" aria-controls="quot" aria-selected="false">Cotações</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <hr>
                        <h2>Perfil</h2>
                        @includeIf('user.users.tabs.profile',compact('user'))
                        <hr>

                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane" id="company">
                        <hr>
                        <h2>Empresas</h2>
                        @includeIf('user.users.tabs.company')
                        <hr>
                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane" id="ads">
                        <hr>
                        <h2>Anúncios</h2>
                        @includeIf('user.users.tabs.ads')
                        <hr>
                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane" id="quot">
                        <hr>
                        <h2>Cotações</h2>
                        @includeIf('user.users.tabs.quotations')
                        <hr>
                    </div>

                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>
    <!-- Modal Form Quotation -->
    @include('user.users.quotation')
</div>
@endsection

@push('scripts')

<script>
    const fromRefer = document.getElementById('registrationFormQuotation');
    const csrf = "{{csrf_token()}}";
    const openModalQuotForm = () => {
        $('#quot-form-create').modal('show');
    }

    const closeModalQuotForm = (event) => {
        $('#quot-form-create').modal('hide');
        fromRefer.classList.remove("was-validated");
        //reset selet2 values
        $('.js-example-basic-multiple').val(null).trigger('change');
        fromRefer.reset();

    }

    const formValidate = (event, form) => {
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

    const sendNotification = (event, response) => {
        $('#quote-sendmail').modal('show');

        return fetch(`/candidate/notification/${response.id}`, {
                'method': 'GET',
                "headers": {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(async (resp) => await resp.json())
            .then(resp => {
                if (resp.type === 'success') {
                    sessionStorage.setItem('success', resp.message);
                    window.location.reload();
                    return null;
                }
                flasherror(resp.message);
            }).finally(() => {
                $('#quote-sendmail').modal('hide');
            });

    }

    const saveQuotation = (event) => {

        const form = new FormData(fromRefer);
        event.target.disabled = true
        if (formValidate(event, fromRefer)) {
            requestPost('/users/quotation', form).then(resp => {
                if (resp.type === 'success') {
                    closeModalQuotForm(event);
                    sendNotification(event, resp.data);
                    return null
                }
                flasherror(resp.message);
            }).catch(error => {
                console.log(error.toString());
            }).finally(() => {
                event.target.disabled = false
            });
        }
    }

    const deleteQuote = (event) => {
        let id = $(event.target).data('id');

        confirmDialog(`<p>[#${id}] Deseja remover essa Cotação</p><p class="text-danger"><b>Atenção!!</b> Essa ação no pode ser desfeita.</p>`, () => {
            const form = new FormData();
            form.append('id', id);
            form.append('_token', csrf);
            requestPost('/users/quotation/delete', form).then(resp => {
                sessionStorage.setItem('success', resp.message);
                window.location.reload();
            });
            event.preventDefault();
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
        let ufs = ''

        $('#flash-message').hide()
        $('#company_id').select2();
        $('.select2').css('width', '100%');

        $('#quot-form-create').on('shown.bs.modal', function() {
            $('#operation_uf').on('change', function(e) {

                e.preventDefault();
                let uf = $(this).val();
                if (uf.length > 0 && ufs !== uf) {
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
                }

            });
        })
        if (sessionStorage.getItem('success')) {
            flashsuccess(sessionStorage.getItem('success'));
        }
        if (sessionStorage.getItem('error')) {
            flasherror(sessionStorage.getItem('error'));
        }
    });
</script>

@endpush