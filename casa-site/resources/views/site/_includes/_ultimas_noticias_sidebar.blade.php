    <h1>Últimas <strong>notícias</strong></h1>
    <div class="row align-center">

        @if(isset($noticias) && count($noticias) > 0)
        @foreach ($noticias as $noticia)
            @include('site.noticias._card')
        @endforeach
        @else
            <p>Ops, ainda não temos nenhuma novidade...</p>
        @endif

    </div>