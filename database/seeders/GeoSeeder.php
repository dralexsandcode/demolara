<?php

namespace Database\Seeders;

use App\src\Modules\ReferenceBook\Geo\Enums\GeoCountryNameEnum;
use App\src\Modules\ReferenceBook\Geo\Enums\GeoRegionNameEnum;
use App\src\Modules\ReferenceBook\Geo\Repositories\CountryRepository;
use App\src\Modules\ReferenceBook\Geo\Repositories\RegionRepository;
use App\src\PreInstalledData\Traits\PreInstalledDataTrait;
use App\src\Shared\Exceptions\ApiException;
use Illuminate\Database\Seeder;

class GeoSeeder extends Seeder
{

    use PreInstalledDataTrait;

    /**
     * @throws ApiException
     */
    public function run(): void
    {
        $data = [
            'id' => GeoCountryNameEnum::RUSSIA->value,
            'name' => GeoCountryNameEnum::getNameByEnumId(GeoCountryNameEnum::RUSSIA->value),
        ];

        $country = (new CountryRepository())->createFromArray($data);

        $prefferedRegionsIds = GeoRegionNameEnum::valuesArray();

        $listLatLonRegionsList = $this->listLatLonRegions();

        foreach ($prefferedRegionsIds as $regionId) {
            $data = [
                'id' => $regionId,
                'country_id' => $country->value('id'),
                'name' => GeoRegionNameEnum::getNameByEnumId($regionId),
                'latitude' => $listLatLonRegionsList[$regionId]['latitude'],
                'longitude' => $listLatLonRegionsList[$regionId]['longitude'],
            ];

            (new RegionRepository())->createFromArray($data);
        }
    }
}
