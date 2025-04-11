<?php

declare(strict_types=1);


namespace App\src\PreInstalledData\Traits;

use App\src\Modules\ReferenceBook\Geo\Enums\GeoRegionNameEnum;

trait PreInstalledDataTrait
{
    public function listLatLonRegions(): array
    {
        return [
            GeoRegionNameEnum::DAGESTAN_REPUBLIC->value => [
                'latitude' => '43.088760',
                'longitude' => '46.848289',
            ],
            GeoRegionNameEnum::INGUSHETIA_REPUBLIC->value => [
                'latitude' => '43.172162',
                'longitude' => '44.896024',
            ],
            GeoRegionNameEnum::KABARDINO_BALKARIAN_REPUBLIC->value => [
                'latitude' => '43.455120',
                'longitude' => '43.436111',
            ],
            GeoRegionNameEnum::KARACHAY_CHERKESS_REPUBLIC->value => [
                'latitude' => '43.770550',
                'longitude' => '41.753220',
            ],
            GeoRegionNameEnum::NORTH_OSSETIA_ALANIA_REPUBLIC->value => [
                'latitude' => '43.092552',
                'longitude' => '44.261810',
            ],
            GeoRegionNameEnum::CHECHEN_REPUBLIC->value => [
                'latitude' => '43.4',
                'longitude' => '45.7',
            ],
            GeoRegionNameEnum::STAVROPOL_REGION->value => [
                'latitude' => '44.8632577',
                'longitude' => '43.4406913',
            ],
        ];
    }

}