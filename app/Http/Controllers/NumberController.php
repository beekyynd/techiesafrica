<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NG;
use App\Models\USA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class NumberController extends Controller
{
    public function listCountries()
{
    return response()->json([
        'countries' => [
            'Nigeria',
            'USA'
        ]
    ]);
}

public function getCountryData(Request $request)
{
    $country = $request->query('country');

    // Map country names to their corresponding models
    $countryMap = [
        'Nigeria' => NG::class,
        'USA' => USA::class,
    ];

    // Check if requested country exists in the map
    if (!array_key_exists($country, $countryMap)) {
        return response()->json([
            'error' => 'Invalid country'
        ], 400);
    }

    // Fetch all data from the corresponding table
    $data = $countryMap[$country]::select('id', 'website', 'price', 'webID')->get();

    return response()->json($data);
}

public function generateNumber(Request $request)
{
    $country = $request->query('country');
    $webid = $request->query('webid');

    $user = User::find(Auth::id());

    // Check if authenticated
    if (!$user) {
        return response()->json([
            'error' => 'Unauthorized access. Please log in.'
        ], 401);
    }

    // Validate required params
    if (!$country || !$webid) {
        return response()->json([
            'error' => 'Missing required parameters: country or webid.'
        ], 400);
    }

    // Map country to model
    $countryMap = [
        'Nigeria' => NG::class,
        'USA' => USA::class,
    ];

    if (!array_key_exists($country, $countryMap)) {
        return response()->json([
            'error' => 'Invalid country. Valid options are Nigeria or USA.'
        ], 400);
    }

    // Fetch website record
    $model = $countryMap[$country];
    $record = $model::where('webID', $webid)->first();

    if (!$record) {
        return response()->json([
            'error' => 'Website not found for this country.'
        ], 404);
    }

    $price = $record->price;

    // Check credit
    if ($user->credits < $price) {
        return response()->json([
            'error' => 'Insufficient credits.'
        ], 403);
    }

    // Deduct credit
    $user->credits -= $price;
    $user->save();

    // Generate 10-digit number and attach +234
    $randomDigits = mt_rand(1000000000, 9999999999);
    $number = substr($randomDigits, 1);

    return response()->json([
        'number' => $number,
        'price' => $price,
        'user_balance' => $user->credits
    ]);
}



}
