<?php

namespace App\Http\Controllers;

use App\Models\ReturnModel;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $borrowing = Borrowing::with('details.book')
                ->findOrFail($request->borrowing_id);

            // hitung denda
            $lateDays = now()->diffInDays(
                $borrowing->return_due_date,
                false
            );

            $fine = 0;
            if ($lateDays < 0) {
                $fine = abs($lateDays) * 1000;
            }

            ReturnModel::create([
                'borrowing_id' => $borrowing->id,
                'return_date' => now(),
                'fine' => $fine,
                'condition_note' => $request->condition_note,
                'processed_by' => auth()->id()
            ]);

            // kembalikan stok
            foreach ($borrowing->details as $detail) {
                $detail->book->increment('stock_available', $detail->qty);
            }

            $borrowing->update([
                'status' => 'dikembalikan'
            ]);

            DB::commit();
            return response()->json(['message'=>'Pengembalian berhasil']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 400);
        }
    }
}
