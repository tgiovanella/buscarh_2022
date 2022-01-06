@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="row">
            
            <div class="col-sm-12">
                <ul class="nav nav-tabs" id="tabUser" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="company-tab" data-toggle="tab" href="#company" role="tab"
                            aria-controls="company" aria-selected="false">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ads-tab" data-toggle="tab" href="#ads" role="tab" aria-controls="ads"
                            aria-selected="false">Anúncios</a>
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

                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>



</div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
