@extends('layouts.master')

@section('content')

<h2>Data Peminjaman Buku</h2>

{{-- 🔔 Notifikasi --}}
@if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif

<br>

<a href="{{ route('loans.create') }}">+ Tambah Peminjaman</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Member</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($loans as $index => $loan)
        <tr>
            <td>{{ $index + 1 }}</td>

            <td>{{ $loan->member->name ?? '-' }}</td>

            <td>{{ $loan->book->title ?? '-' }}</td>

            <td>{{ $loan->loan_date }}</td>

            <td>{{ $loan->due_date }}</td>

            <td>{{ $loan->return_date ?? '-' }}</td>

            <td>
                @if($loan->status == 'dipinjam')
                    <span style="color: orange;">Dipinjam</span>
                @else
                    <span style="color: green;">Dikembalikan</span>
                @endif
            </td>

            <td>
                {{-- Tombol Kembalikan --}}
                @if($loan->status == 'dipinjam')
                    <a href="{{ route('loans.return', $loan->id) }}">
                        Kembalikan
                    </a>
                @endif

                <br>

                {{-- Edit --}}
                <a href="{{ route('loans.edit', $loan->id) }}">
                    Edit
                </a>

                <br>

                {{-- Hapus --}}
                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="8" align="center">Belum ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
