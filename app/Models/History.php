<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history'; // Specify the table name

    protected $primaryKey = 'history_id'; // Specify the primary key column name

    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
        'total_harga',
    ]; // Define the fillable attributes

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } // Define the relationship with the User model
}
