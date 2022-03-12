<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Response;

class TransactionRequest extends FormRequest
{
    public function rules()
    {
        return [
            "nama"=>[
				"string",
				"nullable"
			],
			"tipe_transaksi"=>[
				"required"
			],
			"jenis_transaksi"=>[
				"required"
			],
			"jumlah"=>[
				"integer",
				"nullable"
			],
			"total"=>[
				"numeric",
				"required"
			],
			"tanggal"=>[
				'date_format:"'.config('admiko_config.table_date_format').'"',
				"nullable"
			],
			"keterangan"=>[
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "nama"=>"Nama",
			"tipe_transaksi"=>"Tipe Transaksi",
			"jenis_transaksi"=>"Jenis Transaksi",
			"jumlah"=>"Jumlah",
			"total"=>"Total",
			"tanggal"=>"Tanggal",
			"keterangan"=>"Keterangan"
        ];
    }
    
    public function authorize()
    {
        if (!auth("admin")->check()) {
            return false;
        }
        return true;
    }
}