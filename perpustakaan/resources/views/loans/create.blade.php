@extends('layouts.master')

@section('content')

<h2>Tambah Peminjaman Buku</h2>

{{-- 🔴 Error validasi --}}
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<br>

<form action="{{ route('loans.store') }}" method="POST">
    @csrf

    {{-- 👤 Member --}}
    <label>Member:</label><br>
    <select name="member_id" required>
        <option value="">-- Pilih Member --</option>
        @foreach($members as $member)
            <option value="{{ $member->id }}">
                {{ $member->name }}
            </option>
        @endforeach
    </select>
    <br><br>

    {{-- 📚 Buku --}}
    <label>Buku:</label><br>
    <select name="book_id" required>
        <option value="">-- Pilih Buku --</option>
        @foreach($books as $book)
            <option value="{{ $book->id }}">
                {{ $book->title }} (Stok: {{ $book->stock }})
            </option>
        @endforeach
    </select>
    <br><br>

    {{-- 📅 Tanggal Pinjam --}}
    <label>Tanggal Pinjam:</label><br>
    <input type="date" name="loan_date" required>
    <br><br>

    {{-- 📅 Jatuh Tempo --}}
    <label>Jatuh Tempo:</label><br>
    <input type="date" name="due_date" required>
    <br><br>

    {{-- 🚀 Submit --}}
    <button type="submit">Simpan</button>

    <a href="{{ route('loans.index') }}">Kembali</a>
</form>

@endsection
