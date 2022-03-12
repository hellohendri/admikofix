<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use Gate;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\Outlets;

class ProductController extends Controller
{

    public function index()
    {
        if (Gate::none(['product_allow', 'product_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "product";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";

        $tableData = Product::orderBy("id")->get();
        return view("admin.product.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['product_allow'])) {
            return redirect(route("admin.product.index"));
        }
        $admiko_data['sideBarActive'] = "product";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";
        $admiko_data['formAction'] = route("admin.product.store");


        $product_category_all = ProductCategory::all()->sortBy("jenis_produk")->pluck("jenis_produk", "id");
        $outlets_all = Outlets::all()->sortBy("nama")->pluck("nama", "id");
        return view("admin.product.manage")->with(compact('admiko_data', 'product_category_all', 'outlets_all'));
    }

    public function store(ProductRequest $request)
    {
        if (Gate::none(['product_allow'])) {
            return redirect(route("admin.product.index"));
        }
        $data = $request->all();

        $Product = Product::create($data);

        return redirect(route("admin.product.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Product = Product::find($id);
        if (Gate::none(['product_allow', 'product_edit']) || !$Product) {
            return redirect(route("admin.product.index"));
        }

        $admiko_data['sideBarActive'] = "product";
        $admiko_data["sideBarActiveFolder"] = "_warehouse_product";
        $admiko_data['formAction'] = route("admin.product.update", [$Product->id]);


        $product_category_all = ProductCategory::all()->sortBy("jenis_produk")->pluck("jenis_produk", "id");
        $outlets_all = Outlets::all()->sortBy("nama")->pluck("nama", "id");
        $data = $Product;
        return view("admin.product.manage")->with(compact('admiko_data', 'data', 'product_category_all', 'outlets_all'));
    }

    public function update(ProductRequest $request, $id)
    {
        if (Gate::none(['product_allow', 'product_edit'])) {
            return redirect(route("admin.product.index"));
        }
        $data = $request->all();
        $Product = Product::find($id);
        $Product->update($data);

        return redirect(route("admin.product.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['product_allow'])) {
            return redirect(route("admin.product.index"));
        }
        Product::destroy($request->idDel);
        return back();
    }
}
