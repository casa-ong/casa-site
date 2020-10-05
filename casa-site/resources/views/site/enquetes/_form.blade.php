<div class="form-group" id="radio-group-anexo">
    <h2 class="@error('opcao') is-invalid @enderror">{{ $registro->texto }}</h2>
    <p>Escolha uma opção</p>
    @foreach ($registro->opcao as $index => $opcao)
        <label class="radio-option" for="{{ $opcao->id }}">
            <input {{ $registro->is_aberta ? '' : 'disabled' }} type="radio" name="opcao" id="{{ $opcao->id }}" value="{{ $opcao->id }}">
            {{ $opcao->nome }} @auth {{ '('.($opcao->votos ?? '0').' votos)' }} @endauth
            <div class="{{ isset($opcao->foto) ? 'img-zoomable' : '' }}" width="100px" height="100%" style="background: url('{{ isset($opcao->foto) ? asset($opcao->foto) : '' }}'); background-size: contain" alt=""></div>
        </label>
    @endforeach
    @error('opcao')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
{{-- Overlay para mostrar imagens aumentadas --}}
<div class="overlay"></div>

@if(env('APP_ENV') == 'testing')
    <input type="text" name="g-recaptcha-response" value="1" style="visibility: hidden;">
@else
    <div class="form-group row">	
        <div class="g-recaptcha {{$errors->has('g-recaptcha-response') ? ' has-error' : '' }}" data-sitekey="{!! env('NOCAPTCHA_SITEKEY', 'NOKEYFOUND') !!}"></div>
        
            @if ($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback" style="display: block;">
                        {{ $errors->first('g-recaptcha-response') }}
                </span>      
            @endif

    </div>
@endif

@section('scripts')

    <script>
        // Image to Lightbox Overlay 
        let images = document.querySelectorAll(".img-zoomable");
        let overlay = document.querySelector(".overlay");

        for(let i = 0; i < images.length; i++) {
            images[i].addEventListener("click", function() {
                overlay.style.backgroundImage = images[i].style.backgroundImage;
                overlay.classList.toggle("open");
            });
        }

        overlay.addEventListener("click", function() {
            overlay.classList.toggle("open"); 
        });
        
    </script>

@endsection