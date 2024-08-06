<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    private $username = 'gerson'; // Reemplaza con tu nombre de usuario

    public function getCountries()
    {
        $response = Http::get("http://api.geonames.org/countryInfoJSON", [
            'username' => $this->username
        ]);
        return response()->json($response->json()['geonames']);
    }

    public function getDepartments($countryCode)
    {
        $response = Http::get("http://api.geonames.org/childrenJSON", [
            'geonameId' => $countryCode,
            'username' => $this->username
        ]);

        return response()->json($response->json()['geonames']);
    }

    public function getProvinces($geonameId)
    {
        $response = Http::get("http://api.geonames.org/childrenJSON", [
            'geonameId' => $geonameId,
            'username' => $this->username
        ]);

        return response()->json($response->json()['geonames']);
    }

    public function getDistricts($geonameId)
    {
        $response = Http::get("http://api.geonames.org/childrenJSON", [
            'geonameId' => $geonameId,
            'username' => $this->username
        ]);

        return response()->json($response->json()['geonames']);
    }
}
