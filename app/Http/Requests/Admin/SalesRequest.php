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

class SalesRequest extends FormRequest
{
    public function rules()
    {
        return [
            "customer"=>[
				"nullable"
			],
			"jenis_pembayaran"=>[
				"nullable"
			],
			"status_pembayaran"=>[
				"nullable"
			],
			"produk"=>[
				"nullable"
			],
			"jumlah"=>[
				"integer",
				"nullable"
			],
			"total_harga"=>[
				"numeric",
				"nullable"
			],
			"tanggal"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "customer"=>"Customer",
			"jenis_pembayaran"=>"Jenis Pembayaran",
			"status_pembayaran"=>"Status Pembayaran",
			"produk"=>"Produk",
			"jumlah"=>"Jumlah",
			"total_harga"=>"Total Harga",
			"tanggal"=>"Tanggal"
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