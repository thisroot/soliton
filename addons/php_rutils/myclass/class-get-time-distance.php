<?php

class Dt
{
    public static $PREFIX_IN = "через"; //Prefix 'in' (i.e. B{in} three hours)
    public static $SUFFIX_AGO = "назад"; //Prefix 'ago' (i.e. three hours B{ago})

    private static $_DAY_NAMES = array(
        array('пн', 'понедельник', 'понедельник', "в\xC2\xA0"),
        array('вт', 'вторник', 'вторник', "во\xC2\xA0"),
        array('ср', 'среда', 'среду', "в\xC2\xA0"),
        array('чт', 'четверг', 'четверг', "в\xC2\xA0"),
        array('пт', 'пятница', 'пятницу', "в\xC2\xA0"),
        array('сб', 'суббота', 'субботу', "в\xC2\xA0"),
        array('вск', 'воскресенье', 'воскресенье', "в\xC2\xA0")
    ); //Day alternatives (i.e. one day ago -> yesterday)

    private static $_MONTH_NAMES = array(
        array("янв", "январь", "января"),
        array("фев", "февраль", "февраля"),
        array("мар", "март", "марта"),
        array("апр", "апрель", "апреля"),
        array("май", "май", "мая"),
        array("июн", "июнь", "июня"),
        array("июл", "июль", "июля"),
        array("авг", "август", "августа"),
        array("сен", "сентябрь", "сентября"),
        array("окт", "октябрь", "октября"),
        array("ноя", "ноябрь", "ноября"),
        array("дек", "декабрь", "декабря"),
    ); //Forms (1, 2, 5) for noun 'day'

    private static $_PAST_ALTERNATIVES = array("вчера", "позавчера");
    private static $_YEAR_VARIANTS = array("год", "года", "лет"); //Forms (1, 2, 5) for noun 'year'
    private static $_MONTH_VARIANTS = array("месяц", "месяца", "месяцев");
    private static $_DAY_VARIANTS = array("день", "дня", "дней");
    private static $_HOUR_VARIANTS = array("час", "часа", "часов");
    private static $_MINUTE_VARIANTS = array("минуту", "минуты", "минут");

    private static $_DISTANCE_FIELDS = array('y', 'm', 'd', 'h', 'i');

    /**
     * Russian \DateTime::format
     * @param array|\php_rutils\struct\TimeParams $params Params structure
     * @return string Date/time string representation
     */
    public function ruStrFTime($params = null)
    {
        //Params handle
        if ($params === null)
            $params = new TimeParams();
        elseif (is_array($params))
            $params = TimeParams::create($params);
        else
            $params = clone $params;

        if ($params->date === null)
            $params->date = new \DateTime();
        else
            $params->date = $this->_processDateTime($params->date);

        if (is_string($params->timezone))
            $params->timezone = new \DateTimeZone($params->timezone);
        if ($params->timezone)
            $params->date->setTimezone($params->timezone);

        //Format processing
        $weekday = $params->date->format('N') - 1;
        $month = $params->date->format('n') - 1;

        $prepos = $params->preposition ? self::$_DAY_NAMES[$weekday][3] : '';

        $monthIdx = $params->monthInflected ? 2 : 1;
        $dayIdx = ($params->dayInflected || $params->preposition) ? 2 : 1;

        $search = array('D', 'l', 'M', 'F');
        $replace = array(
            $prepos.self::$_DAY_NAMES[$weekday][0],
            $prepos.self::$_DAY_NAMES[$weekday][$dayIdx],
            self::$_MONTH_NAMES[$month][0],
            self::$_MONTH_NAMES[$month][$monthIdx],
        );

        //for russian typography standard,
        //1 April 2007, but 01.04.2007
        if (strpos($params->format, 'F') !== false || strpos($params->format, 'M') !== false) {
            $search[] = 'd';
            $replace[] = 'j';
        }

        $params->format = str_replace($search, $replace, $params->format);

        //Create date/time string
        return $params->date->format($params->format);
    }

