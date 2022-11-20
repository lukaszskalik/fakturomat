<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Jobs\AddAttachment;
use App\Models\Attachment;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['customer', 'attachments'])->where('user_id', auth()->id())->get();
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

        if($request->attachment)
        {
            $path = $request->attachment->store('public/attachments');
            dispatch(new AddAttachment($path, $invoice->id));
        }

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
            Attachment::where('invoice_id', $id)->delete();
            Invoice::destroy($id);
            return redirect()->route('invoices.index')->with('messege', 'Faktura została usunięta');
        }
        else{
            abort(403);
            return;
        }

    }

    public function saveAsPdf($id)
    {
        $invoice = Invoice::with('customer')->where('id', $id)->where('user_id', auth()->id())->first();

        if (!$invoice)
        {
            abort(403);
        }

        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('faktura.pdf');
    }
}
