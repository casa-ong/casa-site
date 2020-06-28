
        <div class="item-black">
            <form id="news-form"  action="{{ route('newsletter.salvar') }}#newsletter" method="POST" enctype="multipart/form-data">
        
                @if(Session::has('newsletter'))
                    <div class="alert alert-success text-center">
                        <p>{{ Session::get('newsletter') }}</p>
                    </div>
                @endif
                
                <div class="input-field">
                    {{ csrf_field() }}
                        <label id="newsletter" for="email_newsletter">Receba <strong>novidades<br></strong> por email</label>
                        <input id="email_newsletter" name="email_newsletter" class="{{ $errors->has('email_newsletter') ? 'error' : '' }}" type="text" placeholder="Digite seu email para se cadastrar" style="max-width: 300px;">
                        @error('email_newsletter')
                            <p class="error error-dark" onclick="$(this).toggle('hide')">{{ $message }}</p>
                        @enderror
                    <div class="input-btn m-0">
                        <button form="news-form" type="submit" class="btn btn-dark">Cadastrar-se</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="item">
            <div class="social-icons">

                @php($sobre = App\Sobre::latest('updated_at')->first())
				
                @if(isset($sobre->twitter))
                    <a class="social-icon" href="{{ isset($sobre->twitter) ? $sobre->twitter : '#' }}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                @endif

                @if(isset($sobre->instagram))
                    <a class="social-icon" href="{{ isset($sobre->instagram) ? $sobre->instagram : '#' }}" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif

                @if(isset($sobre->facebook))
                    <a class="social-icon" href="{{ isset($sobre->facebook) ? $sobre->facebook : '#' }}" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                @endif
                
            </div>
            @if(isset($sobre->email))
				<p>E-mail: <a href="mailto:{{ isset($sobre->email) ? $sobre->email : '#' }}">
                    {{ $sobre->email ?? '' }}
                </a></p>
			@endif
            <p>&copy; 2020 Todos os direitos reservados.</p>
        </div>

        <script src="{{ asset('js/summernote_config.js') }}"></script>
        @yield('scripts')
    </footer>
</body>
</html>

