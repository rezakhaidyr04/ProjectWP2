<?php

namespace App\Http\Controllers;

use App\Models\GameReview;
use App\Models\GamePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display reviews for a specific game
     */
    public function index($gamePackageId)
    {
        $game = GamePackage::findOrFail($gamePackageId);
        $reviews = GameReview::where('game_package_id', $gamePackageId)
            ->with('user')
            ->latest()
            ->paginate(10);

        $avgRating = GameReview::getAverageRating($gamePackageId);
        $ratingDist = GameReview::getRatingDistribution($gamePackageId);
        $userReview = Auth::check() ? 
            GameReview::where('game_package_id', $gamePackageId)
                ->where('user_id', Auth::id())
                ->first() : null;

        return view('reviews.index', compact('game', 'reviews', 'avgRating', 'ratingDist', 'userReview'));
    }

    /**
     * Show review form
     */
    public function create($gamePackageId)
    {
        $game = GamePackage::findOrFail($gamePackageId);
        $existing = GameReview::where('game_package_id', $gamePackageId)
            ->where('user_id', Auth::id())
            ->first();

        return view('reviews.create', compact('game', 'existing'));
    }

    /**
     * Store a new review
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_package_id' => 'required|exists:game_packages,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10|max:500',
        ]);

        $validated['user_id'] = Auth::id();

        // Check if user already reviewed this game
        $existing = GameReview::where('game_package_id', $validated['game_package_id'])
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            $existing->update($validated);
            return redirect()->route('reviews.index', $validated['game_package_id'])
                ->with('success', 'Review diperbarui!');
        }

        GameReview::create($validated);

        return redirect()->route('reviews.index', $validated['game_package_id'])
            ->with('success', 'Review ditambahkan! Terima kasih atas feedback Anda.');
    }

    /**
     * Show a review
     */
    public function show(GameReview $review)
    {
        return response()->json($review->load('user', 'gamePackage'));
    }

    /**
     * Mark review as helpful
     */
    public function markHelpful(GameReview $review)
    {
        $review->increment('helpful_count');
        return response()->json(['success' => true, 'helpful_count' => $review->helpful_count]);
    }

    /**
     * Delete a review
     */
    public function destroy(GameReview $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $gameId = $review->game_package_id;
        $review->delete();

        return redirect()->route('reviews.index', $gameId)
            ->with('success', 'Review dihapus.');
    }
}
