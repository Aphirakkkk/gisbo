<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsPolicy extends Model
{
    use HasFactory;

    protected $table = 'about_policy';

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'tilte_th',
        'tilte_en',
        'detail_th',
        'detail_en',
        'image1',
        'image2',
        'active_status',
        'display_status',
        'sort_number',
        'created_by',
        'updated_by',
        'ip_address',
    ];

    public function WithStatus()
    {
        return $this->hasOne(Status::class, 'id', 'active_status');
    }

    public function WithShow()
    {
        return $this->hasOne(Status::class, 'id', 'display_status');
    }

    public function usersCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function usersUpdatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
