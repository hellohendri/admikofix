<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\Admin\LossesType;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Losses extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'losses';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"produk",
		"kategori",
		"jumlah",
		"keterangan",
    ];
    public function produk_id()
    {
        return $this->belongsTo(Product::class, 'produk');
    }
	public function kategori_id()
    {
        return $this->belongsTo(LossesType::class, 'kategori');
    }
}