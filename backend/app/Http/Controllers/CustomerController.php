<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Address;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        foreach ($customers as $key => $customer) {
           $customer['addresses'] = Address::where('customer_id', $customer['id'])->get();
        }
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation rules
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'company' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                'addresses' => 'required|array',  
                'addresses.*.street' => 'required|string',
                'addresses.*.city' => 'required|string',
                'addresses.*.adnumber' => 'required',
            ]);
            
            // Create a new post
            $customer = Customer::create([
                'name' => $validatedData['name'],
                'company' => $validatedData['company'],
                'country' => $validatedData['country'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
            ]);

            foreach ($validatedData['addresses'] as $addressData) {
                Address::create([
                    'customer_id' => $customer['id'],
                    'adnumber' => $addressData['adnumber'],
                    'street' => $addressData['street'],
                    'city' => $addressData['city'],
                ]);
            }
            return response()->json(['message' => 'Customer and addresses created successfully', 'data' => $validatedData]);
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors(), 422); // Return validation errors
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if($customer){
            return response()->json(['data' => $customer]);
        }
        else{
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
