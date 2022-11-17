<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CustomerData;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CustomerDataController extends Controller
{

    public function customerData(Request $request) {

        $customer = CustomerData::where('token', $request->token)->first();

        $customer_data = [
            'Anrede' => $customer->gender,
            'Name' => $customer->name,
            'Adresse' => sprintf('%s %s %s %s',$customer->street,$customer->street_number,$customer->zip,$customer->city),
            'Kundennummer' => $customer->customer_number,
            'E-Mail' => $customer->email
        ];

        // Für eine optisch bessere Ausgabe habe ich response genutzt
        return response()->json($customer_data);
    }


    public function invoice(Request $request) {

        // Ich hole mir die Kundendaten anhand des Tokens des Users
        $customer = CustomerData::where('token', $request->token)->first();

        /*
            Ich bilde hier ein neues Array um bei jeder Kundenanfrage die passenden Rechnungsdaten auszugeben.
            Rechnungsbetrag+Mwst wird jedes mal dynamisch neu berechnet.
            Rechnungsbetrag Prüfung = Eine kurze Überprüfung ob der Rechnungsbetrag stimmt. (gibt 0 oder 1 zurück).

            Beträge mit number_format angepasst. (Nachkommastellen)
            Datum mit Carbon parse und "format" angepasst. (Datumsformat)

        */

        $invoice_data = [
            'Rechnungsnummer' => $customer->invoice_number,
            'Einheiten' => $customer->units,
            'Kosten pro Einheit' => $customer->cost_per_unit,
            'Rechnungsbetrag' => number_format($customer->amount / 100,2),
            'Rechnungsbetrag+Mwst.' => number_format($customer->amount / 100 * 1.19,2),
            'Rechnungsbetrag Pruefung' => $customer->units * $customer->cost_per_unit == $customer->amount,
            'Rechnungsdatum' => Carbon::parse($customer->invoice_date)->format("d.m.Y")

        ];

        // Für eine optisch bessere Ausgabe habe ich response genutzt
        return response()->json($invoice_data);
    }

}

