<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Customers;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CustomersRequest;
use Gate;

class CustomersController extends Controller
{

    public function index()
    {
        if (Gate::none(['customers_allow', 'customers_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "customers";
		$admiko_data["sideBarActiveFolder"] = "_sales_management";
        
        $tableData = Customers::orderByDesc("id")->get();
        return view("admin.customers.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['customers_allow'])) {
            return redirect(route("admin.customers.index"));
        }
        $admiko_data['sideBarActive'] = "customers";
		$admiko_data["sideBarActiveFolder"] = "_sales_management";
        $admiko_data['formAction'] = route("admin.customers.store");
        
        
        return view("admin.customers.manage")->with(compact('admiko_data'));
    }

    public function store(CustomersRequest $request)
    {
        if (Gate::none(['customers_allow'])) {
            return redirect(route("admin.customers.index"));
        }
        $data = $request->all();
        
        $Customers = Customers::create($data);
        
        return redirect(route("admin.customers.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Customers = Customers::find($id);
        if (Gate::none(['customers_allow', 'customers_edit']) || !$Customers) {
            return redirect(route("admin.customers.index"));
        }

        $admiko_data['sideBarActive'] = "customers";
		$admiko_data["sideBarActiveFolder"] = "_sales_management";
        $admiko_data['formAction'] = route("admin.customers.update", [$Customers->id]);
        
        
        $data = $Customers;
        return view("admin.customers.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(CustomersRequest $request,$id)
    {
        if (Gate::none(['customers_allow', 'customers_edit'])) {
            return redirect(route("admin.customers.index"));
        }
        $data = $request->all();
        $Customers = Customers::find($id);
        $Customers->update($data);
        
        return redirect(route("admin.customers.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['customers_allow'])) {
            return redirect(route("admin.customers.index"));
        }
        Customers::destroy($request->idDel);
        return back();
    }
    
    
    
}
