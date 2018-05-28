<?php

namespace Bdwey\Specs\Model;

use Illuminate\Database\Eloquent\Model;

class SpecsItems extends Model
{
    public $table = "specs_items";
    protected $with = ['specsValues'];

    public $fillable = [
        'specsable_id',
        'specsable_type',
        'quantity'
    ];

     /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'specsable_id'   => 'required|integer',
        'specsable_type' => 'required|string',
        'quantity'       => 'nullable|integer'
    ];

    public function specsable()
    {
        return $this->morphTo();
    }

    public function specsValues()
    {
        return $this->hasMany(SpecsGroups::class, 'group_id', 'id');
    }

    public function fetchSpecsGroup()
    {
        foreach($this->specsValues as $value) {
            $values[] = [
                'name'  => $value->spec->name,
                'value' => $value->value,
                'type'  => $value->spec->type
            ];
        }
        return $values;
    }
}
