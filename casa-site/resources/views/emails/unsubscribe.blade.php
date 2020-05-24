@component('mail::message')

<h1>{{ $detalhes['titulo'] ?? '' }}</h1>

<br>

{{ $detalhes['texto'] ?? '' }}  

<br>

{{ $detalhes['info'] ?? '' }}
  

@component('mail::button', ['url' => $detalhes['url']])

Ver texto completo

@endcomponent

   

Com carinho,<br>

{{ config('app.name') }}

<p style="font-size: 12px;">Se deseja deixar de receber e-mails <a href="{{ config('app.url').'/newsletter/editar/'.$detalhes['newsletter_id'] }}">descadastre-se</a></p>

@endcomponent