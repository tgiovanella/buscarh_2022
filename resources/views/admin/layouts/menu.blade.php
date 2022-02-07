<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">


                <img src="{{ get_gravatar(\Illuminate\Support\Facades\Auth::user()->email) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ __('Menu Principal') }}</li>
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('admin.companies.index') }}"><i class="fa fa-building"></i>
                    <span>{{ __('Empresas') }}</span></a></li>

            <li><a href="{{ route('admin.ads.index') }}">
                    <i class="fa fa-photo"></i> <span>Anúncios</span>
                    @if(App\Report::where('status',App\Advert::STATUS_PENDING)->count() > 0)
                    <span class="pull-right-container">
                        <small class="label pull-right bg-yellow">{{ App\Advert::where([['status',App\Report::STATUS_PENDING]])->count() }}</small>
                    </span>
                    @endif
                </a></li>
            <li><a href="/admin/quotes"><i class="fa fa-building"></i>
                    <span>{{ __('Cotações') }}</span></a></li>

            <!-- NPS  -->
            <li>
                <a href="{{ route('admin.nps.index') }}">
                    <i class="fa fa-file"></i> <span>Pesquisa de Satisfação(NPS)</span>
                </a>
            </li>

            <li class="header">SISTEMA DE DENÚNCIAS</li>
            <li>
                <a href="{{ route('admin.reports.index') }}">
                    <i class="fa fa-user-times"></i> <span>Denúncias de Empresas</span>
                    @if(App\Report::where('status',App\Report::STATUS_PENDING)->count() > 0)
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">{{ App\Report::where([['status',App\Report::STATUS_PENDING],['company_id','<>','null']])->count() }}</small>
                    </span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reports.ads') }}">
                    <i class="fa fa-user-times"></i> <span>Denúncias de Anúncios</span>
                    @if(App\Report::where('status',App\Report::STATUS_PENDING)->count() > 0)
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">{{ App\Report::where([['status',App\Report::STATUS_PENDING],['advert_id','<>','null']])->count() }}</small>
                    </span>
                    @endif
                </a>
            </li>

            {{-- <li><a href=""><i class="fa fa-users"></i> <span>{{ __('teste') }}</span></a></li> --}}
            {{-- <li><a href="{{ route('admin.classifieds.index') }}"><i class="fa fa-line-chart"></i>
            <span>Classificar</span></a></li> --}}
            {{-- <li><a href="#"><i class="fa fa-exchange"></i> <span>Finalistas</span></a></li> --}}

            <li class="header">GERENCIADOR DE CONTEÚDO</li>
            <li><a href="{{ route('admin.pages.index') }}"><i class="fa fa-columns"></i> <span>Institucionais</span></a>
            </li>
            <li><a href="{{ route('admin.faqs.index') }}"><i class="fa fa-question-circle"></i> <span>FAQs</span></a>
            </li>
            <li><a href="{{ route('admin.navs.index') }}"><i class="fa fa-bars"></i> <span>Menu</span></a></li>
            <li><a href="{{ route('admin.contacts.index') }}"><i class="fa fa-envelope"></i> <span>Contatos</span></a>
            </li>


            <li class="header">CADASTROS</li>
            <li><a href="{{ route('admin.categories.index') }}"><i class="fa fa-tags"></i> <span>Categorias</span></a>
            </li>
            <li><a href="{{ route('admin.subcategories.index') }}"><i class="fa fa-tag"></i>
                    <span>Subcategorias</span></a></li>

            <li class="header">PAGAMENTOS</li>
            <li><a href="{{ route('admin.planes.index') }}"><i class="fa fa-credit-card-alt"></i><span>Planos</span></a>
            <li><a href="{{ route('admin.orders.index') }}"><i class="fa fa-calendar"></i><span>Assinaturas</span></a>


            <li class="header">USUÁRIOS</li>
            <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i><span>Usuários</span></a>


            <li><a href="{{ route('admin.claims.index') }}"><i class="fa fa-id-card-o"></i><span>Solicitação de
                        Propriedade</span>


                    @if(App\ClaimCompany::count() > 0)
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">{{ App\ClaimCompany::count() }}</small>
                    </span>
                    @endif
                </a>


            <li class="header">ANÁLISE DE BUSCAS</li>
            <li><a href="{{ route('admin.analytics.terms') }}"><i class="fa fa-quote-left"></i> <span>Termos
                        Pesquisados</span></a></li>


            <li class="header">CONFIGURAÇÕES</li>
            <li><a href="{{ route('admin.configurations.index') }}"><i class="fa fa-cogs"></i>
                    <span>Configurações</span></a></li>

            <li><a href="{{ route('admin.ads-config.index') }}"><i class="fa fa-photo"></i> <span>Configurar
                        Anúncios</span></a></li>



            <li class="header">RELATÓRIOS</li>
            <li><a href="{{ route('admin.list-contacts.index') }}"><i class="fa fa-file"></i> <span>Lista de Contatos</span></a></li>
            <li><a href="{{ route('admin.clicks-regions.index') }}"><i class="fa fa-file"></i> <span>Regiões e Cliques</span></a></li>




            @if(false)
            <li class="header">CADASTROS</li>
            @if(Auth::user()->id == 1)
            {{-- <li><a href="#"><i class="fa fa-users"></i> <span>Cadastro de Usuários</span></a></li> --}}
            @endif
            {{-- <li><a href="{{ route('admin.festivals.index') }}"><i class="fa fa-ticket"></i>
            <span>{{__('messages.title_festivals')}}</span></a></li>
            <li><a href="{{ route('admin.categories.index') }}"><i class="fa fa-trophy"></i>
                    <span>{{__('messages.title_awards')}}</span></a></li>
            <li><a href="{{ route('admin.grades.index') }}"><i class="fa fa-star-half-o"></i>
                    <span>{{__('messages.title_grades')}}</span></a></li>
            <li><a href="{{ route('admin.instruments.index') }}"><i class="fa fa-bullhorn"></i>
                    <span>{{__('messages.title_instruments')}}</span></a></li> --}}

            <li class="header">RELATÓRIOS</li>
            {{-- <li><a href="{{ route('admin.reports.inscriptions') }}"><i class="fa fa-bar-chart"></i>
            <span>{{__('messages.title_rel_inscriptions')}}</span></a></li>
            <li><a href="{{ route('admin.reports.users') }}"><i class="fa fa-envelope"></i>
                    <span>{{__('messages.title_rel_mails')}}</span></a></li>
            <li><a href="{{ route('admin.reports.index') }}"><i class="fa fa-id-card"></i>
                    <span>{{__('messages.title_rel_subscribers_list')}}</span></a></li> --}}
            <li class="header">CONFIGURAÇÕES</li>
            {{-- <li><a href="{{ route('admin.backups.index') }}"><i class="fa fa-download"></i>
            <span>{{__('Backups')}}</span></a></li>
            <li><a href="{{ route('admin.users.pass') }}"><i class="fa fa-key"></i>
                    <span>{{__('Alterar Senha')}}</span></a></li>
            <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i>
                    <span>{{__('Manutenção de Usuários')}}</span></a></li> --}}

            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>