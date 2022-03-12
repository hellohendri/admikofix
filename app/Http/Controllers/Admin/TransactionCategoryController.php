<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TransactionCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TransactionCategoryRequest;
use Gate;
use App\Models\Admin\TransactionType;

class TransactionCategoryController extends Controller
{

    public function index()
    {
        if (Gate::none(['transaction_category_allow', 'transaction_category_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "transaction_category";
        $admiko_data["sideBarActiveFolder"] = "_master";

        $tableData = TransactionCategory::orderBy("id")->get();
        return view("admin.transaction_category.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['transaction_category_allow'])) {
            return redirect(route("admin.transaction_category.index"));
        }
        $admiko_data['sideBarActive'] = "transaction_category";
        $admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.transaction_category.store");


        $transaction_type_all = TransactionType::all()->sortBy("tipe_transaksi")->pluck("tipe_transaksi", "id");
        return view("admin.transaction_category.manage")->with(compact('admiko_data', 'transaction_type_all'));
    }

    public function store(TransactionCategoryRequest $request)
    {
        if (Gate::none(['transaction_category_allow'])) {
            return redirect(route("admin.transaction_category.index"));
        }
        $data = $request->all();

        $TransactionCategory = TransactionCategory::create($data);

        return redirect(route("admin.transaction_category.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $TransactionCategory = TransactionCategory::find($id);
        if (Gate::none(['transaction_category_allow', 'transaction_category_edit']) || !$TransactionCategory) {
            return redirect(route("admin.transaction_category.index"));
        }

        $admiko_data['sideBarActive'] = "transaction_category";
        $admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.transaction_category.update", [$TransactionCategory->id]);


        $transaction_type_all = TransactionType::all()->sortBy("tipe_transaksi")->pluck("tipe_transaksi", "id");
        $data = $TransactionCategory;
        return view("admin.transaction_category.manage")->with(compact('admiko_data', 'data', 'transaction_type_all'));
    }

    public function update(TransactionCategoryRequest $request, $id)
    {
        if (Gate::none(['transaction_category_allow', 'transaction_category_edit'])) {
            return redirect(route("admin.transaction_category.index"));
        }
        $data = $request->all();
        $TransactionCategory = TransactionCategory::find($id);
        $TransactionCategory->update($data);

        return redirect(route("admin.transaction_category.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['transaction_category_allow'])) {
            return redirect(route("admin.transaction_category.index"));
        }
        TransactionCategory::destroy($request->idDel);
        return back();
    }
}
