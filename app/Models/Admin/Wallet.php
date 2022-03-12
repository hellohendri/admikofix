<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\PaymentMethod;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Wallet extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'wallet';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"jenis_saldo",
		"jumlah_saldo",
    ];
    public function jenis_saldo_id()
    {
        return $this->belongsTo(PaymentMethod::class, 'jenis_saldo');
    }
	public function getJumlahSaldoAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}