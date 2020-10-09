@php
    $registro = App\Models\Enquete::where('is_aberta', 1)->latest()->first();
@endphp
@if(isset($registro))
<section class="floating">
    <label class="floating-header">
        <p>{{ Session::has('success') ? Session::get('success') : 'Enquete disponível, vote agora!' }} &nbsp;
            <span class="fa fa-chevron-up"></span>
        </p>
    </label>
    <div class="floating-body">
        <div class="item-form">
            <form action="{{ route('site.enquete.votar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('site.enquetes._form')
                @if($registro->is_aberta)
                    <div class="input-btn">
                        <input type="submit" class="btn btn-green" value="Votar">
                    </div>
                @endif
            </form>
        </div>
    </div>
    
</section>
@endif
