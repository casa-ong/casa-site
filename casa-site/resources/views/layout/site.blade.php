@include('layout._includes.header')

@yield('banner')

<div class="container">
@yield('conteudo')
</div>
@yield('floating_content')

<footer>
@include('layout._includes.footer')
