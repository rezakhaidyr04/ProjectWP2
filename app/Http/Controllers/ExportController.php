<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show export form
     */
    public function create()
    {
        return view('export.create');
    }

    /**
     * Export transactions to PDF
     */
    public function pdf(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:pending,completed,failed',
        ]);

        $query = Auth::user()->transactions();

        if ($validated['start_date'] ?? null) {
            $query->whereDate('created_at', '>=', $validated['start_date']);
        }
        if ($validated['end_date'] ?? null) {
            $query->whereDate('created_at', '<=', $validated['end_date']);
        }
        if ($validated['status'] ?? null) {
            $query->where('status', $validated['status']);
        }

        $transactions = $query->latest()->get();

        $total = $transactions->sum('amount');
        $count = $transactions->count();

        $pdf = Pdf::loadView('export.pdf', compact('transactions', 'total', 'count'))
            ->setOption('margin-top', 15)
            ->setOption('margin-bottom', 15);

        return $pdf->download('transaksi-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }

    /**
     * Export transactions to CSV
     */
    public function csv(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:pending,completed,failed',
        ]);

        $query = Auth::user()->transactions();

        if ($validated['start_date'] ?? null) {
            $query->whereDate('created_at', '>=', $validated['start_date']);
        }
        if ($validated['end_date'] ?? null) {
            $query->whereDate('created_at', '<=', $validated['end_date']);
        }
        if ($validated['status'] ?? null) {
            $query->where('status', $validated['status']);
        }

        $transactions = $query->latest()->get();

        return Excel::download(
            new \App\Exports\TransactionsExport($transactions),
            'transaksi-' . now()->format('Y-m-d-H-i-s') . '.csv'
        );
    }

    /**
     * Export reviews
     */
    public function reviews(Request $request)
    {
        $gameId = $request->query('game_id');

        $query = Auth::user()->reviews();

        if ($gameId) {
            $query->where('game_package_id', $gameId);
        }

        $reviews = $query->with('gamePackage')->latest()->get();

        $pdf = Pdf::loadView('export.reviews', compact('reviews'))
            ->setOption('margin-top', 15)
            ->setOption('margin-bottom', 15);

        return $pdf->download('reviews-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }

    /**
     * Export wishlist
     */
    public function wishlist()
    {
        $wishlists = Auth::user()->wishlists()
            ->with('gamePackage')
            ->get();

        $pdf = Pdf::loadView('export.wishlist', compact('wishlists'))
            ->setOption('margin-top', 15)
            ->setOption('margin-bottom', 15);

        return $pdf->download('wishlist-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }

    /**
     * Get transaction statistics for export
     */
    public function stats()
    {
        $user = Auth::user();
        $totalSpent = $user->transactions()->where('status', 'completed')->sum('amount');
        $totalTransactions = $user->transactions()->count();
        $completedTransactions = $user->transactions()->where('status', 'completed')->count();

        return response()->json([
            'total_spent' => $totalSpent,
            'total_transactions' => $totalTransactions,
            'completed_transactions' => $completedTransactions,
            'average_transaction' => $totalTransactions > 0 ? round($totalSpent / $completedTransactions, 0) : 0,
        ]);
    }
}
