<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Customers;
use App\Models\Admin\PaymentMethod;
use App\Models\Admin\PaymentStatus;
use App\Models\Admin\Product;
use Carbon\Carbon;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Sales extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'sales';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"customer",
		"jenis_pembayaran",
		"status_pembayaran",
		"produk",
		"jumlah",
		"total_harga",
		"tanggal",
    ];
    public function customer_id()
    {
        return $this->belongsTo(Customers::class, 'customer');
    }
	public function jenis_pembayaran_id()
    {
        return $this->belongsTo(PaymentMethod::class, 'jenis_pembayaran');
    }
	public function status_pembayaran_id()
    {
        return $this->belongsTo(PaymentStatus::class, 'status_pembayaran');
    }
	public function produk_id()
    {
        return $this->belongsTo(Product::class, 'produk');
    }
	public function getTotalHargaAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
	public function getTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_time_format')) : null;
    }
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}