    /**
     * Process mixed format date
     * @param mixed $dateTime
     * @return \DateTime
     * @throws \InvalidArgumentException
     */
    private function _processDateTime($dateTime)
    {
        if (is_numeric($dateTime)) {
            $timestamp = $dateTime;
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($timestamp);
        }
        elseif (empty($dateTime)) {
            throw new \InvalidArgumentException('Date/time is empty');
        }
        elseif (is_string($dateTime)) {
            $dateTime = new \DateTime($dateTime);
        }

        if (!($dateTime instanceof \DateTime)) {
            throw new \InvalidArgumentException('Incorrect date/time type');
        }
        return $dateTime;
    }

    /**
     * Represents distance of time in words
     * @param string|int|\DateTime $toTime Source time
     * @param string|int|\DateTime $fromTime Target time
     * @param int $accuracy Level of accuracy (year, month, day, hour, minute), default=year
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return string Distance of time in words
     */
    public function distanceOfTimeInWords($toTime, $fromTime=null, $accuracy=RUtils::ACCURACY_YEAR) {
        $accuracy = (int)$accuracy;
        if ($accuracy < 1 || $accuracy > 5)
            throw new \InvalidArgumentException('Wrong accuracy value (must be 1..5)');

        /* @var $toTime \DateTime */
        /* @var $fromTime \DateTime */
        /* @var $timeZone \DateTimeZone */
        /* @var $fromCurrent bool */
        list($toTime, $fromTime, $timeZone, $fromCurrent) = $this->_processFunctionParams($toTime, $fromTime);
        $interval = $toTime->diff($fromTime);

        //if diff less than one minute
        if ($interval->days == 0 && $interval->h == 0 && $interval->i == 0) {
            if ($interval->invert)
                $result = 'менее чем через минуту';
            else
                $result = 'менее минуты назад';
            return $result;
        }

        //create distance table
        $distanceData = $this->_createDistanceData($interval, $fromCurrent);
        $words = $this->_getResultWords($accuracy, $distanceData);

        //check short result
        if ($fromCurrent && min($accuracy, sizeof($words)) == 1) {
            //if diff expressed in one word
            $result = $this->_getOneWordResult($interval);
            if ($result) {
                return $result;
            }
            elseif ($interval->days < 3) {
                //if diff 1 or 2 days
                $result = $this->_getTwoDaysResult($interval, $toTime, $timeZone);
                if ($result)
                    return $result;
            }
        }

        //general case
        $result = implode(', ', $words);
        return $this->_addResultSuffix($interval, $result);
    }

    private function _processFunctionParams($toTime, $fromTime)
    {
        $toTime = $this->_processDateTime($toTime);
        $timeZone = $toTime->getTimezone();

        $fromCurrent = false;
        if ($fromTime === null) {
            $fromTime = new \DateTime('now', $timeZone);
            $fromCurrent = true;
        }
        else {
            $fromTime = $this->_processDateTime($fromTime);
        }

        return array($toTime, $fromTime, $timeZone, $fromCurrent);
    }

    private function _createDistanceData(\DateInterval $interval)
    {
        $distanceData = array(); //table of word representations
        $numeral = RUtils::numeral();

        $years = $interval->y;
        if ($years)
            $distanceData['y'] = $numeral->getPlural($years, self::$_YEAR_VARIANTS);

        $months = $interval->m;
        if ($months)
            $distanceData['m'] = $numeral->getPlural($months, self::$_MONTH_VARIANTS);

        $days = $interval->d;
        if ($days)
            $distanceData['d'] = $numeral->getPlural($days, self::$_DAY_VARIANTS);

        $hours = $interval->h;
        if ($hours)
            $distanceData['h'] = $numeral->getPlural($hours, self::$_HOUR_VARIANTS);

        $minutes = $interval->i;
        if ($minutes)
            $distanceData['i'] = $numeral->getPlural($minutes, self::$_MINUTE_VARIANTS);

        return $distanceData;
    }

    private function _getYearResult(array $distanceData)
    {
        return $this->_getLevelResult('y', $distanceData);
    }

    private function _getMonthResult(array $distanceData)
    {
        list($words, $borderField) = $this->_getYearResult($distanceData);
        return $this->_getLevelResult('m', $distanceData, $words, $borderField);
    }

    private function _getDaysResult(array $distanceData)
    {
        list($words, $borderField) = $this->_getMonthResult($distanceData);
        return $this->_getLevelResult('d', $distanceData, $words, $borderField);
    }

    private function _getHoursResult(array $distanceData)
    {
        list($words, $borderField) = $this->_getDaysResult($distanceData);
        return $this->_getLevelResult('h', $distanceData, $words, $borderField);
    }

