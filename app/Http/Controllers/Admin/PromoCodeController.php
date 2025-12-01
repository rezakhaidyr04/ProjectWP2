<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Services\PromoCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Akses ditolak');
            }
            return $next($request);
        });
    }

    /**
     * List promo codes
     */
    public function index()
    {
        $promoCodes = PromoCode::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.promo-codes.index', compact('promoCodes'));
    }

    /**
     * Create promo code form
     */
    public function create()
    {
        return view('admin.promo-codes.create');
    }

    /**
     * Store new promo code
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:promo_codes,code',
            'description' => 'nullable|string',
            'type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'max_usage' => 'nullable|integer|min:1',
            'max_usage_per_user' => 'required|integer|min:1',
            'valid_from' => 'required|date_format:Y-m-d H:i',
            'valid_until' => 'required|date_format:Y-m-d H:i|after:valid_from',
        ]);

        PromoCode::create([
            'code' => strtoupper($validated['code']),
            'description' => $validated['description'],
            'type' => $validated['type'],
            'discount_value' => $validated['discount_value'],
            'max_discount' => $validated['max_discount'],
            'max_usage' => $validated['max_usage'],
            'max_usage_per_user' => $validated['max_usage_per_user'],
            'valid_from' => $validated['valid_from'],
            'valid_until' => $validated['valid_until'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.promo-codes.index')
            ->with('success', 'Kode promo berhasil dibuat');
    }

    /**
     * Edit promo code
     */
    public function edit(PromoCode $promoCode)
    {
        return view('admin.promo-codes.edit', compact('promoCode'));
    }

    /**
     * Update promo code
     */
    public function update(Request $request, PromoCode $promoCode)
    {
        $validated = $request->validate([
            'code' => 'required|unique:promo_codes,code,' . $promoCode->id,
            'description' => 'nullable|string',
            'type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'max_usage' => 'nullable|integer|min:1',
            'max_usage_per_user' => 'required|integer|min:1',
            'valid_from' => 'required|date_format:Y-m-d H:i',
            'valid_until' => 'required|date_format:Y-m-d H:i|after:valid_from',
            'is_active' => 'required|boolean',
        ]);

        $promoCode->update($validated);

        return redirect()->route('admin.promo-codes.index')
            ->with('success', 'Kode promo berhasil diperbarui');
    }

    /**
     * Delete promo code
     */
    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        return response()->json(['success' => true]);
    }

    /**
     * API endpoint untuk validate promo code
     */
    public function validate(Request $request)
    {
        $promoCode = $request->input('promo_code');
        $totalPrice = $request->input('total_price');
        $userId = Auth::id();

        $result = PromoCodeService::applyPromoCode($userId, $promoCode, $totalPrice);

        return response()->json($result);
    }
}
