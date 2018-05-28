<?php

namespace Bdwey\Specs\Model;

use Illuminate\Database\Eloquent\Model;

class SpecsGroups extends Model
{
    public $table = "specs_groups";
    protected $with = ['spec'];

    public $fillable = [
        'group_id',
        'spec_id',
        'value'
    ];

     /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'group_id' => 'required|exists:specs_items,id',
        'spec_id'  => 'required|exists:categories,id',
        'value'    => 'required|string'
    ];


    public function spec()
    {
        return $this->belongsTo(Specs::class, 'spec_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(SpecsItems::class, 'group_id', 'id');
    }
}
