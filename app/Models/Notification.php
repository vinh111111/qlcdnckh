<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;
    protected $table="notifications";
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function Project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'id_project','id');
    }
}
