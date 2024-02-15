<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Invoice;

class InvoicePolicy
{
    public function show(User $user, Invoice $invoice)
    {
        return $user->id == $invoice->user_id;
    }
    
    public function edit(User $user, Invoice $invoice)
    {
        return $user->id == $invoice->user_id;
    } 
    
    public function delete(User $user, Invoice $invoice)
    {
        return true;
    }

    public function isAdmin(User $user)
    {
        return $user->roles === 'super-admin';
    }
}
