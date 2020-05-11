<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                <img src="{{ isset($banner) ? asset($banner) : asset('img/banner/casa-banner.png') }}" style="max-width: 400px; width: 100%;" alt="Centro de Apoio Social e Ambiental: Plantando o amanhã">
                {{-- <h1>Centro de Apoio Social e Ambiental</h1>
                <h2 style="text-transform: uppercase; font-weight: normal; text-align: center;">Plantando o amanhã</h2> --}}
                {{-- $slot --}}
            @endif
        </a>
    </td>
</tr>
