<?php

namespace App\Http\Controllers\Entries\Ajax;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Entries\Entry;

class EntryController extends Controller
{
    public $entry;

    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    /**
     * Get all entries for user for current date.
     *
     * @return JsonResponse
     */
    public function current(): JsonResponse
    {
        $current = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        
        if (is_null($user)):
            return response()->json(
                'Could not retrieve auth user - check user is logged in'
            , 422);
        endif;

        return response()->json(
            $this->entry->where('user_id', $user->id)
                        ->whereDate('created_at', '>=', $current . ' 00:00:00')
                        ->get()
        , 200);
    }

    /**
     * Save new entry for user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (is_null($user)):
            return response()->json(
                'Could not retrieve auth user - check user is logged in'
            , 422);
        endif;

        return response()->json();
    }
}
