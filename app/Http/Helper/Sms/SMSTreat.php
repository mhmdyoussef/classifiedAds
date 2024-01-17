<?php
/**
 * Created by: MY-Dev 18-12-2023
 */
namespace App\Http\Helper\Sms;

use Random\RandomException;

trait SMSTreat
{

    /**
     * @param string $phone_number
     * @param int $country_code
     * @param int $count_no_code
     * @return string
     * Check if country code included with phone number.
     */
    public function addCountryCode(string $phone_number, int $country_code, int $count_no_code = 8): string
    {
        if (! bcsub(strlen($phone_number),strlen($count_no_code))) {
            $phone_number = $country_code . $phone_number;
        }

        return $phone_number;
    }

    /**
     * @return int
     */
    public function generateVerificationCode(): int
    {
        return rand(100000, 999999);
    }

}
