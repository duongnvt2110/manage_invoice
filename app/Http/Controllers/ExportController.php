<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Customer\CustomerRepositoryInterface;
use App\Services\CustomerService;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function index(CustomerRepositoryInterface $customer,$id){
        $customer = $customer->edit($id);
        return view('export.index',compact('customer'));
    }

    public function export(Request $request,CustomerService $customerService){
        $request->validate([
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => 'required|date_format:Y-m-d',
            'id'=>'required'
        ],[
            'date_from.required' => 'Thiếu ngày bắt đầu xuất file',
            'date_to.required' => 'Thiếu ngày kết thúc xuất file',
        ]);
        $exportForm = $request->all();
        $customerService = new CustomerService();
        $dataExport = $customerService->getFormExportData($exportForm);
        if(!empty($dataExport)){
            $dataExport = new CustomerExport($dataExport);
            return Excel::download($dataExport, 'customers.xlsx');
        }
        return redirect()->route('export.index',[$exportForm['id']])->with('success','Data error!');
    }
}
