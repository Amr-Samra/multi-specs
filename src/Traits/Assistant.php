<?php

namespace Bdwey\Specs\Traits;

use Bdwey\Specs\Model\Specs;
use Bdwey\Specs\Model\SpecsSettings;

trait Assistant
{
    // get Model path of Categories from Settings
    public function getCategoryModel()
    {
        return $this->getSettingByKey('category', 'models')->value;
    }

    // get specific setting by key and by group if exists
    public function getSettingByKey($key, $group = FALSE)
    {
        if($group) {
            return SpecsSettings::Group($group)->where('key', $key)->first();
        }
        return SpecsSettings::where('key', $key)->first();
    }

    // get group of settings by group
    public function getSettingsByGroup($group)
    {
        return SpecsSettings::Group($group)->get();
    }

    // get Specs Types Array
    public function getTypes()
    {
        return $this->getSettingsByGroup('types')->pluck('value', 'key')->toArray();
    }

    // Arrange Data for insert except('category_id')
    public function prepareInputs($data)
    {
        $input = $data;
        if(isset($data['keys'])) {
            // keep values
            $keys = $data['keys'];
            $vals = $data['vals'];
            // clean data and prepare Input
            unset($data['keys']);
            unset($data['vals']);
            $input = $data;
            // process option_values json
            if(count($keys)) {
                $input['options'] = $this->dataArrayToJson($keys, $vals);
            }
        }
        $input = $this->handleTrueOrFalse($input);
        return $input;
    }

    public function dataArrayToJson($keys, $vals)
    {
        // Bind each value with it`s key while not empty
        foreach($keys as $key => $element) {
            if(!empty($element) && !empty($vals[$key])) {
                $options[$element] = $vals[$key];
            }
        }
        if(isset($options)) {
            return json_encode($options);
        }
        return NULL;
    }

    public function handleTrueOrFalse($data)
    {
        if(isset($data['is_required'])) {
            $data['is_required'] = TRUE;
        } else {
            $data['is_required'] = FALSE;
        }
        if(isset($data['is_active'])) {
            $data['is_active'] = TRUE;
        } else {
            $data['is_active'] = FALSE;
        }
        return $data;
    }

    public function getDefaultSpecs($category = FALSE)
    {
        $specs = [];
        if($category) {
            $specs = Specs::Active()->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category);
            })->get();
        }
        return $specs;
    }

    public function getSpecsRules()
    {
        $rules['quantity'] = 'nullable|integer';
        $rules['specsable_id'] = 'required|integer';
        $rules['type'] = 'required|string';
        foreach ($this->all() as $key => $value) {
            if ($key != 'specsable_id' && strpos($key, 'specs') !== false) {
                $id = explode("_", $key)[1];
                $rules[$key] = $this->specValidation($id);
            }
        }
        return $rules;
    }


    public function specValidation($spec_id)
    {
        $validation = [];
        $spec = Specs::find($spec_id);
        if($spec) {
            if($spec->is_required) {
                $validation[] = 'required';
            }
            $validation[] = $spec->type;
        }
        return $validation;
    }

    public function handelQuantity($inputs)
    {
        if(isset($inputs['quantity'])) {
            return $inputs['quantity'];
        }
        return NULL;
    }

    public function arrangeInputs($inputs)
    {
        $specs = [];
        foreach($inputs as $key => $value) {
            if ($key != 'specsable_id' && strpos($key, 'specs') !== false) {
                $id = explode("_", $key)[1];
                $specs[] = [
                    'spec_id' => $id,
                    'value'   => $this->encodeIfArray($id, $value)
                ];
            }
        }
        return $specs;
    }

    public function encodeIfArray($id, $value)
    {
        $spec = Specs::find($id);
        if($spec->type == 'array') {
            return json_encode($value);
        }
        return $value;
    }

    public static function decodeJSON($value)
    {
        if(Self::checkJSON($value)) {
            return json_decode($value);
        }
        $values[] = $value;
        return $values;
    }

    public static function getDefaultValues($group, $spec_id)
    {
        if(isset($group->id)) {
            $spec = $group->specsValues()->where('spec_id', $spec_id)->first();
            if($spec) {
                if(Self::checkJSON($spec->value)) {
                    return json_decode($spec->value);
                }
                return $spec->value;
            }
        }
        return NULL;
    }

    public static function checkJSON($value)
    {
        $json = json_decode($value);
        return $json && $value != $json;
    }

    public static function getSpecsDataByGroupId($spec_id)
    {
        $specs = [];
        $group = \Bdwey\Specs\Model\SpecsItems::find($spec_id);
        if($group) {
            $specs[$group->id] = $group->fetchSpecsGroup();
        }
        return $specs;
    }
}