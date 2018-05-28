<?php

namespace Bdwey\Specs\Traits;
use Bdwey\Specs\Model\Specs;
use Bdwey\Specs\Model\SpecsItems;

trait Specsable
{
    use Assistant;

    // return Array of Specs
    public function getSpecsData($spec_id = FALSE)
    {
        $specs = [];
        $groupedSpecs = $this->groupedSpecs()->has('specsValues')->get();
        foreach($groupedSpecs as $key => $group) {
            if($spec_id && $spec_id != $group->id) {
                continue;
            }
            $specs[$group->id] = $group->fetchSpecsGroup();
        }
        return $specs;
    }

    // expecting array of data from request
    public function createSpecs($inputs)
    {
        $specs = $this->arrangeInputs($inputs);
        $quantity = $this->handelQuantity($inputs);
        $group = $this->groupedSpecs()->create(['quantity' => $quantity]);
        $group->specsValues()->createMany($specs);
        return;
    }
    // expecting specs-group & array of data from request
    public function updateSpecs($group ,$inputs)
    {
        $specs = $this->arrangeInputs($inputs);
        $quantity = $this->handelQuantity($inputs);
        $group->update(['quantity' => $quantity]);
        foreach ($specs as $spec) {
            $value = $group->specsValues()->where('spec_id', $spec['spec_id'])->first();
            if($value) {
                $value->update(['value' => $spec['value']]);
            }
        }
        return;
    }

    public function categorySpecs()
    {
        return $this->belongsToMany(Specs::class, 'specs_categories', 'category_id', 'spec_id');
    }

    public function groupedSpecs()
    {
        return $this->morphMany(SpecsItems::class, 'specsable');
    }

    public function hasSpecs()
    {
        if(count($this->getSpecsData())) {
            return TRUE;
        }
        return FALSE;
    }
}