<?php

namespace App\Interfaces;

interface StatsServiceInterface
{
    /**
     * @return mixed
     */
    public function lastMonth(): mixed;

    /**
     * @return mixed
     */
    public function lastYear(): mixed;

    /**
     * @return mixed
     */
    public function lastWeek(): mixed;

    /**
     * @return mixed
     */
    public function avgLastYear(): mixed;

    /**
     * @return mixed
     */
    public function avgLastWeek(): mixed;

    /**
     * @return mixed
     */
    public function avgLastMonth(): mixed;

    /**
     * @return mixed
     */
    public function statsToPDF(): mixed;
}
