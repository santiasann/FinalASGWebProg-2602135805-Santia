<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Whistlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WhistlistController extends Controller
{
    //
    public function toggleWishlist(User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->whistlist->contains($user)) {
            $currentUser->whistlist()->detach($user);
        } else {
            $currentUser->whistlist()->attach($user);
        }

        return redirect()->back();
    }
    public function showWishlist()
    {
        $user = Auth::user();
        $wishlists = DB::table('whistlist')
            ->join('user', 'whistlists.wishlist_user_id', '=', 'user.id')
            ->where('whistlists.user_id', $user->id)
            ->get(['user.name', 'user.profile_picture', 'user.profession', 'user.field_of_work']);

        return view('whistlist', compact('wishlists'));
    }

    public function checkMutual(Request $request)
    {
        $mutualUsers = Whistlist::where('user_id', Auth::id())
            ->whereHas('reverseWishlist', function ($query) {
                $query->where('friend_id', Auth::id());
            })
            ->get();

        return view('mutual-friends', compact('mutualUsers'));
    }
    public function acceptRequest($id)
    {
        $user = Auth::user();
    
        // Cek apakah ada permintaan teman dari User 1 ke User 2
        $incomingRequest = Whistlist::where('user_id', $id)
            ->where('wishlist_user_id', $user->id)
            ->first();
    
        if ($incomingRequest) {
            // Buat koneksi dua arah
            Whistlist::updateOrCreate(
                ['user_id' => $user->id, 'wishlist_user_id' => $id],
                ['created_at' => now(), 'updated_at' => now()]
            );
    
            Whistlist::updateOrCreate(
                ['user_id' => $id, 'wishlist_user_id' => $user->id],
                ['created_at' => now(), 'updated_at' => now()]
            );
    
            // Hapus permintaan teman asli
            $incomingRequest->delete();
    
            return redirect()->route('notifications')->with('success', 'Friend request accepted.');
        }
    
        return redirect()->route('notifications')->with('error', 'Friend request not found.');
    }
}
