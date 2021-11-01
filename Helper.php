<?php

declare(strict_types = 1);

/**
 * Helper
 * @author George Martinec <github.com/george-martinec>
 *
 * @noinspection PhpUnused
 */
class Helper {

    /**
     * Convert array to object
     *
     * @param array $array
     *
     * @return object
     * @noinspection PhpUnused
     */
    public static function toObject(
        array $array
    ) {
        return (object) $array;
    }

    /**
     * Calculate the sum of the ArrayColumn
     *
     * @param array $array
     * @param string $column_key
     *
     * @return int|float
     * @noinspection PhpUnused
     */
    public static function sumArrayColumn(
        array $array,
        string $column_key
    ) {
        return array_sum(
            array_column($array, $column_key)
        );
    }

    /**
     * Get current date in GoodDay format
     *
     * @return string
     * @noinspection PhpUnused
     */
    public static function currentDate(): string
    {
        return date("Y-m-d", strtotime("now"));
    }

    /**
     * Get date in GoodDay format
     *
     * @param string $datetime
     *
     * @url https://www.php.net/manual/en/function.strtotime.php
     *
     * @return string
     * @noinspection PhpUnused
     */
    public static function getDate(string $datetime): string
    {
        return date("Y-m-d", strtotime($datetime));
    }

    /**
     * Dump
     *
     * @return void
     * @noinspection PhpUnused
     */
    public static function d()
    {
        print("<pre>");
        foreach (func_get_args() as $arg) {
            print_r($arg);
        }
        print("</pre>");
    }

    /**
     * Dump and Die
     *
     * @return void
     * @noinspection PhpUnused
     */
    public static function dd()
    {
        print("<pre>");
        foreach (func_get_args() as $arg) {
            print_r($arg);
        }
        print("</pre>");
        exit();
    }

}
