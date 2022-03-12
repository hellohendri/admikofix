<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PaymentMethodRequest;
use Gate;

class PaymentMethodController extends Controller
{

    public function index()
    {
        if (Gate::none(['payment_method_allow', 'payment_method_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "payment_method";
        $admiko_data["sideBarActiveFolder"] = "_sales_management";

        $tableData = PaymentMethod::orderBy("id")->get();
        return view("admin.payment_method.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['payment_method_allow'])) {
            return redirect(route("admin.payment_method.index"));
        }
        $admiko_data['sideBarActive'] = "payment_method";
        $admiko_data["sideBarActiveFolder"] = "_sales_management";
        $admiko_data['formAction'] = route("admin.payment_method.store");


        return view("admin.payment_method.manage")->with(compact('admiko_data'));
    }

    public function store(PaymentMethodRequest $request)
    {
        if (Gate::none(['payment_method_allow'])) {
            return redirect(route("admin.payment_method.index"));
        }
        $data = $request->all();

        $PaymentMethod = PaymentMethod::create($data);

        return redirect(route("admin.payment_method.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $PaymentMethod = PaymentMethod::find($id);
        if (Gate::none(['payment_method_allow', 'payment_method_edit']) || !$PaymentMethod) {
            return redirect(route("admin.payment_method.index"));
        }

        $admiko_data['sideBarActive'] = "payment_method";
        $admiko_data["sideBarActiveFolder"] = "_sales_management";
        $admiko_data['formAction'] = route("admin.payment_method.update", [$PaymentMethod->id]);


        $data = $PaymentMethod;
        return view("admin.payment_method.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(PaymentMethodRequest $request, $id)
    {
        if (Gate::none(['payment_method_allow', 'payment_method_edit'])) {
            return redirect(route("admin.payment_method.index"));
        }
        $data = $request->all();
        $PaymentMethod = PaymentMethod::find($id);
        $PaymentMethod->update($data);

        return redirect(route("admin.payment_method.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['payment_method_allow'])) {
            return redirect(route("admin.payment_method.index"));
        }
        PaymentMethod::destroy($request->idDel);
        return back();
    }
}
