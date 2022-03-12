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
use App\Models\Admin\TransactionType;
use App\Models\Admin\TransactionCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Transaction extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'transaction';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        "jenis_pembayaran",
        "tipe_transaksi",
        "jenis_transaksi",
        "jumlah",
        "total",
        "tanggal",
        "keterangan",
    ];
    public function jenis_pembayaran_id()
    {
        return $this->belongsTo(PaymentMethod::class, 'jenis_pembayaran');
    }
    public function tipe_transaksi_id()
    {
        return $this->belongsTo(TransactionType::class, 'tipe_transaksi');
    }
    public function jenis_transaksi_id()
    {
        return $this->belongsTo(TransactionCategory::class, 'jenis_transaksi');
    }
    public function getTotalAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
    public function getTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_format')) : null;
    }
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