    private function _getMinutesResult(array $distanceData)
    {
        list($words, $borderField) = $this->_getHoursResult($distanceData);
        return $this->_getLevelResult('i', $distanceData, $words, $borderField);
    }

    private function _getLevelResult($fieldCode, array $distanceData, array $words=array(), $borderField=-1)
    {
        $curPos = array_search($fieldCode, self::$_DISTANCE_FIELDS);
        if ($borderField >= $curPos)
            return array($words, $borderField);

        $nextField = $borderField + 1;
        $length = sizeof(self::$_DISTANCE_FIELDS);
        for ($i=$nextField; $i < $length; ++$i) {
            $field = self::$_DISTANCE_FIELDS[$i];
            if ($borderField != -1 && $i > $curPos) {
                break;
            }
            elseif (isset($distanceData[$field])) {
                $words[] = $distanceData[$field];
                $borderField = $i;
                break;
            }
        }
        return array($words, $borderField);
    }

    private function _getOneWordResult(\DateInterval $interval)
    {
        $result = null;
        if ($interval->days == 0 && $interval->h == 0 && $interval->i == 1)
            $result = 'минуту';
        elseif ($interval->days == 0 && $interval->h == 1)
            $result = 'час';
        elseif ($interval->y == 0 && $interval->m == 1)
            $result = 'месяц';
        elseif ($interval->y == 1)
            $result = 'год';

        if ($result)
            $result = $this->_addResultSuffix($interval, $result);
        return $result;
    }

    /**
     * Add suffix or Postfix to string.
     * @param \DateInterval $interval
     * @param $result string
     * @return string modified $result.
     */
    private function _addResultSuffix(\DateInterval $interval, $result)
    {
        return $interval->invert ? self::$PREFIX_IN . "\xC2\xA0" . $result : $result . "\xC2\xA0" . self::$SUFFIX_AGO;
    }

    private function _getTwoDaysResult(\DateInterval $interval, \DateTime $toTime, \DateTimeZone $timeZone = null)
    {
        $result = null;
        $days = $interval->days;

        if ($interval->invert == 0 && ($days == 1 || $days == 2)) {
            $variant = $days - 1;
            $result = self::$_PAST_ALTERNATIVES[$variant];
        }
        elseif ($interval->invert && ($days == 0 || $days == 1)) {
            $tomorrow = new \DateTime('today', $timeZone);
            $tomorrow->add(new \DateInterval('P1D'));
            $afterTomorrow = new \DateTime('today', $timeZone);
            $afterTomorrow->add(new \DateInterval('P2D'));

            if ($toTime >= $tomorrow && $toTime < $afterTomorrow)
                $result = 'завтра';
            elseif ($days == 1 && $toTime >= $afterTomorrow)
                $result = 'послезавтра';
        }

        return $result;
    }

    private function _getResultWords($accuracy, $distanceData)
    {
        switch ($accuracy) {
            case RUtils::ACCURACY_YEAR:
                list($words,) = $this->_getYearResult($distanceData);
                break;
            case RUtils::ACCURACY_MONTH:
                list($words,) = $this->_getMonthResult($distanceData);
                break;
            case RUtils::ACCURACY_DAY:
                list($words,) = $this->_getDaysResult($distanceData);
                break;
            case RUtils::ACCURACY_HOUR:
                list($words,) = $this->_getHoursResult($distanceData);
                break;
            case RUtils::ACCURACY_MINUTE:
                list($words,) = $this->_getMinutesResult($distanceData);
                break;
            default:
                throw new \RuntimeException("Unexpected accuracy level: $accuracy");
        }
        return $words;
    }

    /**
     * Calculates age
     * @param string|int|\DateTime $birthDate Date of birth
     * @throws \InvalidArgumentException
     * @return int Full years age
     */
    public function getAge($birthDate)
    {
        $birthDate = $this->_processDateTime($birthDate);
        $interval = $birthDate->diff(new \DateTime());
        if ($interval->invert)
            throw new \InvalidArgumentException('Birth date is in future');
        return $interval->y;
    }
}

class RUtils
{
    //gender constants
    const MALE = 1;
    const FEMALE = 2;
    const NEUTER = 3;

