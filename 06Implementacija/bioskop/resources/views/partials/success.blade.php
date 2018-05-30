{{-- Alert kada je izvrsen neka uspesna akcija ispisuje sadrzaj poruke u alertu iz sesije pod kljucem 'success' --}}
@if(session() -> has('success'))
<div class="my-4 alert alert-success text-center">
    {{ session() -> get('success') }}
</div>
@endif