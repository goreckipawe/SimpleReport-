<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Components;
use App\Drawings_h;
use App\Departures;
use App\Ends;
use App\Diameters;
use App\Sleepers;

class ReportService
{
    public function contractualPenalties ($segment): array{
        $data = array();

        try {
            $contractual_penalties = array(
                "A" => array("days_to_install" => 90, "penalty" => 5),
                "B" => array("days_to_install" => 60, "penalty" => 10),
                "C" => array("days_to_install" => 30, "penalty" => 15)
            );

            $data = $contractual_penalties[$segment];

            return $this->data($data);
        } catch (\Exception $e){
            DB::rollBack();
            return $this->error($e);
        }
    }

    /**
     * Zadanie 2 – PHP
     *
     * @return array
     */
    public function report(): array
    {
        try {
            $customers = DB::table("customers")->select([
                "id",
                "customer_name",
                "segment",
                "city_id"
                //"city" => DB::table("cities")->select("*")->whereColumn("id", "customers.city_id")
            ])->get();

            $customers->map(function ($customer) {
                $customer->city = DB::table("cities")->select("*")->where("id", $customer->city_id)->get()->first();
                $penalty = $this->contractualPenalties($customer->segment);
                $customer->penalty = $penalty["data"];

                $installations = DB::table("installations")->select([
                    "id",
                    "order_date",
                    "segment",
                    "cost",
                    "installation_date",
                    "city_id",
                    DB::raw("DATEDIFF(IF(installation_date IS NOT NULL, installation_date, '2021-04-01'), order_date) as installation_time ")
                ])->where("customer_id", $customer->id)->get();

                $segment_installations = array();

                foreach ($installations as &$installation){
                    $installation->city = DB::table("cities")->select("*")->where("id", $installation->city_id)->get()->first();
                    $penalty = $this->contractualPenalties($installation->segment);
                    $installation->penalty = $penalty["data"];
                    unset($installation->city_id);

                    $penalty_for_exceeding_the_deadline = 0;
                    $possible_penalty_for_exceeding_the_deadline = $installation->cost * $installation->penalty["penalty"]/100;

                    if ($installation->installation_time > $installation->penalty["days_to_install"]){
                        $penalty_for_exceeding_the_deadline = $installation->cost * $installation->penalty["penalty"]/100;
                    }

                    $installation->penalty_for_exceeding_the_deadline = $penalty_for_exceeding_the_deadline;
                    $installation->possible_penalty_for_exceeding_the_deadline = $possible_penalty_for_exceeding_the_deadline;

                    array_push($segment_installations,$installation);
                }

                $customer->installations = $segment_installations;

                unset($customer->city_id);
                return $customer;
            });

            return $this->data($customers);
        } catch (\Exception $e){
            DB::rollBack();
            return $this->error($e);
        }
    }

    /**
     * Zadanie 1 – SQL
     *
     * SELECT installations.*, customer_name, cities.name,
     *   (CASE
     *   WHEN installations.segment = 'A' THEN 90
     *   WHEN installations.segment = 'B' THEN 60
     *   WHEN installations.segment = 'C' THEN 30
     *   END) AS days_to_install,
     *   (CASE
     *   WHEN installations.segment = 'A' THEN 5
     *   WHEN installations.segment = 'B' THEN 10
     *   WHEN installations.segment = 'C' THEN 15
     *   END) AS penalty,
     *   DATEDIFF(IF(installation_date IS NOT NULL, installation_date, '2021-04-01'), order_date) as installation_time
     *   FROM `installations`
     *   LEFT JOIN customers ON installations.customer_id = customers.id
     *   LEFT JOIN cities ON installations.city_id = cities.id
     */
    public function report_simplifies_version(): array
    {
        try {
            $installations = DB::table("installations")->select([
                "installations.id",
                "order_date",
                "installations.segment",
                "cost",
                "installation_date",
                "name AS city",
                "customer_name",
                DB::raw("(CASE
                    WHEN installations.segment = 'A' THEN 90
                    WHEN installations.segment = 'B' THEN 60
                    WHEN installations.segment = 'C' THEN 30
                    END) AS days_to_install"),
                DB::raw("(CASE
                    WHEN installations.segment = 'A' THEN 5
                    WHEN installations.segment = 'B' THEN 10
                    WHEN installations.segment = 'C' THEN 15
                    END) AS penalty"),
                DB::raw("DATEDIFF(IF(installation_date IS NOT NULL, installation_date, '2021-04-01'), order_date) as installation_time")
            ])->leftJoin('customers', 'installations.customer_id', '=', 'customers.id')
            ->leftJoin('cities', 'installations.city_id', '=', 'cities.id')
            ->get();

            return $this->data($installations);
        } catch (\Exception $e){
            DB::rollBack();
            return $this->error($e);
        }
    }

    public function error(\Exception $e): array {
        $data = array();

        $data["success"] = 0;
        $data["data"] = null;
        $data["error"] = 1;
        $data["error_line"] = $e->getLine();
        $data["error_message"] = $e->getMessage();
        $data["error_code"] = $e->getCode();
        $data["error_file"] = $e->getFile();
        $data["error_trace"] = $e->getTrace();

        return $data;
    }

    public function data($data_sent): array {
        $data = array();

        $data["success"] = 1;
        $data["error"] = 0;
        $data["data"] = $data_sent;

        return $data;
    }
}
