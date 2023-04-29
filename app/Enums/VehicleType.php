<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class VehicleType extends Enum
{
    /**
     * document type
     */
    const DOC_LICENSE = 'license';
    const DOC_FA7S = 'fa7s';

    /**
     * document status
     */
    const DOC_PENDING = 'pending';
    const DOC_APPROVED = 'approved';
    const DOC_DECLINED = 'declined';
}
