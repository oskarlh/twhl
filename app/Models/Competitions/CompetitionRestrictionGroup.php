<?php namespace App\Models\Competitions;

use Illuminate\Database\Eloquent\Model;

class CompetitionRestrictionGroup extends Model {

    public $table = 'competition_restriction_groups';
    public $timestamps = false;
    public $fillable = ['title', 'is_multiple'];

}
