<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports) : array
{
    $result = [];

    foreach ($airports as $airport) {
        array_push($result, mb_substr($airport['name'], 0, 1)); 
    }

    $result = array_unique($result);
    sort($result, SORT_STRING);

    return $result;
}
/**
 * According to our task, we need keep filter and sort parameters in URL
 * This functions realize it, taking $_SESSION parameters and added it to URL
 * We suppose that one button will have only one additional param i.e. filter or sort
 * Hence, we excpect only one element in $additionalParam array
 * 
 * @param string url
 * @param array $additionalParam
 * 
 * @return string
 */
function addParametersToUrl(string $url, array $additionalParam = null) : string
{
    if (isset($additionalParam)) {
        
        $paramsArray = $_SESSION;
        $paramKey = array_key_first($additionalParam);
        $paramsArray[$paramKey] = $additionalParam[$paramKey];

        return $url . '&' . http_build_query($paramsArray);
    }
    //if session is empty we have to miss '&' symbol
    return $url . (!empty($_SESSION) ? '&' : '') . http_build_query($_SESSION);
}
/**
 * Sort array by key
 * 
 * Took this snipet from https://www.php.net/manual/en/function.sort.php#99419
 * 
 * @param array $array - Input array
 * @param string $on - Key for sorting
 * 
 * @return array
 */
function array_sort(array $array, string $on, $order=SORT_ASC) : array
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
