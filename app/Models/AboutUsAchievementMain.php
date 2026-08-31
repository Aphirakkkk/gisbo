<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsAchievementMain extends Model
{
    use HasFactory;

    protected $table = 'about_achievement_main';

    public $incrementing = true;
    public $timestamps = true;

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
    public function aboutUsAchievementDetail()
    {
        return $this->hasOne(AboutUsAchievementDetail::class, 'about_achievement_main_id', 'id');
    }
}
