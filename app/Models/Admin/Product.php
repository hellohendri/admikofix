<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\Outlets;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Product extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'product';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"nama_produk",
		"jenis_produk",
		"outlets",
		"jumlah_stock",
		"hpp",
		"harga_jual",
    ];
    public function jenis_produk_id()
    {
        return $this->belongsTo(ProductCategory::class, 'jenis_produk');
    }
	public function outlets_id()
    {
        return $this->belongsTo(Outlets::class, 'outlets');
    }
	public function getHppAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
	public function getHargaJualAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}