<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index() {
        $domains = Domain::all();
        return view('admin.domain_index', compact('domains'));
    }
    
    public function create() {
        return view('admin.domain_create');
    }
    
    public function store(Request $request) {
        $request->validate(['nama' => 'required']);
        Domain::create($request->only('nama'));
        return redirect()->route('admin.domain_index');
    }
    
    public function edit(Domain $domain) {
        return view('admin.domains_edit', compact('domain'));
    }
    
    public function update(Request $request, Domain $domain) {
        $request->validate(['nama' => 'required']);
        $domain->update($request->only('nama'));
        return redirect()->route('admin.domain_index');
    }
    
    public function destroy(Domain $domain) {
        $domain->delete();
        return back();
    }
    
}
