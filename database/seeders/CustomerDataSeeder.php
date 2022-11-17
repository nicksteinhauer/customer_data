<?php

namespace Database\Seeders;

use App\Models\CustomerData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class CustomerDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CustomerData::truncate();

        $json = File::get("database/data/customer_data.json");
        $customer_data = json_decode($json);


        foreach ($customer_data as $key => $value) {
            CustomerData::create([
                "first_name" => $value->first_name,
                "last_name" => $value->last_name,
                "email" => $value->email,
                "gender" => $value->gender,
                "street" => $value->street,
                "street_number" => $value->street_number,
                "zip" => $value->zip,
                "city" => $value->city,
                "customer_number" => $value->customer_number,
                "invoice_number" => $value->invoice_number,
                "units" => $value->units,
                "cost_per_unit" => $value->cost_per_unit,
                "amount" => $value->amount,
                "invoice_date" => Carbon::parse($value->invoice_date),
                "token" => $value->token
            ]);
        }

    }
}
