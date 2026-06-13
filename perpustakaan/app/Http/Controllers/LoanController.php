<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;

class LoanController extends Controller
{
    // 📌 1. Tampilkan semua data peminjaman
    public function index()
    {
        $loans = Loan::with(['member', 'book'])->get();

        return view('loans.index', compact('loans'));
    }

    // 📌 2. Form tambah peminjaman
    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('loans.create', compact('members', 'books'));
    }

    // 📌 3. Simpan data peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'book_id' => 'required',
            'loan_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        // 🔥 CEK STOK
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        // 🔥 SIMPAN LOAN
        Loan::create([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => 'dipinjam'
        ]);

        // 🔥 KURANGI STOK
        $book->stock -= 1;
        $book->save();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil!');
    }

    // 📌 4. Detail (optional)
    public function show($id)
    {
        $loan = Loan::with(['member', 'book', 'fine'])->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    // 📌 5. Form edit (optional)
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $members = Member::all();
        $books = Book::all();

        return view('loans.edit', compact('loan', 'members', 'books'));
    }

    // 📌 6. Update data
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $loan->update($request->all());

        return redirect()->route('loans.index')->with('success', 'Data berhasil diupdate');
    }

    // 📌 7. Hapus data
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Data berhasil dihapus');
    }

    // 📌 8. Pengembalian buku (🔥 FITUR PENTING)
    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);

        // update status & tanggal kembali
        $loan->return_date = now();
        $loan->status = 'dikembalikan';
        $loan->save();

        // 🔥 TAMBAH STOK LAGI
        $book = Book::find($loan->book_id);
        $book->stock += 1;
        $book->save();

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan');
    }
}
