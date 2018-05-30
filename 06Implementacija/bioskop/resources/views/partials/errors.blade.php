
{{-- Ako postje greske validacije ispisati ih kao listu u alertu danger --}}
@if($errors->any())
    <div class="alert alert-danger my-4">
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>
@endif

{{-- Ako postoje greske koje prijavlje neki cusom exception i stavlja u sessiju --}}
@if(session() -> has('error'))
<div class="alert alert-danger">
    {{ session() -> get('error') }}
</div>
@endif
