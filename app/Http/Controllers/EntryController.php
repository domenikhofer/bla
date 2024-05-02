<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaEntryRequest;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entry.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Entry::where('category_id', $request->category_id)->delete();
        Entry::whereDate( 'deleted_at', '<=', now()->subDays(5))->forceDelete();
        Entry::insert($request->entries);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function storeMedia(StoreMediaEntryRequest $request)
    {
        Entry::create($request->validated());
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

        return response()->json($entries);
    }
}
