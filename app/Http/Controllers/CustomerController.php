<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Repository\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\GoogleService;

class CustomerController extends Controller
{
    protected $customer;

    protected $customerService;

    protected $googleService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CustomerRepositoryInterface $customer)
    {
        $this->customer = $customer;
        $this->customerService = new CustomerService();
        $this->googleService = new GoogleService();
    }

    public function index(Request $request)
    {
        //
        $searchForm = $request->only('search_keyword');
        if(!empty($searchForm)){
            $customers = $this->customerService->searchCustomer($searchForm);
        }else{
            $customers = $this->customer->get();
        }
        return view('customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Customer $customer)
    {
        //
        $request->validate([
            'customer_name' => 'required|max:255',
        ]);
        $customerForm = $request->all();
        $this->customer->create($customerForm);
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$id)
    {
        //
        $customer = $this->customer->edit($id);
        return view('customer.edit',compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $request->validate([
            'product_name' => 'required|max:255',
            'product_price' => 'required',
        ]);
        $customerForm = $request->all();
        $this->customer->update(null,$customerForm);
        return redirect()->route('customer.edit',[$customerForm['id']])->with('success','Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Customer $customer)
    {
        $customerId = $request->only('id');
        $this->customer->delete($customerId);
        return redirect()->route('customer.index');
    }

    public function upload(Request $request){

        $this->googleService->uploadFileGoogleDrive();

    }
}
