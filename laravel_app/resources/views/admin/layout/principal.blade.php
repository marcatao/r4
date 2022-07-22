<!DOCTYPE html>
<html>

@include('admin.layout.head')
@yield('estilos')
<body class="">

    <div id="wrapper">

        
        @include('admin.layout.menu_lateral')

        <div id="page-wrapper" class="gray-bg">
            @include('admin.layout.menu_superior') 
            
            <div class="wrapper wrapper-content">
                @yield('conteudo')
                @include('admin.layout.rodape')
            </div>        

        </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('admin/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('admin/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin/js/bootstrap.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('admin/js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/toastr/toastr.min.js')}}"></script>    


    <script src="{{ asset('admin/js/inspinia.js')}}"></script>
    @yield('scripts')
    @yield('scripts2')
</body>

</html>
