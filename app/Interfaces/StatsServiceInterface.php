<?php

namespace App\Interfaces;

interface StatsServiceInterface
{
    /**
     * @return mixed
     */
    public function lastMonth();

    /**
     * @return mixed
     */
    public function lastYear();

    /**
     * @return mixed
     */
    public function lastWeek();

    /**
     * @return mixed
     */
    public function avgLastYear();

    /**
     * @return mixed
     */
    public function avgLastWeek();

    /**
     * @return mixed
     */
    public function avgLastMonth();

    /**
     * @return mixed
     */
    public function statsToPDF();
}
