@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

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

    const saveQuotation = (event) => {

        const form = new FormData(fromRefer);

        if (formValidate(event, fromRefer)) {
            requestPost('/users/quotation', form).then(resp => {

            }).catch(error => {
                console.log(error.toString());
            });
        }
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

    $(function() {

        $('.select2').css('width', '100%');

        $('#quot-form-create').on('shown.bs.modal', function() {
            $('#operation_uf').on('change', function(e) {

                e.preventDefault();
                let uf = $(this).val();
                if (uf.length > 0)
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
                        }
                    });
            });
        })
    });
</script>

@endpush