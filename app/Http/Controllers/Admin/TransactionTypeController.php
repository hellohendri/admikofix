<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TransactionType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TransactionTypeRequest;
use Gate;

class TransactionTypeController extends Controller
{

    public function index()
    {
        if (Gate::none(['transaction_type_allow', 'transaction_type_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "transaction_type";
        $admiko_data["sideBarActiveFolder"] = "_master";

        $tableData = TransactionType::orderBy("id")->get();
        return view("admin.transaction_type.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['transaction_type_allow'])) {
            return redirect(route("admin.transaction_type.index"));
        }
        $admiko_data['sideBarActive'] = "transaction_type";
        $admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.transaction_type.store");


        return view("admin.transaction_type.manage")->with(compact('admiko_data'));
    }

    public function store(TransactionTypeRequest $request)
    {
        if (Gate::none(['transaction_type_allow'])) {
            return redirect(route("admin.transaction_type.index"));
        }
        $data = $request->all();

        $TransactionType = TransactionType::create($data);

        return redirect(route("admin.transaction_type.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $TransactionType = TransactionType::find($id);
        if (Gate::none(['transaction_type_allow', 'transaction_type_edit']) || !$TransactionType) {
            return redirect(route("admin.transaction_type.index"));
        }

        $admiko_data['sideBarActive'] = "transaction_type";
        $admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.transaction_type.update", [$TransactionType->id]);


        $data = $TransactionType;
        return view("admin.transaction_type.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(TransactionTypeRequest $request, $id)
    {
        if (Gate::none(['transaction_type_allow', 'transaction_type_edit'])) {
            return redirect(route("admin.transaction_type.index"));
        }
        $data = $request->all();
        $TransactionType = TransactionType::find($id);
        $TransactionType->update($data);

        return redirect(route("admin.transaction_type.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['transaction_type_allow'])) {
            return redirect(route("admin.transaction_type.index"));
        }
        TransactionType::destroy($request->idDel);
        return back();
    }
}
