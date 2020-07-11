<?php
/**
 * The $minute variable contains a number from 0 to 59 (i.e. 10 or 25 or 60 etc).
 * Determine in which quarter of an hour the number falls.
 * Return one of the values: "first", "second", "third" and "fourth".
 * Throw InvalidArgumentException if $minute is negative of greater then 60.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $minute
 * @return string
 * @throws InvalidArgumentException
 */
function getMinuteQuarter(int $minute) : string
{
    if ($minute < 0 || $minute > 60) {
        throw new InvalidArgumentException();
    }

    if ($minute === 0 ){
        return 'fourth';
    } elseif ($minute <= 15 ){
        return 'first';
    } elseif ($minute <= 30 ){
        return 'second';
    } elseif ($minute <= 45 ){
        return 'third';
    } else {
        return 'fourth';
    }
}

/**
 * The $year variable contains a year (i.e. 1995 or 2020 etc).
 * Return true if the year is Leap or false otherwise.
 * Throw InvalidArgumentException if $year is lower than 1900.
 * @see https://en.wikipedia.org/wiki/Leap_year
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $year
 * @return boolean
 * @throws InvalidArgumentException
 */
function isLeapYear(int $year) : bool
{
    if ($year < 1900){
       throw new InvalidArgumentException();
    }

    if ($year % 400 === 0){
        return true;
    } elseif ($year % 100 === 0){
        return false;
    } elseif ($year % 4 === 0){
        return true;
    } else {
        return false;
    }
}

/**
 * The $input variable contains a string of six digits (like '123456' or '385934').
 * Return true if the sum of the first three digits is equal with the sum of last three ones
 * (i.e. in first case 1+2+3 not equal with 4+5+6 - need to return false).
 * Throw InvalidArgumentException if $input contains more than 6 digits.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  string  $input
 * @return boolean
 * @throws InvalidArgumentException
 */
function isSumEqual(string $input) : bool
{
    if (strlen($input) !== 6){
        throw new InvalidArgumentException();
    }
    //Will accumulate the diff
    $result = 0;
    //I don't know, could be more readable but looks more optimized )
    for ($i = 0; $i < 3; $i++){
        $result += (int) $input[$i] - (int) $input[$i + 3];
    }
    //If diff is 0 - equals
    if ($result === 0){
        return true;
    } else {
        return false;
    }
}