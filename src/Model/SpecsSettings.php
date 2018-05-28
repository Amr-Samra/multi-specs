<?php

namespace Bdwey\Specs\Model;

use Illuminate\Database\Eloquent\Model;

class SpecsSettings extends Model
{
    public $table = "specs_settings";

    public $fillable = [
        'key',
        'value',
        'description',
        'group'
    ];

     /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'key'         => 'required|string',
        'value'       => 'required|string',
        'group'       => 'required|string',
        'description' => 'nullable|string',
    ];

    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
