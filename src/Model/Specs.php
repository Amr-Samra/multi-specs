<?php

namespace Bdwey\Specs\Model;


use Illuminate\Database\Eloquent\Model;
use Bdwey\Specs\Traits\Assistant;

class Specs extends Model
{
    use Assistant;
    public $table = 'specs';

    public $fillable = [
        'name',
        'type',
        'key',
        'is_required',
        'default',
        'options',
        'order',
        'is_active',
        'details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'        => 'string',
        'type'        => 'string',
        'key'         => 'string',
        'is_required' => 'boolean',
        'default'     => 'string',
        'options'     => 'array',
        'order'       => 'integer',
        'is_active'   => 'boolean',
        'details'     => 'string'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name'        => 'required|string',
        'type'        => 'required|string',
        'key'         => 'required|string|unique:specs,key',
        'is_required' => 'nullable|boolean',
        'default'     => 'nullable|string',
        'options'     => 'nullable|json',
        'order'       => 'required|integer|min:1',
        'is_active'   => 'nullable|boolean',
        'details'     => 'nullable|string',
        'category_id' => 'nullable|array',
        'keys'        => 'nullable|array',
        'vals'        => 'nullable|array'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getKeys($specs)
    {
        $keys = [];
        foreach ($specs as $spec) {
            array_push($keys, $spec->key);
        }

        return $keys;
    }



    public function categories()
    {
        return $this->belongsToMany($this->getCategoryModel(), 'specs_categories', 'spec_id', 'category_id');
    }

    public function defaultSpecs($specs)
    {
        return $this->whereIn('key', $this->getKeys($specs))->orderBy('order');
    }

    public function setValidationRulesAttribute($value)
    {
        $value=json_decode($value);
        $this->attributes['validation_rules']=implode(',',$value);
    }

    public function getValidationRulesAttribute($value)
    {
        if(empty($value))
            return [];
        return explode(',',$value);
    }
}
