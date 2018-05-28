@foreach ($specs as $spec)
    @include('Specs::fields.'.$spec->type)
@endforeach