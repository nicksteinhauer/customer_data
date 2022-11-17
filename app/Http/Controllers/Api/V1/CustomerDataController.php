<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CustomerData;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CustomerDataController extends Controller
{

    public function customerData(Request $request) {

        // Ich hole mir die Kundendaten anhand des Tokens des Users
        $customer = CustomerData::where('token', $request->token)->firstOrFail();

        // Verkettung habe ich an der Stelle über sprintf gelöst, da ich das hübscher finde als ( . " " . )
        // Hier kommt es auf die Anforderungen an, ob alle Daten verkettet oder unverkettet gesendet werden sollen.

        $customer_data = [
            'gender' => $customer->gender,
            'name' => sprintf('%s %s',$customer->first_name, $customer->last_name),
            'address' => sprintf('%s %s %s %s',$customer->street,$customer->street_number,$customer->zip,$customer->city),
            'customer_number' => $customer->customer_number,
            'email' => $customer->email
        ];

        return $customer_data;
    }


    public function invoice(Request $request) {

        // Ich hole mir die Kundendaten anhand des Tokens des Users
        $customer = CustomerData::where('token', $request->token)->firstOrFail();

        /*
            Ich bilde hier ein neues Array um bei jeder Kundenanfrage die passenden Rechnungsdaten auszugeben.
            Rechnungsbetrag+Mwst wird jedes mal dynamisch neu berechnet.
            Rechnungsbetrag Prüfung = Eine kurze Überprüfung ob der Rechnungsbetrag stimmt. (gibt 0 oder 1 zurück).

            Beträge mit number_format angepasst. (Nachkommastellen)
            Datum mit Carbon parse und "format" angepasst. (Datumsformat)

            Ich habe die Cent Berträge auf € umgerechnet, da die Kommastellen bei den Centbeträgen keinen Sinn ergaben.

        */

        $invoice_data = [
            'invoice_number' => $customer->invoice_number,
            'units' => $customer->units,
            'cost_per_unit' =>  number_format($customer->cost_per_unit / 100,2),
            'amount' => number_format($customer->amount / 100,2),
            'amount_with_tax' => number_format($customer->amount / 100 * 1.19,2),
            'amount_check' => $customer->units * $customer->cost_per_unit == $customer->amount,
            'invoice_date' => Carbon::parse($customer->invoice_date)->format("d.m.Y")
        ];

        return $invoice_data;
    }

}

