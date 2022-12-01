<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $total = 0;
        $invoice = Invoice::findOrFail($id);

        foreach ($invoice->shop as $product) {
            $total += $product->total;
        }

        return view('invoice', [
            'invoice' => $invoice,
            'total' => $total
        ]);
    }
}
