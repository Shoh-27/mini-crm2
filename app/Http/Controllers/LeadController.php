<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::all()->groupBy('status');
        return view('leads.index', compact('leads'));
    }


    public function create()
    {
        return view('leads.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255'
        ]);


        Lead::create($data);


        return redirect()->route('leads.index')->with('success','Lead created successfully');
    }


    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }


    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'status' => 'required|in:'.implode(',', Lead::STATUSES)
        ]);


        $lead->update($data);


        return redirect()->route('leads.index')->with('success','Lead updated successfully');
    }

    public function show(Lead $lead)
    {
        $lead->load('tasks.assignedTo'); // Tasklarni yuklaymiz
        $users = User::all();
        return view('leads.show', compact('lead', 'users'));
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success','Lead deleted');
    }
}
