<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\GamePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user's wishlist
     */
    public function index()
    {
        $wishlists = Auth::user()->wishlists()
            ->with('gamePackage')
            ->latest()
            ->paginate(12);

        return view('wishlist.index', compact('wishlists'));
    }

    /**
     * Add game to wishlist
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_package_id' => 'required|exists:game_packages,id',
        ]);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('game_package_id', $validated['game_package_id'])
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Game sudah ada di wishlist Anda'
            ], 422);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'game_package_id' => $validated['game_package_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ditambahkan ke wishlist!'
        ]);
    }

    /**
     * Remove from wishlist
     */
    public function destroy($gamePackageId)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('game_package_id', $gamePackageId)
            ->firstOrFail();

        $wishlist->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Dihapus dari wishlist']);
        }

        return redirect()->back()->with('success', 'Dihapus dari wishlist');
    }

    /**
     * Check if game is in wishlist
     */
    public function check($gamePackageId)
    {
        if (!Auth::check()) {
            return response()->json(['in_wishlist' => false]);
        }

        $inWishlist = Wishlist::where('user_id', Auth::id())
            ->where('game_package_id', $gamePackageId)
            ->exists();

        return response()->json(['in_wishlist' => $inWishlist]);
    }
}
