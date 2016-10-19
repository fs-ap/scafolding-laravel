<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('/') }}"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li class="treeview {{ Request::is('pessoas*') ? 'active' : '' }}">
                <a href="#">
                    <i class='fa fa-group'></i>
                    <span>Pessoas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('*candidatos*') ? 'active item-menu' : '' }}">
                        <a href="{{ '' }}"><i class="fa fa-user"></i>Candidatos</a></li>
                    <li><a href="#"><i class="fa fa-group"></i> Pessoas Jurídica</a></li>
                        <li class="treeview {{ Request::is('*auxiliares*') ? 'active item-menu' : '' }}">
                            <a href="#">
                                <span>
                                    <i class="fa fa-tag"></i> Outros Cadastros
                                </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Request::is('*racas') ? 'active item-menu' : '' }}">
                                    <a href="{{ '' }}"><i class="fa fa-tags"></i>Raças</a></li>
                                <li class="{{ Request::is('*cors') ? 'active item-menu' : '' }}">
                                    <a href="{{ '' }}"><i class="fa fa-tags"></i>Cores</a></li>
                                <li class="{{ Request::is('*escolaridades') ? 'active item-menu' : '' }}">
                                    <a href="{{ '' }}"><i class="fa fa-tags"></i>Escolaridades</a></li>
                                <li class="{{ Request::is('*estados') ? 'active item-menu' : '' }}">
                                    <a href="{{ '' }}"><i class="fa fa-tags"></i>Estados</a></li>
                                <li class="{{ Request::is('*cidades') ? 'active item-menu' : '' }}">
                                    <a href="{{ '' }}"><i class="fa fa-tags"></i>Cidades</a></li>
                                <li class="{{ Request::is('*estadocivils') ? 'active item-menu' : '' }}">
                                    <a href="{{ '' }}"><i class="fa fa-tags"></i>Estados Civis</a></li>
                                <li class="{{ Request::is('*grupos') ? 'active item-menu' : '' }}">
                                    <a href="{{ '' }}"><i class="fa fa-tags"></i>Grupos</a></li>
                            </ul>
                        </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class='fa fa-dollar'></i>
                    <span>Financeiro</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-truck"></i> Fornecedores</a></li>
                    <li><a href="#"><i class="fa fa-sign-in"></i> Receitas</a></li>
                    <li><a href="#"><i class="fa fa-list"></i> Cotações</a></li>
                    <li><a href="#"><i class="fa fa-truck"></i> Despesas</a></li>
                    <li><a href="#"><i class="fa fa-sign-out"></i> Documentos Pagamentos</a></li>
                    <li><a href="#"><i class="fa fa-inbox"></i> Contas</a></li>
                    <li><a href="#"><i class="fa fa-check-circle"></i> Prestações Contas</a></li>
                    <li><a href="#"><i class="fa fa-bus"></i> Materiais Permanentes</a></li>
                    <li><a href="#"><i class="fa fa-newspaper-o"></i> Editais Licitações</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class='fa fa-archive'></i>
                    <span>Produto</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-shopping-cart"></i>Itens/Produtos</a></li>
                    <li><a href="#"><i class="fa fa-server"></i>Categorias</a></li>
                    <li><a href="#"><i class="fa fa-exchange"></i>Colunas</a></li>
                    <li><a href="#"><i class="fa fa-list-alt"></i>Colunas categorias</a></li>
                    <li><a href="#"><i class="fa fa-check"></i>Homologar Produtos</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i>Unidades de Medida</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('orcamentario*') ? 'active' : '' }}">
                <a href="#">
                    <i class='fa fa-refresh'></i>
                    <span>Orçamentário</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            Cronogramas
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-sign-in"></i>
                            Receitas
                        </a>
                    </li>
                    <li class="{{ Request::is('orcamentario/fontes') ? 'active item-menu' : '' }}">
                        <a href="{{ '' }}">
                            <i class="fa fa-database"></i>
                            Fontes
                        </a>
                    </li>
                    <li class={{ Request::is('*orcamentario/objetofontes*') ? 'active item-menu' : '' }}>
                        <a href="{{ '' }}">
                            <i class="fa fa-ellipsis-v"></i>
                            Objetos Fontes
                        </a>
                    </li>
                    <li class="{{ Request::is('*tipofontes*') ? 'active item-menu' : '' }}">
                        <a href="{{ '' }}">
                            <i class="fa fa-random"></i>
                            Tipos Fontes
                        </a>
                    </li>
                    <li class="{{ Request::is('*programadesembolsos*') ? 'active item-menu' : '' }}">
                        <a href="{{ '' }}">
                            <i class="fa fa-dollar"></i>
                            Programas Desembolsos
                        </a>
                    </li>
                    <li class="{{ Request::is('*elementodesembolsos*') ? 'active item-menu' : '' }}">
                        <a href="{{ '' }}">
                            <i class="fa fa-sign-out"></i>
                            Elementos de Despesa
                            </a>
                    </li>
                    <li class="{{ Request::is('*fontedesembolsos*') ? 'active item-menu' : '' }}">
                        <a href="{{ '' }}">
                            <i class="fa fa-cloud"></i>
                            Fontes Desembolsos
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class='fa fa-suitcase'></i>
                        <span>Administrativo</span>
                        <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-building"></i>
                            Unidades Executoras
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-group"></i>
                            Lotações
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-inbox"></i>
                            Contas
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-credit-card"></i>
                            Bancos
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class='fa fa-money'></i>
                    <span>Prestação Contas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-check"></i>Prestação de Contas</a></li>
                    <li><a href="#"><i class="fa fa-book"></i>Legislações</a></li>
                    <li><a href="#"><i class="fa fa-th-list"></i>Itens Análises</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
