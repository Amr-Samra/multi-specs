<?php

namespace Bdwey\Specs\Model;

use Illuminate\Database\Eloquent\Model;

class SpecsCategories extends Model
{
    public $table = "specs_categories";
    public $timestamps = false;

    public $fillable = [
        'spec_id',
        'category_id'
    ];

     /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'spec_id'     => 'required|exists:specs,id',
        'category_id' => 'required|exists:categories,id'
    ];


    public function specs()
    {
        return $this->belongsTo(Specs::class, 'spec_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(\TCG\Voyager\Models\Category::class, 'category_id', 'id');
    }
}
