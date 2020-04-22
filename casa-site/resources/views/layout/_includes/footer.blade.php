
        <div class="item-black">
            <div class="input-field">
                <label for="item-title">Receba novidades</label>
                <input name="email" type="text" placeholder="Digite seu email para se cadastrar">
                <a href="#noticias" class="btn btn-dark">Enviar</a>
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