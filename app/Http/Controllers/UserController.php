<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Policies\InvoicePolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $invoices = Invoice::with('user')->where('user_id', auth()->user()->id)->get(); */
        $invoices = Invoice::with('user')->get();

        return view('user', ['invoices' => $invoices]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* if (! $request->user()->can('isAdmin', Invoice::class)) {
           abort(403);
        }
        
        if ($request->user()->cannot('isAdmin', Invoice::class)) {
           abort(403);
        } */

        $this->authorize('isAdmin', Invoice::class);

        /* $can = $request->user()->can('isAdmin', Invoice::class); */

       /*  dd($can); */
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
    public function edit(Invoice $invoice)
    {
        return view('edit', ['invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Invoice $invoice)
    {
        $response = Gate::inspect('can-edit', $invoice);

        if ($response->allowed()) {
            var_dump('updated');
        }else{
            return $response->message();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
