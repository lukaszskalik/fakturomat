<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::where('user_id', auth()->id())->get();
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:5',
            'address' => 'required|min:10',
            'nip' => 'required|digits:10'
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->nip = $request->nip;
        $customer->user_id = auth()->id();

        $customer->save();

        return redirect()->route('customers.index')->with('messege', 'Dodano nowego Klienta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with('invoices')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('customers.single', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::where('id', $id)->where('user_id', auth()->id())->first();
        if(!$customer)
        {
            abort(403);
            return;
        }
        return view('customers.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::where('id', $id)->where('user_id', auth()->id())->first();
        if(!$customer)
        {
            abort(403);
            return;
        }
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->nip = $request->nip;

        $customer->save();

        return redirect()->route('customers.index')->with('messege', 'Dane Klienta zostały zmienione poprawnie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Customer::where('id', $id)->where('user_id', auth()->id())->first())
        {
            Customer::destroy($id);
            return redirect()->route('customers.index')->with('messege', 'Klient został usunięty z bazy');
        }

        abort(403);
    }
}
