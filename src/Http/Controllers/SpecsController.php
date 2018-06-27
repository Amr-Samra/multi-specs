<?php

namespace Bdwey\Specs\Http\Controllers;

use Bdwey\Specs\Model\Specs;
use Bdwey\Specs\Model\SpecsItems;
use Bdwey\Sepcs\Model\SpecsGroups;
use App\Http\Controllers\FrontendBaseController;
use Illuminate\Http\Request;
use Response;
use Bdwey\Specs\Traits\Assistant;
use App\Models\Products;

class SpecsController extends FrontendBaseController
{
    use Assistant;
    /**
     * Display a listing of the Specs.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(SpecsItems $spec, Request $request)
    {
        $specsable = $spec->specsable;
        $groupedSpecs = $specsable->groupedSpecs()->has('specsValues')->get();
        $selected = $this->selected($request, $groupedSpecs);
        $data = [];
        foreach($groupedSpecs as $group) {
            foreach ($group->specsValues as $key => $value) {
                if(!isset($data[$key]['name'])) {
                    $data[$key]['spec_id'] = $value->spec->id;
                    $data[$key]['name'] = $value->spec->name;
                }
                $data[$key]['data'][] = [
                    'value'     => $value->value,
                    'active'    => $this->is_active($selected, $specsable, $value->value),
                    'selected'  => ($selected && isset($selected[$value->spec->id]) && $selected[$value->spec->id] == $value->value) ? 1 : 0
                ];
            }
        }
        if(is_array($data)) {
            foreach($data as $l_key =>$array) {
                if(is_array($array)) {
                    foreach($array as $m_key => $one) {
                        if(is_array($one)) {
                            $data[$l_key][$m_key] = collect($one)->unique('value');
                        }
                    }
                }
            }
        }
        return response()->json($data);
    }

    private function selected($request, $groupedSpecs)
    {
        $select = [];
        if($request->selected) {
            $selections = explode(',', $request->selected);
            foreach ($selections as $selection) {
                $selected = explode('_', $selection);
                if(is_array($selected) && count($selected) == 2) {
                    $select[$selected[0]] = $selected[1];
                }
            }
        } else {
            $group = $groupedSpecs->first();
            if($group) {
                $select = $group->specsValues()->pluck('value', 'spec_id')->toArray();
            }
        }
        return $select;
    }

    private function is_active($select, $specsable, $val)
    {
        $active = [];
        if(count($select)) {
            foreach ($select as $spec_id => $value) {
                if(!count($active)) {
                    $rv = $specsable->groupedSpecs()->whereHas('specsValues', function ($query) use ($spec_id, $value) {
                        $query->where('value', $value);
                    })
                    ->get()->toArray();
                    $man[] = $value;
                } else {
                    $rv = $specsable->groupedSpecs()->whereHas('specsValues', function ($query) use ($man) {
                        $query->whereIn('value', $man);
                    })
                    ->get()->toArray();
                }
                foreach ($rv as $ma) {
                    $gh[] = $ma['specs_values'];
                    foreach($ma['specs_values'] as $vt) {
                        $active[] = $vt['value'];
                    }
                }
            }
        }
        $active = array_unique($active);
        if(in_array($val, $active)) {
            return 1;
        }
        return 0;
    }
}