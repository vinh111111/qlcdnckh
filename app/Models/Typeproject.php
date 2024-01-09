<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Typeproject extends Model
{
    use HasFactory;
    protected $table="typeprojects";
    public function Project(): HasMany
    {
        return $this->HasMany(Project::class,'id_type','id');
    }
}
