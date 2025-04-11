<?php

declare(strict_types=1);

namespace App\src\Modules\ReferenceBook\Geo\Enums;

use App\src\Shared\Exceptions\ApiException;
use App\src\Shared\Traits\BaseEnum;

enum GeoRegionNameEnum: int
{
    use BaseEnum;

    case DAGESTAN_REPUBLIC = 1;
    case INGUSHETIA_REPUBLIC = 2;
    case KABARDINO_BALKARIAN_REPUBLIC = 3;
    case KARACHAY_CHERKESS_REPUBLIC = 4;
    case NORTH_OSSETIA_ALANIA_REPUBLIC = 5;
    case CHECHEN_REPUBLIC = 6;
    case STAVROPOL_REGION = 7;

    /**
     * @throws ApiException
     */
    public static function getNameByEnumId(int $enumId): string
    {
        return match ($enumId) {
            self::DAGESTAN_REPUBLIC->value => 'Республика Дагестан',
            self::INGUSHETIA_REPUBLIC->value => 'Республика Ингушетия',
            self::KABARDINO_BALKARIAN_REPUBLIC->value => 'Кабардино-Балкарская Республика',
            self::KARACHAY_CHERKESS_REPUBLIC->value => 'Карачаево-Черкесская Республика',
            self::NORTH_OSSETIA_ALANIA_REPUBLIC->value => 'Республика Северная Осетия–Алания',
            self::CHECHEN_REPUBLIC->value => 'Чеченская Республика',
            self::STAVROPOL_REGION->value => 'Ставропольский край',
            default => throw new ApiException('geo name is invalid', 400),
        };
    }

}
