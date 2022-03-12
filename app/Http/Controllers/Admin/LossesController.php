<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Losses;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LossesRequest;
use Gate;
use App\Models\Admin\Product;
use App\Models\Admin\LossesType;

class LossesController extends Controller
{

    public function index()
    {
        if (Gate::none(['losses_allow', 'losses_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "losses";
		$admiko_data["sideBarActiveFolder"] = "dropdown_loss";
        
        $tableData = Losses::orderByDesc("id")->get();
        return view("admin.losses.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['losses_allow'])) {
            return redirect(route("admin.losses.index"));
        }
        $admiko_data['sideBarActive'] = "losses";
		$admiko_data["sideBarActiveFolder"] = "dropdown_loss";
        $admiko_data['formAction'] = route("admin.losses.store");
        
        
		$product_all = Product::all()->sortBy("nama_produk")->pluck("nama_produk", "id");
		$losses_type_all = LossesType::all()->sortBy("kategori")->pluck("kategori", "id");
        return view("admin.losses.manage")->with(compact('admiko_data','product_all','losses_type_all'));
    }

    public function store(LossesRequest $request)
    {
        if (Gate::none(['losses_allow'])) {
            return redirect(route("admin.losses.index"));
        }
        $data = $request->all();
        
        $Losses = Losses::create($data);
        
        return redirect(route("admin.losses.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Losses = Losses::find($id);
        if (Gate::none(['losses_allow', 'losses_edit']) || !$Losses) {
            return redirect(route("admin.losses.index"));
        }

        $admiko_data['sideBarActive'] = "losses";
		$admiko_data["sideBarActiveFolder"] = "dropdown_loss";
        $admiko_data['formAction'] = route("admin.losses.update", [$Losses->id]);
        
        
		$product_all = Product::all()->sortBy("nama_produk")->pluck("nama_produk", "id");
		$losses_type_all = LossesType::all()->sortBy("kategori")->pluck("kategori", "id");
        $data = $Losses;
        return view("admin.losses.manage")->with(compact('admiko_data', 'data','product_all','losses_type_all'));
    }

    public function update(LossesRequest $request,$id)
    {
        if (Gate::none(['losses_allow', 'losses_edit'])) {
            return redirect(route("admin.losses.index"));
        }
        $data = $request->all();
        $Losses = Losses::find($id);
        $Losses->update($data);
        
        return redirect(route("admin.losses.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['losses_allow'])) {
            return redirect(route("admin.losses.index"));
        }
        Losses::destroy($request->idDel);
        return back();
    }
    
    
    
}
