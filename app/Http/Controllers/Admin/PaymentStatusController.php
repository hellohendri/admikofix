<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentStatus;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PaymentStatusRequest;
use Gate;

class PaymentStatusController extends Controller
{

    public function index()
    {
        if (Gate::none(['payment_status_allow', 'payment_status_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "payment_status";
        $admiko_data["sideBarActiveFolder"] = "_sales_management";

        $tableData = PaymentStatus::orderBy("id")->get();
        return view("admin.payment_status.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['payment_status_allow'])) {
            return redirect(route("admin.payment_status.index"));
        }
        $admiko_data['sideBarActive'] = "payment_status";
        $admiko_data["sideBarActiveFolder"] = "_sales_management";
        $admiko_data['formAction'] = route("admin.payment_status.store");


        return view("admin.payment_status.manage")->with(compact('admiko_data'));
    }

    public function store(PaymentStatusRequest $request)
    {
        if (Gate::none(['payment_status_allow'])) {
            return redirect(route("admin.payment_status.index"));
        }
        $data = $request->all();

        $PaymentStatus = PaymentStatus::create($data);

        return redirect(route("admin.payment_status.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $PaymentStatus = PaymentStatus::find($id);
        if (Gate::none(['payment_status_allow', 'payment_status_edit']) || !$PaymentStatus) {
            return redirect(route("admin.payment_status.index"));
        }

        $admiko_data['sideBarActive'] = "payment_status";
        $admiko_data["sideBarActiveFolder"] = "_sales_management";
        $admiko_data['formAction'] = route("admin.payment_status.update", [$PaymentStatus->id]);


        $data = $PaymentStatus;
        return view("admin.payment_status.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(PaymentStatusRequest $request, $id)
    {
        if (Gate::none(['payment_status_allow', 'payment_status_edit'])) {
            return redirect(route("admin.payment_status.index"));
        }
        $data = $request->all();
        $PaymentStatus = PaymentStatus::find($id);
        $PaymentStatus->update($data);

        return redirect(route("admin.payment_status.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['payment_status_allow'])) {
            return redirect(route("admin.payment_status.index"));
        }
        PaymentStatus::destroy($request->idDel);
        return back();
    }
}
