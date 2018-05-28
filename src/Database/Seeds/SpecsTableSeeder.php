<?php

use Illuminate\Database\Seeder;
use Bdwey\Specs\Model\Specs;

class SpecsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if(Specs::count() == 0) {
            foreach ($this->specs() as $spec) {
                Specs::create($spec);
            }
        }
    }

    public function specs()
    {
        return [
            [
                'name'        => 'Color',
                'type'        => 'string',
                'key'         => 'color',
                'is_required' => 1,
                'options'     => json_encode([
                    'red'   => 'Red',
                    'green' => 'Green',
                    'blue'  => 'Blue'
                ]),
                'order'       => '1',
                'is_active'   => 1,
                'details'     => 'Specs of Color'
            ],
            [
                'name'        => 'Size',
                'type'        => 'string',
                'key'         => 'size',
                'is_required' => 1,
                'options'     => json_encode([
                    's'  => 'Small',
                    'm'  => 'Medium',
                    'l'  => 'Large',
                    'xl' => 'X-Large',
                ]),
                'order'       => '2',
                'is_active'   => 1,
                'details'     => 'Specs of Size'
            ],
            [
                'name'        => 'Model',
                'type'        => 'string',
                'key'         => 'model',
                'is_required' => 1,
                'options'     => NULL,
                'order'       => '3',
                'is_active'   => 1,
                'details'     => 'Specs of Model'
            ]
        ];
    }
}
