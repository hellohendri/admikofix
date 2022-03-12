<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TransactionRequest;
use Gate;
use App\Models\Admin\PaymentMethod;
use App\Models\Admin\TransactionType;
use App\Models\Admin\TransactionCategory;

class TransactionController extends Controller
{

    public function index()
    {
        if (Gate::none(['transaction_allow', 'transaction_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "transaction";
        $admiko_data["sideBarActiveFolder"] = "_master";

        $tableData = Transaction::orderByDesc("id")->get();
        $pemasukan = Transaction::select('total')
            ->where('tipe_transaksi', 1)
            ->get();
        $pengeluaran = Transaction::select('total')
            ->where('tipe_transaksi', 2)
            ->get();

        $totalPemasukan = 0;
        foreach ($pemasukan as $total) {
            $totalPemasukan += $total->total;
        }
        $totalPengeluaran = 0;
        foreach ($pengeluaran as $total) {
            $totalPengeluaran += $total->total;
        }

        $saldoAkhir = $totalPemasukan - $totalPengeluaran;
        return view("admin.transaction.index")->with(compact('admiko_data', "tableData", "saldoAkhir", "totalPemasukan", "totalPengeluaran"));
    }

    public function create()
    {
        if (Gate::none(['transaction_allow'])) {
            return redirect(route("admin.transaction.index"));
        }
        $admiko_data['sideBarActive'] = "transaction";
        $admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.transaction.store");

        $payment_method_all = PaymentMethod::all()->sortBy("jenis_pembayaran")->pluck("jenis_pembayaran", "id");
        $transaction_type_all = TransactionType::all()->sortBy("tipe_transaksi")->pluck("tipe_transaksi", "id");
        $transaction_category_all = TransactionCategory::all()->sortBy("kategori_transaksi")->pluck("kategori_transaksi", "id");
        return view("admin.transaction.manage")->with(compact('admiko_data', 'transaction_type_all', 'transaction_category_all', 'payment_method_all'));
    }

    public function store(TransactionRequest $request)
    {
        if (Gate::none(['transaction_allow'])) {
            return redirect(route("admin.transaction.index"));
        }
        $data = $request->all();

        $Transaction = Transaction::create($data);

        return redirect(route("admin.transaction.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Transaction = Transaction::find($id);
        if (Gate::none(['transaction_allow', 'transaction_edit']) || !$Transaction) {
            return redirect(route("admin.transaction.index"));
        }

        $admiko_data['sideBarActive'] = "transaction";
        $admiko_data["sideBarActiveFolder"] = "_master";
        $admiko_data['formAction'] = route("admin.transaction.update", [$Transaction->id]);

        $payment_method_all = PaymentMethod::all()->sortBy("jenis_pembayaran")->pluck("jenis_pembayaran", "id");
        $transaction_type_all = TransactionType::all()->sortBy("tipe_transaksi")->pluck("tipe_transaksi", "id");
        $transaction_category_all = TransactionCategory::all()->sortBy("kategori_transaksi")->pluck("kategori_transaksi", "id");
        $data = $Transaction;
        return view("admin.transaction.manage")->with(compact('admiko_data', 'data', 'transaction_type_all', 'transaction_category_all', 'payment_method_all'));
    }

    public function update(TransactionRequest $request, $id)
    {
        if (Gate::none(['transaction_allow', 'transaction_edit'])) {
            return redirect(route("admin.transaction.index"));
        }
        $data = $request->all();
        $Transaction = Transaction::find($id);
        $Transaction->update($data);

        return redirect(route("admin.transaction.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['transaction_allow'])) {
            return redirect(route("admin.transaction.index"));
        }
        Transaction::destroy($request->idDel);
        return back();
    }
}