    //accuracy for Dt::distanceOfTimeInWords function
    const ACCURACY_YEAR = 1;
    const ACCURACY_MONTH = 2;
    const ACCURACY_DAY = 3;
    const ACCURACY_HOUR = 4;
    const ACCURACY_MINUTE = 5;

    private static $_numeral;
    private static $_dt;
    private static $_translit;
    private static $_typo;

    /**
     * Plural forms and in-word representation for numerals
     * @return \php_rutils\Numeral
     */
    public static function numeral()
    {
        if (self::$_numeral === null)
            self::$_numeral = new Numeral();
        return self::$_numeral;
    }

    /**
     * Russian dates without locales
     * @return \php_rutils\Dt
     */
    public static function dt()
    {
        if (self::$_dt === null)
            self::$_dt = new Dt();
        return self::$_dt;
    }

    /**
     * Simple transliteration
     * @return \php_rutils\Translit
     */
    public static function translit()
    {
        if (self::$_translit === null)
            self::$_translit = new Translit();
        return self::$_translit;
    }

    /**
     * Russian typography
     * @return \php_rutils\Typo
     */
    public static function typo()
    {
        if (self::$_typo === null)
            self::$_typo = new Typo();
        return self::$_typo;
    }

    /**
     * Format number with russian locale
     * @param float $number
     * @param int $decimals
     * @return string
     */
    public static function formatNumber($number, $decimals=0)
    {
        $number = number_format($number, $decimals, ',', ' ');
        return str_replace(' ', "\xE2\x80\x89", $number);
    }
}

class TimeParams
{
    /**
     * Date format, use PHP date() function specification:
     * http://www.php.net/manual/en/function.date.php
     * @var string
     */
    public $format = 'd.m.Y';

    /**
     * Date value, default=null translates to 'now'.
     * For string values use matched PHP rules:
     * http://www.php.net/manual/en/datetime.formats.php
     * Int value as Unix timestamp
     * @var string|int|\DateTime
     */
    public $date = null;

    /**
     * Timezone value, default=null translates to default PHP timezone.
     * For string values use matched PHP rules:
     * http://www.php.net/manual/en/timezones.php
     * @var string|\DateTimeZone|null
     */
    public $timezone = null;

    /**
     * Is month inflected (января, февраля), default false
     * @var bool
     */
    public $monthInflected = false;

    /**
     * Is day inflected (среду, пятницу) default false
     * @var bool
     */
    public $dayInflected = false;

    /**
     * Is preposition used (во вторник), default false
     * $preposition=true automatically implies $dayInflected=true
     * @var bool
     */
    public $preposition = false;

    /**
     * Create params from array or with default values
     * @param array|null $aParams
     * @return TimeParams
     */
    public static function create(array $aParams=null)
    {
        $params = new self();
        if ($aParams === null)
            return $params;

        foreach ($aParams as $name => $value)
            $params->$name = $value;

        return $params;
    }

    public function __set($name, $value)
    {
        throw new \InvalidArgumentException("Wrong parameter name: $name");
    }
}

class Numeral
{
    private static $_FRACTIONS = array(
        array('десятая', 'десятых', 'десятых'),
        array('сотая', 'сотых', 'сотых'),
        array('тысячная', 'тысячных', 'тысячных'),
        array('десятитысячная', 'десятитысячных', 'десятитысячных'),
        array('стотысячная', 'стотысячных', 'стотысячных'),
        array('миллионная', 'милллионных', 'милллионных'),
        array('десятимиллионная', 'десятимилллионных', 'десятимиллионных'),
        array('стомиллионная', 'стомилллионных', 'стомиллионных'),
        array('миллиардная', 'миллиардных', 'миллиардных'),
    ); //Forms (1, 2, 5) for fractions

    private static $_ONES = array(
        array('', '', ''),
        array('один', 'одна', 'одно'),
        array('два', 'две', 'два'),
        array('три', 'три', 'три'),
        array('четыре', 'четыре', 'четыре'),
        array('пять', 'пять', 'пять'),
        array('шесть', 'шесть', 'шесть'),
        array('семь', 'семь', 'семь'),
        array('восемь', 'восемь', 'восемь'),
        array('девять', 'девять', 'девять'),
    ); //Forms (MALE, FEMALE, NEUTER) for ones

