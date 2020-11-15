<?php
namespace App\Repository\Customer;

use App\Repository\BaseRepository;
use App\Repository\Customer\CustomerRepositoryInterface;
use App\Services\CustomerService;
use Carbon\Carbon;
use App\Customer;
use App\Product;
use App\Invoice;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface{

    protected $customer;

    protected $product;

    protected $invoice;

    protected $customerService;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        $this->customerService = new CustomerService();
    }

    public function get(){
        return $this->customer->paginate(10);
    }

    public function create($data){
        $customer = $this->customer->create([
            'customer_name'=> $data['customer_name']
        ]);
        if(count($data) > 2 && isset($data['product_name'])){
            $productData = $this->customerService->getFormCustomerData($data);
            $invoice = $customer->invoices()->create([
                'create_date' => Carbon::now()
            ]);
            unset($data['product_id']);
            foreach($productData as $product){
                $product = Product::create($product);
                $invoice->products()->attach($product->id);
            }
        }
    }

    public function update($id,$data){
        $productData = $this->customerService->getFormCustomerData($data);
        $now = Carbon::now()->format('Y-m-d');
        $this->customer->where('id',$data['id'])->update([
            'customer_name'=> $data['customer_name']
        ]);
        $invoiceCreateDate = Invoice::where('customer_id',$data['id'])->max('create_date');
        if(isset($invoiceCreateDate) && $now > $invoiceCreateDate){
            foreach($productData as $product){
                if(isset($product['product_id'])){
                    $id = $product['product_id'];
                    unset($product['product_id']);
                    $product = Product::where('id',$id)->update($product);
                }else{
                    $invoice = Invoice::updateOrCreate([
                        'customer_id' => $data['id'],
                        'create_date' => $now
                    ]);
                    $product = Product::create($product);
                    $invoice->products()->attach($product->id);
                }
            }
        }else{
            $invoice = Invoice::with('products')->where([['customer_id',$data['id']],['create_date',$now]])->first();
            if(isset($invoice)){
                foreach($productData as $product){
                    if(isset($product['product_id'])){
                        $id = $product['product_id'];
                        unset($product['product_id']);
                        $product = Product::where('id',$id)->update($product);
                    }else{
                        $product = Product::create($product);
                        $invoice->products()->attach($product->id);
                    }
                }
            }else{
                $invoice = Invoice::create([
                    'customer_id' => $data['id'],
                    'create_date' => Carbon::now()
                ]);
                foreach($productData as $product){
                    $product = Product::create($product);
                    $invoice->products()->attach($product->id);
                }
            }

        }
    }

    public function edit($id){
        return $this->customer->with(['invoices'=> function($query){
            return $query->with('products');
        }])
        ->find($id);
    }

    public function delete($id){
        $invoice = Invoice::with('products')->where('customer_id',$id)->first();
        if(isset($invoice->products)){
            $productId = tap($invoice->products)->toArray()->pluck('id');
            $invoice->products()->detach($productId);
            Product::whereIn('id',$productId)->delete();
            $invoice->delete();
        }
        $this->customer->destroy($id);
    }
}
