<?php

// app/Http/Controllers/DealController.php
namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Lead;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index()
    {
        $deals = Deal::with('client')->latest()->get();
        return view('deals.index', compact('deals'));
    }

    public function create()
    {
        $clients = Lead::where('status', 'Client')->get();
        return view('deals.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:leads,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'deadline' => 'nullable|date',
        ]);

        Deal::create($request->all());

        return redirect()->route('deals.index')->with('success', 'Deal created successfully!');
    }

    public function show(Deal $deal)
    {
        return view('deals.show', compact('deal'));
    }

    public function edit(Deal $deal)
    {
        $clients = Lead::where('status', 'Client')->get();
        return view('deals.edit', compact('deal', 'clients'));
    }

    public function update(Request $request, Deal $deal)
    {
        $request->validate([
            'client_id' => 'required|exists:leads,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|in:Negotiation,Won,Lost',
            'deadline' => 'nullable|date',
        ]);

        $deal->update($request->all());

        return redirect()->route('deals.index')->with('success', 'Deal updated successfully!');
    }

    public function destroy(Deal $deal)
    {
        $deal->delete();
        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully!');
    }
}

