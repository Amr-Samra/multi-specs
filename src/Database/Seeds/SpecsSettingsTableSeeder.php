<?php

use Illuminate\Database\Seeder;
use Bdwey\Specs\Model\SpecsSettings;

class SpecsSettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if(SpecsSettings::count() == 0) {
            foreach ($this->data() as $data) {
                SpecsSettings::create($data);
            }
        }
    }

    public function data()
        {
            return [
                [
                    'key'         => 'string',
                    'value'       => 'نص',
                    'group'       => 'types',
                    'description' => 'Validation types of Specs`s values'
                ],
                [
                    'key'         => 'integer',
                    'value'       => 'رقم صحيح',
                    'group'       => 'types',
                    'description' => 'Validation types of Specs`s values'
                ],
                [
                    'key'         => 'boolean',
                    'value'       => 'نعم أو لا',
                    'group'       => 'types',
                    'description' => 'Validation types of Specs`s values'
                ],
                [
                    'key'         => 'numeric',
                    'value'       => 'رقم عشري',
                    'group'       => 'types',
                    'description' => 'Validation types of Specs`s values'
                ],
                [
                    'key'         => 'date',
                    'value'       => 'تاريخ',
                    'group'       => 'types',
                    'description' => 'Validation types of Specs`s values'
                ],
                [
                    'key'         => 'array',
                    'value'       => 'اختيار اكتر من قيمة من متعدد',
                    'group'       => 'types',
                    'description' => 'Validation types of Specs`s values'
                ],
                [
                    'key'         => 'category',
                    'value'       => '\App\Models\Categories',
                    'group'       => 'models',
                    'description' => 'Category Model Path for relationship'
                ],
            ];
        }
}
