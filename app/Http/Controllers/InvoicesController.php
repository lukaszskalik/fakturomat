<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', ['list' => $invoices]);
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $invoice = new Invoice();
        $invoice->number = $request->number;
        $invoice->total = $request->total;
        $invoice->date = $request->date;

        $invoice->save();

        return redirect()->route('invoices.index')->with('messege', 'Faktura dodana poprawnie');
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('invoices.edit', ['invoice' => $invoice]);
    }

    public function update($id, Request $request)
    {
        $invoice = Invoice::find($id);
        $invoice->number = $request->number;
        $invoice->total = $request->total;
        $invoice->date = $request->date;

        $invoice->save();

        return redirect()->route('invoices.index')->with('messege', 'Faktura zmieniona poprawnie');
    }

    public function delete($id)
    {
        Invoice::destroy($id);
        return redirect()->route('invoices.index')->with('messege', 'Faktura została usunięta');
    }
}
