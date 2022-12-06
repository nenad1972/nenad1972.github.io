@extends('layout.app')
@section('content')
<form action="show_member" method="get">
    @csrf
    <button type="submit" class="btn btn-primary">show member page</button>
</form>
@endsection