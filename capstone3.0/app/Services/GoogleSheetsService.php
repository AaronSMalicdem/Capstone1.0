<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;

class GoogleSheetsService
{
    protected $client;
    protected $service;
    protected $spreadsheetId = '1oVN6T0bAEuMD_ISC4PILA41a54N30dmqxWW9gV9VWN8'; // Your Spreadsheet ID

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-sheets-credentials.json')); // Path to your JSON key file
        $this->client->addScope(Google_Service_Sheets::SPREADSHEETS);
        $this->service = new Google_Service_Sheets($this->client);
    }

    public function getComments()
    {
        $range = 'Kuwago!B2:C'; // Adjust according to your Google Sheet
        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
        $values = $response->getValues();

        return $values ? $values : [];
    }
}
