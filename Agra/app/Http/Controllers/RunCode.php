<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RunCode extends Controller
{
    public function executeCode(Request $request)
    {
        $response = Http::post('https://api.jdoodle.com/v1/execute', [
            'clientId' => '7ca68a9f7ef5a8ba75361c0c9be79a9c',
            'clientSecret' => '86434b93d7121e507991d382fa2d2356d6770854909c793ee044056d23f4973f',
            'script' => $request->input('script'),
            'language' => 'java',
            'versionIndex' => '3',
        ]);

        // Check if the request was successful (status code 200)
        if ($response->successful()) {
            // Decode the JSON response
            $responseData = $response->json();

            // Check if the response contains the 'output' key
            if (isset($responseData['output'])) {
                // Return only the 'output' from the response
                return $responseData['output'];
            } else {
                // Return an error message if the 'output' key is missing
                return response()->json(['error' => 'Output not found in response'], 500);
            }
        } else {
            // Return an error response if the API request failed
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }
}
