<form class="card card-sm" method="GET" @if(\Route::current()->getName() != 'user.company.search')
    action="{{ route('user.company.search') }}" @endif v-on:submit="analytics">
    <div class=" input-group">
        @if(\Request::input('uf'))
        <input type="hidden" name="uf" value="{{ \Request::input('uf') }}">
        @endif
        <input v-model="term" class="form-control form-control-lg rounded-0" type="search"
            placeholder="Procurar uma empresa" id="main-seach" name="q" value="{{ Request::input('q') }}">

        <div class="input-group-append">
            <button type="submit" class="btn btn-b-blue rounded-0 text-uppercase">
                Pesquisar
            </button>
        </div>
    </div>
</form>
