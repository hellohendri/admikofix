<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\LossesType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LossesTypeRequest;
use Gate;

class LossesTypeController extends Controller
{

    public function index()
    {
        if (Gate::none(['losses_type_allow', 'losses_type_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "losses_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_loss";
        
        $tableData = LossesType::orderByDesc("id")->get();
        return view("admin.losses_type.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['losses_type_allow'])) {
            return redirect(route("admin.losses_type.index"));
        }
        $admiko_data['sideBarActive'] = "losses_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_loss";
        $admiko_data['formAction'] = route("admin.losses_type.store");
        
        
        return view("admin.losses_type.manage")->with(compact('admiko_data'));
    }

    public function store(LossesTypeRequest $request)
    {
        if (Gate::none(['losses_type_allow'])) {
            return redirect(route("admin.losses_type.index"));
        }
        $data = $request->all();
        
        $LossesType = LossesType::create($data);
        
        return redirect(route("admin.losses_type.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $LossesType = LossesType::find($id);
        if (Gate::none(['losses_type_allow', 'losses_type_edit']) || !$LossesType) {
            return redirect(route("admin.losses_type.index"));
        }

        $admiko_data['sideBarActive'] = "losses_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_loss";
        $admiko_data['formAction'] = route("admin.losses_type.update", [$LossesType->id]);
        
        
        $data = $LossesType;
        return view("admin.losses_type.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(LossesTypeRequest $request,$id)
    {
        if (Gate::none(['losses_type_allow', 'losses_type_edit'])) {
            return redirect(route("admin.losses_type.index"));
        }
        $data = $request->all();
        $LossesType = LossesType::find($id);
        $LossesType->update($data);
        
        return redirect(route("admin.losses_type.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['losses_type_allow'])) {
            return redirect(route("admin.losses_type.index"));
        }
        LossesType::destroy($request->idDel);
        return back();
    }
    
    
    
}
