<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Outlets;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\OutletsRequest;
use Gate;

class OutletsController extends Controller
{

    public function index()
    {
        if (Gate::none(['outlets_allow', 'outlets_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "outlets";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";

        $tableData = Outlets::orderBy("id")->get();
        return view("admin.outlets.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['outlets_allow'])) {
            return redirect(route("admin.outlets.index"));
        }
        $admiko_data['sideBarActive'] = "outlets";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";
        $admiko_data['formAction'] = route("admin.outlets.store");


        return view("admin.outlets.manage")->with(compact('admiko_data'));
    }

    public function store(OutletsRequest $request)
    {
        if (Gate::none(['outlets_allow'])) {
            return redirect(route("admin.outlets.index"));
        }
        $data = $request->all();

        $Outlets = Outlets::create($data);

        return redirect(route("admin.outlets.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Outlets = Outlets::find($id);
        if (Gate::none(['outlets_allow', 'outlets_edit']) || !$Outlets) {
            return redirect(route("admin.outlets.index"));
        }

        $admiko_data['sideBarActive'] = "outlets";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";
        $admiko_data['formAction'] = route("admin.outlets.update", [$Outlets->id]);


        $data = $Outlets;
        return view("admin.outlets.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(OutletsRequest $request, $id)
    {
        if (Gate::none(['outlets_allow', 'outlets_edit'])) {
            return redirect(route("admin.outlets.index"));
        }
        $data = $request->all();
        $Outlets = Outlets::find($id);
        $Outlets->update($data);

        return redirect(route("admin.outlets.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['outlets_allow'])) {
            return redirect(route("admin.outlets.index"));
        }
        Outlets::destroy($request->idDel);
        return back();
    }
}
