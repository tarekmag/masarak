<?php

/**
 *  Helper for Checkbox
 *
 * @param string $option1
 * @param string $option2
 * @return string checked
 */
function checked($option1, $option2)
{
    if (is_array($option2)) {
        if (in_array($option1, $option2)) {
            return "checked='checked'";
        }
    } else
    if ($option1 == $option2) {
        return "checked='checked'";
    }
}

/**
 * Helper for Dropdown
 *
 * @param string $option1
 * @param string || array $option2
 * @return string selected
 */
function selected($option1, $option2)
{
    if (is_array($option2)) {
        if (in_array($option1, $option2)) {
            return "selected='selected'";
        }
    } else
    if ($option1 == $option2) {
        return "selected='selected'";
    }
}

/**
 * Helper for Inputs
 *
 * @param string $key
 * @param object $object
 * @return string value
 */
function inputValidation($key, $object)
{
    return (old($key)) ?: $object->$key;
}

/**
 * Helper for Language Inputs
 *
 * @param array $languages
 * @param string $symbol
 * @param string $key
 * @return string $value
 */
function inputLangValidation($languages, $symbol, $key)
{
    if (isset(old('languages')[$symbol][$key])) {
        return old('languages')[$symbol][$key];
    }

    $language = $languages->where('language_id', $symbol)->first();
    if ($language) {
        return $language->$key;
    }
}

/**
 * Helper for Generate Random Numbers
 *
 * @param int $length
 * @return int value
 */
function generateRandomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

/**
 * Helper for Transalte From English To Arabic Numbers
 *
 * @param int $length
 * @return int value
 */
function transalteFromEnglishToArabic($string) {
    $english = array('0','1','2','3','4','5','6','7','8','9');
    $arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
    return str_replace($english, $arabic, $string);
}
