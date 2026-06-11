@extends('layouts.master')

@section('content')
<h1>Daftar Buku</h1>

@foreach($books as $book)
    <p>{{ $book->title }} - {{ $book->author }}</p>
@endforeach

@endsection
