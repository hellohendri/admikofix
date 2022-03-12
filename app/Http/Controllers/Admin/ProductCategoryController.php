<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductCategoryRequest;
use Gate;

class ProductCategoryController extends Controller
{

    public function index()
    {
        if (Gate::none(['product_category_allow', 'product_category_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "product_category";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";

        $tableData = ProductCategory::orderBy("id")->get();
        return view("admin.product_category.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['product_category_allow'])) {
            return redirect(route("admin.product_category.index"));
        }
        $admiko_data['sideBarActive'] = "product_category";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";
        $admiko_data['formAction'] = route("admin.product_category.store");


        return view("admin.product_category.manage")->with(compact('admiko_data'));
    }

    public function store(ProductCategoryRequest $request)
    {
        if (Gate::none(['product_category_allow'])) {
            return redirect(route("admin.product_category.index"));
        }
        $data = $request->all();

        $ProductCategory = ProductCategory::create($data);

        return redirect(route("admin.product_category.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $ProductCategory = ProductCategory::find($id);
        if (Gate::none(['product_category_allow', 'product_category_edit']) || !$ProductCategory) {
            return redirect(route("admin.product_category.index"));
        }

        $admiko_data['sideBarActive'] = "product_category";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";
        $admiko_data['formAction'] = route("admin.product_category.update", [$ProductCategory->id]);


        $data = $ProductCategory;
        return view("admin.product_category.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(ProductCategoryRequest $request, $id)
    {
        if (Gate::none(['product_category_allow', 'product_category_edit'])) {
            return redirect(route("admin.product_category.index"));
        }
        $data = $request->all();
        $ProductCategory = ProductCategory::find($id);
        $ProductCategory->update($data);

        return redirect(route("admin.product_category.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['product_category_allow'])) {
            return redirect(route("admin.product_category.index"));
        }
        ProductCategory::destroy($request->idDel);
        return back();
    }
}
