<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    // HasFactory traitini faqat factory ishlatishda qo'shish kerak

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'image',
        'status'
    ];

    public const STATUS_PENDING = 0;
    public const STATUS_APPROVED = 1;
    public const STATUS_REJECTED = -1;

    public function getStatusText()
    {
        return match ($this->status) {
            self::STATUS_PENDING => '<span class="text-primary">pending</span>',
            self::STATUS_APPROVED => '<span class="text-success">approved</span>',
            self::STATUS_REJECTED => '<span class="text-danger">rejected</span>',
        };
    }
}
