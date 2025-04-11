<?php

declare(strict_types=1);

namespace App\src\Modules\ReferenceBook\Geo\Enums;

use App\src\Shared\Exceptions\ApiException;
use App\src\Shared\Traits\BaseEnum;

enum GeoCountryNameEnum: int
{
    use BaseEnum;

    case RUSSIA = 1;

    /**
     * @throws ApiException
     */
    public static function getNameByEnumId(int $enumId): string
    {
        return match ($enumId) {
            self::RUSSIA->value => 'Россия',
            default => throw new ApiException('geo name is invalid', 400),
        };
    }

}
