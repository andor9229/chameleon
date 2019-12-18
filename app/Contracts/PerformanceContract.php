<?php


namespace App\Contracts;


interface PerformanceContract
{
    public function getLeads();

    public function getContracts();

    public function getContractsBrand();

    public function getContractsCross();
}
