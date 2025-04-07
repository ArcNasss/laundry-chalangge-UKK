<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['outlet'])->where('member_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('member.transaction.index', compact('transactions'));
    }

    // Download bukti transaksi untuk member
    public function downloadProof($id)
    {
        $transaction = Transaction::with(['member', 'outlet', 'transactionDetails.package'])
            ->findOrFail($id);
        
        // Validasi bahwa transaksi ini milik member yang login (untuk keamanan)
        if (Auth::guard('member')->check() && $transaction->member_id != Auth::id()) {
            abort(403);
        }
        
        $pdf = PDF::loadView('transactions.proof', compact('transaction'));
        
        return $pdf->download('bukti-transaksi-'.$transaction->invoice_code.'.pdf');
    }

    public function downloadSingle(Transaction $transaction)
    {
        $transaction->load(['member', 'outlet', 'transactionDetails.package']);
        
        $pdf = PDF::loadView('admin.transactions.single', compact('transaction'));
        
        return $pdf->download('transaction-'.$transaction->invoice_code.'.pdf');
    }

    public function downloadAll(Request $request)
    {
        $query = Transaction::query()
            ->with(['member', 'outlet', 'transactionDetails.package'])
            ->orderBy('tanggal', 'desc');

        // If specific IDs are provided (for selected download)
        if ($request->has('ids')) {
            $ids = explode(',', $request->ids);
            $query->whereIn('id', $ids);
        }

        // Apply filters if present
        $query->when($request->has('start_date'), function ($q) use ($request) {
            $q->where('tanggal', '>=', $request->start_date);
        })
        ->when($request->has('end_date'), function ($q) use ($request) {
            $q->where('tanggal', '<=', $request->end_date);
        })
        ->when($request->has('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        })
        ->when($request->has('dibayar'), function ($q) use ($request) {
            $q->where('dibayar', $request->dibayar);
        });

        $transactions = $query->get();

        $pdf = PDF::loadView('admin.transactions.all', [
            'transactions' => $transactions,
            'start_date' => $request->start_date ?? null,
            'end_date' => $request->end_date ?? null,
        ]);

        $filename = $request->has('ids') 
            ? 'selected-transactions-'.now()->format('YmdHis').'.pdf'
            : 'all-transactions-'.now()->format('YmdHis').'.pdf';

        return $pdf->download($filename);
    }

    // Form untuk filter download all
    public function downloadForm()
    {
        return view('admin.transactions.download-form');
    }
}