<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ ucfirst(trans(Auth::user()->ShortName)) }}</span>
                        <span class="block m-t-xs font-bold">{{ ucfirst(trans(Auth::user()->perfil)) }}</span>
                    </a>
 
                </div>
                <div class="logo-element">
                   R4
                </div>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Cadastros</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('admin-users') }}">Usuários</a></li>
                    <li><a href="{{ route('admin-aulas') }}">Aulas</a></li>
                 </ul>
            </li>
            <li >
                <a href="{{ route('admin_index') }}">
                    <i class="fa fa-laptop"></i> <span class="nav-label">Operação</span> 
                </a>
            </li>
            <!--
            <li >
                <a href="{{ route('admin-calendario') }}">
                    <i class="fa fa-calendar"></i> <span class="nav-label">Agendas</span> 
                </a>
            </li>-->
            <li>
                <a href="index.html"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Relatórios</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('admin-relatorio-professores') }}">Professores</a></li>
                    <li><a href="{{ route('admin-relatorio-alunos') }}">Alunos</a></li>
                </ul>
            </li>
             
 

        </ul>

    </div>
</nav>