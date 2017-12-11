<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Area\Repositories\AreaRepository;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $areaData = [
            '台灣' => [
                '台中市' => [
                    '南區',
                    '北區',
                    '中區',
                    '西區',
                ],
            ],
        ];

        /** @var AreaRepository $areaRepo */
        $areaRepo = \App::make(AreaRepository::class);

        foreach ($areaData as $first => $areas) {
            $areaRepo->create($first);
            foreach ($areas as $second => $area) {
                $areaRepo->create($second, $first);
                foreach ($area as $value) {
                    $areaRepo->create($value, $second);
                }
            }
        }
    }
}
