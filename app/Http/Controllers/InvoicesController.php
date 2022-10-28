<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->where('user_id', auth()->id())->get();
        return view('invoices.index', ['list' => $invoices]);
    }

    public function create()
    {
        $customers = Customer::all();
        return view('invoices.create', ['customers' => $customers]);
    }

    public function store(InvoiceStoreRequest $request)
    {

        $invoice = new Invoice();
        $invoice->number = $request->number;
        $invoice->total = $request->total;
        $invoice->date = $request->date;
        $invoice->customer_id = $request->customer;
        $invoice->user_id = auth()->id();

        $invoice->save();

        return redirect()->route('invoices.index')->with('messege', 'Faktura dodana poprawnie');
    }

    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->where('user_id', auth()->id())->first();
        if($invoice)
        {
            return view('invoices.edit', ['invoice' => $invoice]);
        }
        else{
            abort(403);
        }
    }

    public function update($id, Request $request)
    {
        $invoice = Invoice::where('id', $id)->where('user_id', auth()->id())->first();
        if(!$invoice)
        {
            abort(403);
            return;
        }
        $invoice = Invoice::find($id);
        $invoice->number = $request->number;
        $invoice->total = $request->total;
        $invoice->date = $request->date;

        $invoice->save();

        return redirect()->route('invoices.index')->with('messege', 'Faktura zmieniona poprawnie');
    }

    public function delete($id)
    {
        if(Invoice::where('id', $id)->where('user_id', auth()->id())->first())
        {
            Invoice::destroy($id);
            return redirect()->route('invoices.index')->with('messege', 'Faktura została usunięta');
        }
        else{
            abort(403);
            return;
        }

    }
}
