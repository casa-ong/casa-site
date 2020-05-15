
        <div class="item-black">
            <div class="input-field">
                <form id="form-btn"  action="{{ route('newsletter.salvar') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <label for="item-title">Receba novidades</label>
                        <input name="email" class="{{ $errors->has('email') ? 'error' : '' }}" type="text" value="{{ isset($registro->email) ? $registro->email : '' }}" placeholder="Digite seu email para se cadastrar">
                        @error('email')
                            <p class="error" style="color: #D3D3D3;">{{ $message }}</p>
                        @enderror
                    <div class="input-btn">
                        <button form="form-btn" type="submit" class="btn">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="item">
            <div class="social-icons">
                <a class="social-icon" href="{{ isset($sobre->twitter) ? $sobre->twitter : '#' }}" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="social-icon" href="{{ isset($sobre->instagram) ? $sobre->instagram : '#' }}" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="social-icon" href="{{ isset($sobre->facebook) ? $sobre->facebook : '#' }}" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>
            <p>© 2020 Todos os direitos reservados.</p>
        </div>

        <script src="{{ asset('js/summernote_config.js') }}"></script>
        @yield('scripts')
    </footer>
</body>
</html>