<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;

class ConcertController extends Controller
{
    /**
     * Display a listing of concerts, optionally filtered by search query.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = Concert::query();

        if ($q) {
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                        ->orWhere('location', 'like', "%{$q}%");
            });
        }

        $concerts = $query->orderBy('date', 'desc')->get();

        return view('concerts', compact('concerts', 'q'));
    }

    /**
     * Return JSON search results for concerts (used by live search).
     */
    public function search(Request $request)
    {
        $q = $request->query('q');

        $query = Concert::query();

        if ($q) {
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                        ->orWhere('location', 'like', "%{$q}%")
                        ->orWhere('organizer', 'like', "%{$q}%");
            });
        }

        $results = $query->orderBy('date', 'desc')
            ->limit(10)
            ->get(['id','title','location','date','image_url','price','organizer']);

        return response()->json($results);
    }

    /**
     * Display a single concert detail.
     */
    public function show(Concert $concert)
    {
        return view('concerts.show', compact('concert'));
    }
}
