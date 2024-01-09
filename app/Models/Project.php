<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Requesttoview;
use App\Models\Notification;
use App\Models\Typeproject;
use App\Models\User;

class Project extends Model
{
    use HasFactory;
    protected $table="projects";
    public function Typeproject(): BelongsTo
    {
        return $this->belongsTo(Typeproject::class,'id_type','id');
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function Notification(): HasMany
    {
        return $this->HasMany(Notification::class,'id_project','id');
    }
    public function Requesttoview(): HasMany
    {
        return $this->HasMany(Requesttoview::class,'id_project','id');
    }
}
