<?php

namespace App\Http\Controllers\Entries\Ajax;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Entries\Entry;
use App\Models\Entries\EntryType;

class EntryController extends Controller
{
    public $entry;
    public $type;

    public function __construct(Entry $entry, EntryType $type)
    {
        $this->entry = $entry;
        $this->type = $type;
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
                        ->with(['type'])
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
        elseif (is_null($request->type)):
            return response()->json(
                'type parameter missing or null'
            , 400);
        elseif (!in_array($request->type, ['work', 'break'])):
            return response()->json(
                'type parameter must be work or break'
            , 400);
        endif;

        $entry = $this->entry->create([
                    'user_id' => $user->id,
                    'entry_type_id' => $this->type->where('name', $request->type)->first()->id, 
                    'start_time' => Carbon::now(), 
                    'end_time' => null
                ]);

        return response()->json(
            $this->entry->where('id', $entry->id)
                        ->with(['type'])
                        ->first()
        , 201);
    }

    /**
     * Update existing entry,
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        $entry = $this->entry->find($id);

        if (is_null($entry)):
            return response()->json(
                'Could not retrieve auth user - check user is logged in'
            , 422);
        endif;

        $now = Carbon::now();
        $duration = Carbon::parse($now)->diffInMinutes($entry->start_time);
        $entry->update([
            'end_time' => $now,
            'duration' => $duration
        ]);

        return response()->json([
            'start' => $entry->start_time,
            'end' => $now->format('Y-m-d h:i:s'),
            'duration' => $duration
        ], 200);
    }
}
 