<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameTransaction;
use App\Models\User;
use App\Models\GamePackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Only admins can access
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Akses ditolak');
            }
            return $next($request);
        });
    }

    /**
     * Tampilkan dashboard admin
     */
    public function index()
    {
        // Main Statistics
        $totalUsers = User::count();
        $totalTransactions = GameTransaction::count();
        $completedTransactions = GameTransaction::where('status', 'completed')->count();
        $totalRevenue = GameTransaction::where('status', 'completed')->sum('total_price');
        $pendingTransactions = GameTransaction::where('status', 'pending')->count();
        $failedTransactions = GameTransaction::where('status', 'failed')->count();
        $totalGames = GamePackage::count();

        // Recent transactions for the table
        $recentTransactions = GameTransaction::with(['user', 'gamePackage'])
            ->orderBy('created_at', 'desc')
            ->limit(7)
            ->get();

        // Data for the transaction chart (last 7 days)
        $transactionChartData = GameTransaction::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed'),
                DB::raw('SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending'),
                DB::raw('SUM(CASE WHEN status = "failed" THEN 1 ELSE 0 END) as failed')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date)->format('d M');
                return $item;
            });

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTransactions',
            'completedTransactions',
            'totalRevenue',
            'pendingTransactions',
            'failedTransactions',
            'totalGames',
            'recentTransactions',
            'transactionChartData'
        ));
    }

    /**
     * Tampilkan daftar semua transaksi
     */
    public function transactions()
    {
        $transactions = GameTransaction::with(['user', 'gamePackage'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.transactions', compact('transactions'));
    }

    /**
     * Detail transaksi
     */
    public function transactionDetail($id)
    {
        $transaction = GameTransaction::with(['user', 'gamePackage'])
            ->findOrFail($id);

        return view('admin.transaction-detail', compact('transaction'));
    }

    /**
     * Update status transaksi
     */
    public function updateTransactionStatus($id)
    {
        $transaction = GameTransaction::findOrFail($id);
        $status = request()->input('status');

        if (!in_array($status, ['pending', 'completed', 'failed'])) {
            return response()->json(['error' => 'Status tidak valid'], 400);
        }

        $transaction->update([
            'status' => $status,
            'notes' => request()->input('notes', $transaction->notes),
        ]);

        return response()->json(['success' => true, 'message' => 'Status diperbarui']);
    }

    /**
     * Daftar pengguna
     */
    public function users()
    {
        $users = User::withCount('transactions')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * Game packages management
     */
    public function gamePackages()
    {
        $packages = GamePackage::withCount('transactions')
            ->orderBy('game_name')
            ->paginate(20);

        return view('admin.game-packages', compact('packages'));
    }

    /**
     * Update game package status
     */
    public function updatePackageStatus($id)
    {
        $package = GamePackage::findOrFail($id);
        $is_active = request()->input('is_active');

        $package->update([
            'is_active' => (bool)$is_active,
        ]);

        return response()->json(['success' => true]);
    }
}
