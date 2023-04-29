<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DriverType extends Enum
{
    /**
     * driver Type
     */
    const INDIVIDUAL = 'individual';
    const SUPPLIER = 'supplier';

    /**
     * driver document type
     */
    const DOC_PERSONAA_DRIVING_LICENSE = 'personal_driving_license';
    const DOC_FEESH_WE_TASHBEEH = 'feesh_we_tashbeeh';
    const DOC_DRUG_REPORT = 'drug_report';

    /**
     * driver document status
     */
    const DOC_PENDING = 'pending';
    const DOC_APPROVED = 'approved';
    const DOC_DECLINED = 'declined';

    /**
     * driver password
     */
    const PASSWORD_REGEX = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

    /**
     * License after days
     */
    const LICENSE_EXPIRED_AFTER_DAYS = 30;

}
