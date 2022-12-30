<?php

namespace App\Http\Utils;

use App\Http\Constants\ErrorConstants;
use App\Models\Errors;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;

class DateUtils
{
    public static function getPeriodDate($parameter, $format = "Y-m-d")
    {
        return date($format, strtotime($parameter));
    }

    public static function modifyDate(string $date, string $additional): string
    {
        return date('Y-m-d', strtotime($additional, strtotime($date)));
    }
    public static function stringToDate($string)
    {
        if (!empty($string)) {
            $array = explode("/", $string);

            if (count($array) == 3) {
                return $array[2] . "-" . $array[1] . "-" . $array[0];
            }

            return false;
        }

        return false;
    }

    /**
     * @param $string
     * @return false|string[] dia, mes e ano
     */
    public static function stringToArray($string)
    {
        if (!empty($string)) {
            $array = explode("/", $string);

            if (count($array) == 3) {
                return [
                    'day' => $array[0],
                    'month' => $array[1],
                    'year' => $array[2]
                ];
            }

            return false;
        }

        return false;
    }

    /**
     * @throws Exception
     */
    public static function validateBirthDate($date): bool
    {
        $currentDate = self::dateToArray(self::getCurrentDate());
        $birthDate = self::dateToArray($date);

        if ($birthDate['year'] >= $currentDate['year']) {
            return false;
        }

        return true;
    }

    public static function getDaysDifference($firstDate, $secondDate)
    {
        $first = new DateTime($firstDate);
        $second = new DateTime($secondDate);

        $interval = $first->diff($second);

        return $interval->days;
    }

    public static function getMonthsDifference($firstDate, $secondDate)
    {
        $first = new DateTime($firstDate);
        $second = new DateTime($secondDate);

        $interval = $first->diff($second);

        return $interval->m + ($interval->y * 12);
    }

    /**
     * @throws Exception
     */
    public static function getLastDayOfMonth($date)
    {
        $dateTime = new DateTime($date);
        $dateTime->modify('last day of this month');
        return $dateTime->format('d');
    }

    public static function dateToStringPrefixedDate($date, $month, $year)
    {
        $dateTimeTest = new DateTime($date);
        $dayTest = $dateTimeTest->format('d');
        $dateTest = "$year-$month-$dayTest";

        $currentDateTime = new DateTime("$year-$month-01");
        if (self::validateDate($dateTest)) {
            $currentDateTime = new DateTime("$year-$month-$dayTest");
        }

        $month = $currentDateTime->format('m');
        $year = $currentDateTime->format('Y');
        $lastDayOfMonth = $currentDateTime->format('t');

        if ($dayTest > $lastDayOfMonth) {
            return "$lastDayOfMonth/$month/$year";
        }

        return "$dayTest/$month/$year";
    }

    public static function dateToString($date, $stringDefault = "Nenhum")
    {
        if (!empty($date)) {
            $formattedDate = self::formatDate($date);
            $array = explode("-", $formattedDate);

            if (count($array) == 3) {
                return $array[2] . "/" . $array[1] . "/" . $array[0];
            }

            return $stringDefault;
        }

        return $stringDefault;
    }

    public static function dateToHour($date, $format = "H:i:s")
    {
        $dateTime = new DateTime($date);
        return $dateTime->format($format);
    }

    public static function dateToArray($date)
    {
        if (!empty($date)) {
            $formattedDate = self::formatDate($date);
            $array = explode("-", $formattedDate);

            if (count($array) == 3) {
                return [
                    'day' => $array[2],
                    'month' => $array[1],
                    'year' => $array[0]
                ];
            }

            return false;
        }

        return false;
    }

    public static function getArrayFromDate($date)
    {
        if (!empty($date)) {
            $formattedDate = self::formatDate($date);
            $array = explode("-", $formattedDate);

            if (count($array) == 3) {
                return $array;
            }

            return false;
        }

        return false;
    }

    public static function validateDate($date, $format = 'Y-m-d H:i:s'): bool
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function getCurrentDate(): string
    {
        $dateTime = new DateTime('now');
        return $dateTime->format('Y-m-d');
    }

    public static function formatDate($date, $format = "Y-m-d")
    {
        try {
            $formattedDate = new DateTime($date);

            return $formattedDate->format($format);
        } catch (Exception $e) {
            Errors::insert($e->getMessage(), ErrorConstants::DATE_UTILS, $e->getFile(), 'formatDate');
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public static function getNextDates(string $selectedDate, int $quantity, string $addition = "+1 month"): array
    {
        $dateTime = new DateTime($selectedDate);

        $dates = [];
        $day = $dateTime->format('d');
        $month = $dateTime->format('m');
        $year = $dateTime->format('Y');

        $dates[0]['date'] = $dateTime->format('Y-m-d');
        $dates[0]['day'] = $day;
        $dates[0]['month'] = $month;
        $dates[0]['year'] = $year;

        for ($i = 1; $i < $quantity; $i++) {
            if ($month >= 12) {
                $year++;
                $month = 1;
            } else {
                $month++;
            }
            $currentDateTime = new DateTime("$year-$month-01");
            $lastDayOfMonth = $currentDateTime->format('t');
            $monthString = ($month < 10) ? "0$month" : $month;

            if ($day > $lastDayOfMonth) {
                $dates[$i]['date'] = "$year-$monthString-$lastDayOfMonth";
                $dates[$i]['day'] = "$lastDayOfMonth";
                $dates[$i]['month'] = "$monthString";
                $dates[$i]['year'] = "$year";
                continue;
            }

            $dates[$i]['date'] = "$year-$monthString-$day";
            $dates[$i]['day'] = "$day";
            $dates[$i]['month'] = "$monthString";
            $dates[$i]['year'] = "$year";
        }

        return $dates;
    }

    public static function getDateRangesArray($from, $to): array
    {
        $currentDate = $from;
        $return = [];

        while ($currentDate < $to) {
            $return[] = [
                "from" => $currentDate,
                "to" => self::modifyDate($currentDate, "+1 day")
            ];

            $currentDate = self::modifyDate($currentDate, "+1 day");
        }

        return $return;
    }

    public static function getYesterday()
    {
        $dia = date('d') - 1;
        $mes = date('m');
        $ano = date('Y');
        $data = mktime(0, 0, 0, $mes, $dia, $ano);
        return date('Y-m-d', $data);
    }
}
