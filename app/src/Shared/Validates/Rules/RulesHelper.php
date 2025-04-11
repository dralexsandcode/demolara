<?php

namespace App\src\Shared\Validates\Rules;

class RulesHelper
{
    public const MONEY = ['gte:0', 'numeric', 'decimal:0,2', 'max:999999999999'];
    public const REQUIRED_NUMERIC = ['required', 'numeric'];
    public const REQUIRED_INTEGER = ['required', 'integer'];
    public const INTEGER = ['integer'];
    public const REQUIRED_INTEGER_MAX_10 = ['required', 'integer', 'max:10', 'min:1'];
    public const INTEGER_MAX_10 = ['integer', 'max:10', 'min:1'];
    public const REQUIRED_STRING_MAX_50 = ['required', 'string', 'max:50', 'min:1'];
    public const STRING_MAX_20 = ['string', 'max:20', 'min:1'];
    public const STRING_MAX_50 = ['string', 'max:50', 'min:1'];
    public const STRING_MAX_100 = ['string', 'max:100', 'min:1'];
    public const REQUIRED_STRING_MAX_100 = ['required', 'string', 'max:100', 'min:1'];
    public const STRING_MAX_255 = ['string', 'max:255', 'min:1'];
    public const REQUIRED_STRING_MAX_255 = ['required', 'string', 'max:255', 'min:1'];
    public const STRING_MAX_1000 = ['string', 'max:1000', 'min:1'];
    public const ARRAY = ['array', 'min:1'];
    public const REQUIRED_STRING_MAX_1000 = ['required', 'string', 'max:1000', 'min:1'];
    public const HEX_COLOR = [
        'string',
        'max:9',
        'min:4',
        'regex:/\#(?:[0-9a-fA-F]{3}){1,2}$|^\#(?:[0-9a-fA-F]{4}){1,2}$/'
    ];
    public const REQUIRED_EMAIL = ['email', 'required', 'max:100'];

}
