<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Wallet;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\WalletRequest;
use Gate;
use App\Models\Admin\PaymentMethod;

class WalletController extends Controller
{

    public function index()
    {
        if (Gate::none(['wallet_allow', 'wallet_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "wallet";
		$admiko_data["sideBarActiveFolder"] = "_master";
        
        $tableData = Wallet::orderByDesc("id")->get();
        return view("admin.wallet.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['wallet_allow'])) {
            return redirect(route("admin.wallet.index"));
        }
        $admiko_data['sideBarActive'] = "wallet";
		$admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.wallet.store");
        
        
		$payment_method_all = PaymentMethod::all()->sortBy("jenis_pembayaran")->pluck("jenis_pembayaran", "id");
        return view("admin.wallet.manage")->with(compact('admiko_data','payment_method_all'));
    }

    public function store(WalletRequest $request)
    {
        if (Gate::none(['wallet_allow'])) {
            return redirect(route("admin.wallet.index"));
        }
        $data = $request->all();
        
        $Wallet = Wallet::create($data);
        
        return redirect(route("admin.wallet.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Wallet = Wallet::find($id);
        if (Gate::none(['wallet_allow', 'wallet_edit']) || !$Wallet) {
            return redirect(route("admin.wallet.index"));
        }

        $admiko_data['sideBarActive'] = "wallet";
		$admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.wallet.update", [$Wallet->id]);
        
        
		$payment_method_all = PaymentMethod::all()->sortBy("jenis_pembayaran")->pluck("jenis_pembayaran", "id");
        $data = $Wallet;
        return view("admin.wallet.manage")->with(compact('admiko_data', 'data','payment_method_all'));
    }

    public function update(WalletRequest $request,$id)
    {
        if (Gate::none(['wallet_allow', 'wallet_edit'])) {
            return redirect(route("admin.wallet.index"));
        }
        $data = $request->all();
        $Wallet = Wallet::find($id);
        $Wallet->update($data);
        
        return redirect(route("admin.wallet.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['wallet_allow'])) {
            return redirect(route("admin.wallet.index"));
        }
        Wallet::destroy($request->idDel);
        return back();
    }
    
    
    
}
