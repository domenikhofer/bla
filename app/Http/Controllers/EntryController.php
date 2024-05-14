<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntriesRequest;
use App\Http\Requests\StoreMediaEntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Http\Resources\EntryResource;
use App\Http\Resources\EntryWithCategoryResource;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntriesRequest $request)
    {
        $entries = $request->validated();
        Entry::where('category_id', $entries['category_id'])->delete();
        Entry::whereDate( 'deleted_at', '<=', now()->subDays(5))->forceDelete();
        Entry::insert($entries['entries']);
        return response()->noContent();
    }

     /**
     * Store a newly created resource in storage.
     */
    public function storeMedia(StoreMediaEntryRequest $request)
    {
        $entry = Entry::create($request->validated());
        return new EntryResource($entry);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
        return new EntryWithCategoryResource($entry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntryRequest $request, Entry $entry)
    {
        $entry->update($request->validated());
        return new EntryResource($entry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();
        return response()->noContent();
    }

    public function search(Request $request)
    {
        $query = strtolower($request->get('query'));
        $matchedEntries = [];
        $wildcardEntries = Entry::where('category_id', $request->get('category_id'))->where('value', 'like', "%$query%")->get();
        $entries = Entry::where('category_id', $request->get('category_id'))->get();

        foreach ($entries as $entry) {
            $similarity = 0;
            $value = strtolower($entry->value);
            similar_text($query, $value, $similarity);

            if ($similarity > 70) {
                $matchedEntries[] = $entry;
            }
        }
        $matchedEntriesCollection = collect($matchedEntries);
        $allEntriesCollection = $matchedEntriesCollection->merge($wildcardEntries);
        $entries = $allEntriesCollection->unique('id')->values()->all();

        return EntryResource::collection($entries);
    }
}