    private static $_TENS = array(
        0 => '',
        //1 - special variant
        10 => 'десять',
        11 => 'одиннадцать',
        12 => 'двенадцать',
        13 => 'тринадцать',
        14 => 'четырнадцать',
        15 => 'пятнадцать',
        16 => 'шестнадцать',
        17 => 'семнадцать',
        18 => 'восемнадцать',
        19 => 'девятнадцать',
        2 => 'двадцать',
        3 => 'тридцать',
        4 => 'сорок',
        5 => 'пятьдесят',
        6 => 'шестьдесят',
        7 => 'семьдесят',
        8 => 'восемьдесят',
        9 => 'девяносто',
    ); //Tens

    private static $_HUNDREDS = array(
        0 => '',
        1 => 'сто',
        2 => 'двести',
        3 => 'триста',
        4 => 'четыреста',
        5 => 'пятьсот',
        6 => 'шестьсот',
        7 => 'семьсот',
        8 => 'восемьсот',
        9 => 'девятьсот',
    ); //Hundreds

    /**
     * Get proper case with value
     * @param int $amount Amount of objects
     * @param array $variants Variants (forms) of object in such form: array('1 object', '2 objects', '5 objects')
     * @param string|null $absence If amount is zero will return it
     * @return string|null
     */
    public function getPlural($amount, array $variants, $absence = null)
    {
        if ($amount || $absence === null)
            $result = RUtils::formatNumber($amount).' '.$this->choosePlural($amount, $variants);
        else
            $result = $absence;
        return $result;
    }

    /**
     * Choose proper case depending on amount
     * @param int $amount Amount of objects
     * @param string[] $variants Variants (forms) of object in such form: array('1 object', '2 objects', '5 objects')
     * @return string Proper variant
     * @throws \InvalidArgumentException Variants' length lesser than 3
     */
    public function choosePlural($amount, array $variants)
    {
        if (sizeof($variants) < 3)
            throw new \InvalidArgumentException('Incorrect values length (must be 3)');

        $amount = abs($amount);
        $mod10 = $amount%10;
        $mod100 = $amount%100;

        if ($mod10 == 1 && $mod100 != 11)
            $variant = 0;
        elseif ($mod10 >= 2 && $mod10 <= 4 && !($mod100 > 10 && $mod100 < 20))
            $variant = 1;
        else
            $variant = 2;

        return $variants[$variant];
    }

    /**
     * Get sum in words
     * @param int $amount Amount of objects (0 <= amount <= PHP_INT_MAX)
     * @param int $gender Gender of object (MALE, FEMALE or NEUTER)
     * @param array $variants Variants (forms) of object in such form: array('1 object', '2 objects', '5 objects')
     * @return string In-words representation objects' amount
     * @throws \RangeException
     * @throws \InvalidArgumentException
     */
    public function sumString($amount, $gender, array $variants=null)
    {
        if ($variants === null)
            $variants = array_fill(0, 3, '');
        if (sizeof($variants) < 3)
            throw new \InvalidArgumentException('Incorrect items length (must be 3)');
        if ($amount < 0)
            throw new \InvalidArgumentException('Amount must be positive or 0');

        if ($amount == 0)
            return  trim('ноль '.$variants[2]);

        $result = '';
        $tmpVal = $amount;

        //ones
        list($result, $tmpVal) = $this->_sumStringOneOrder($result, $tmpVal, $gender, $variants);
        //thousands
        list($result, $tmpVal) = $this->_sumStringOneOrder($result, $tmpVal,  RUtils::FEMALE,
                                                           array('тысяча', 'тысячи', 'тысяч'));
        //millions
        list($result, $tmpVal) = $this->_sumStringOneOrder($result, $tmpVal,  RUtils::MALE,
                                                           array('миллион', 'миллиона', 'миллионов'));
        //billions
        list($result,) = $this->_sumStringOneOrder($result, $tmpVal, RUtils::MALE,
                                                   array('миллиард', 'миллиарда', 'миллиардов'));
        return trim($result);
    }

