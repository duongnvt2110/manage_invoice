<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use App\Customer;

class CustomerService {

    public function getFormCustomerData($customerForm){
        $item = [];
        for($i=0;$i<count($customerForm['product_name']);$i++){
            $item_temp = [
                'product_name'=>$customerForm['product_name'][$i],
                'product_unit'=>$customerForm['product_unit'][$i],
                'product_amount'=>$customerForm['product_amount'][$i],
                'product_price'=>$customerForm['product_price'][$i]
            ];
            if(isset($customerForm['product_id']) && isset($customerForm['product_id'][$i]) ){
                $item_temp['product_id'] = $customerForm['product_id'][$i];
            }
            array_push($item,$item_temp);
        }
        return $item;
    }

    public function getFormExportData($exportForm){
        $item = [];
        $customer = Customer::with(['invoices'=>function($query) use($exportForm){
            return $query->with('products')->whereBetween('invoices.create_date', [$exportForm['date_from'], $exportForm['date_to']]);
        }])
        ->where('id',$exportForm['id'])
        ->first()
        ->toArray();
        $customer_name = $customer['customer_name'];
        $key=0;
        foreach($customer['invoices'] as $invoice ){
            foreach($invoice['products'] as $product){
                $item[$key] = [
                    'id'=> isset($item[$key-1])?$item[$key-1]['id']+1:1,
                    'customer_name' => $customer_name,
                    'product_name' => $product['product_name'],
                    'product_unit' => $product['product_unit'],
                    'product_amount' => $product['product_amount'],
                    'product_price' => $product['product_price'],
                    'sum_price' => $product['product_amount']*$product['product_price']
                ];
                $key++;
            }
        }
        return $item;
    }

    public function searchCustomer($searchForm){
        $customers = Customer::where('customer_name','LIKE','%'.$searchForm['search_keyword'].'%')
        ->orWhere('mobile_phone','LIKE','%'.$searchForm['search_keyword'].'%')
        ->paginate(10);
        return $customers;
    }
}
