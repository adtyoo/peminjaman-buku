<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:user']);
    }

    public function index()
    {
        return Borrowing::with('details.book')
            ->where('user_id', auth()->id())
            ->get();
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $borrowing = Borrowing::create([
                'user_id' => auth()->id(),
                'borrow_date' => now(),
                'return_due_date' => now()->addDays(7),
                'status' => 'dipinjam'
            ]);

            foreach ($request->books as $item) {

                $book = Book::findOrFail($item['book_id']);

                if ($book->stock_available < $item['qty']) {
                    throw new \Exception('Stok tidak cukup');
                }

                BorrowingDetail::create([
                    'borrowing_id' => $borrowing->id,
                    'book_id' => $book->id,
                    'qty' => $item['qty']
                ]);

                // kurangi stok
                $book->decrement('stock_available', $item['qty']);
            }

            DB::commit();
            return response()->json(['message'=>'Peminjaman berhasil']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 400);
        }
    }
}