    /**
     * Make in-words representation of single order
     * @param string $prevResult In-words representation of lower orders
     * @param int $tmpVal Temporary value without lower orders
     * @param int $gender (MALE, FEMALE or NEUTER)
     * @param string[] $variants Variants of objects
     * @throws \RangeException
     * @return array ($result, $tmpVal)
     */
    private function _sumStringOneOrder($prevResult, $tmpVal, $gender, array $variants)
    {
        if ($tmpVal == 0)
            return array($prevResult, $tmpVal);

        $words = array();
        $fiveItems = $variants[2];
        $rest = $tmpVal%1000;
        if ($rest < 0)
            throw new \RangeException('Int overflow');

        $tmpVal = intval($tmpVal/1000);

        //check last digits are 0
        if ($rest == 0) {
            if (!$prevResult)
                $prevResult = $fiveItems.' ';
            return array($prevResult, $tmpVal);
        }

        //hundreds
        $words[] = self::$_HUNDREDS[intval($rest/100)];

        //tens
        $rest %= 100;
        $rest1 = intval($rest/10);
        $words[] = ($rest1 == 1) ? self::$_TENS[$rest] : self::$_TENS[$rest1];

        //ones
        if ($rest1 == 1) {
            $endWord = $fiveItems;
        }
        else {
            $amount = $rest%10;
            $words[] = self::$_ONES[$amount][$gender-1];
            $endWord = $this->choosePlural($amount, $variants);
        }
        $words[] = $endWord;

        $words[] = $prevResult;
        $words = array_filter($words, 'strlen');

        $result = trim(implode(' ', $words));
        return array($result, $tmpVal);
    }

    /**
     * Numeral in words
     * @param float $amount Amount of objects
     * @param int|null $gender (MALE, FEMALE, NEUTER or null)
     * @return string In-words representation of numeral
     */
    public function getInWords($amount, $gender=RUtils::MALE)
    {
        if ($amount == (int)$amount)
            return $this->getInWordsInt($amount, $gender);
        else
            return $this->getInWordsFloat($amount);
    }

    /**
     * Integer in words
     * @param int $amount Amount of objects (0 <= amount <= PHP_INT_MAX)
     * @param int $gender (MALE, FEMALE or NEUTER)
     * @return string In-words representation of numeral
     */
    public function getInWordsInt($amount, $gender=RUtils::MALE)
    {
        $amount = round($amount);
        return $this->sumString($amount, $gender);
    }

    /**
     * Float in words
     * @param float $amount Amount of objects
     * @return string In-words representation of float numeral
     */
    public function getInWordsFloat($amount)
    {
        $words = array();

        $intPart = (int)$amount;
        $pointVariants = array('целая', 'целых', 'целых');
        $words[] = $this->sumString($intPart, RUtils::FEMALE, $pointVariants);

        $remainder = $this->_getFloatRemainder($amount);
        $signs = strlen($remainder) - 1;
        $words[] = $this->sumString($remainder, RUtils::FEMALE, self::$_FRACTIONS[$signs]);

        $result = trim(implode(' ', $words));
        return $result;
    }

    /**
     * Get remainder of float, i.e. 2.05 -> '05'
     * @param float $value
     * @param int $signs
     * @return string
     */
    private function _getFloatRemainder($value, $signs=9)
    {
        if ($value == (int)$value)
            return '0';

        $signs = min($signs, sizeof(self::$_FRACTIONS));
        $value = number_format($value, $signs, '.', '');
        list(, $remainder) = explode('.', $value);
        $remainder = preg_replace('/0+$/', '', $remainder);
        if (!$remainder)
            $remainder = '0';

        return $remainder;
    }

    /**
     * Get string for money (RUB)
     * @param float $amount Amount of money
     * @param bool $zeroForKopeck If false, then zero kopecks ignored
     * @return string   In-words representation of money's amount
     * @throws \InvalidArgumentException
     */
    public function getRubles($amount, $zeroForKopeck=false)
    {
        if ($amount < 0)
            throw new \InvalidArgumentException('Amount must be positive or 0');

        $words = array();
        $amount = round($amount, 2);

        $iAmount = (int)$amount;
        if ($iAmount)
            $words[] = $this->sumString((int)$amount, RUtils::MALE,
                                        array('рубль', 'рубля', 'рублей'));

        $remainder = $this->_getFloatRemainder($amount, 2);
        if ($remainder || $zeroForKopeck) {
            if ($remainder < 10 && strlen($remainder) == 1)
                $remainder *= 10;
            $words[] = $this->sumString($remainder, RUtils::FEMALE,
                                        array('копейка', 'копейки', 'копеек'));
        }

        return trim(implode(' ', $words));
    }
}