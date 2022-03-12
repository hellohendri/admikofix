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

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            "nama_produk"=>[
				"string",
				"nullable"
			],
			"jenis_produk"=>[
				"required"
			],
			"outlets"=>[
				"required"
			],
			"jumlah_stock"=>[
				"integer",
				"required"
			],
			"hpp"=>[
				"numeric",
				"nullable"
			],
			"harga_jual"=>[
				"numeric",
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "nama_produk"=>"Nama Produk",
			"jenis_produk"=>"Jenis Produk",
			"outlets"=>"Outlets",
			"jumlah_stock"=>"Jumlah Stock",
			"hpp"=>"HPP",
			"harga_jual"=>"Harga Jual"
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