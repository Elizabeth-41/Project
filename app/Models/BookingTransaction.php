<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'customer_bank_name',
        'customer_bank_account',
        'customer_bank_number',
        'booking_trx_id',
        'proof',
        'quantity',
        'total_amount',
        'is_paid',
        'workshop_id',
    ];

    // Fungsi untuk menghasilkan ID transaksi unik
    public static function generateUniqueTrxId()
    {
        $prefix = 'AKT';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    // Relasi ke tabel WorkshopParticipant (bila satu transaksi bisa memiliki banyak peserta)
    public function workshopParticipants(): HasMany
    {
        return $this->hasMany(WorkshopParticipant::class, 'booking_trx_id', 'booking_trx_id');
    }

    // Relasi ke tabel Workshop
    public function workshop()
{
    return $this->belongsTo(Workshop::class);
}
public function participants()
{
    return $this->hasMany(WorkshopParticipant::class);
}

}