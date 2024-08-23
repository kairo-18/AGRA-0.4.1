<?php

namespace App\Http\Controllers;

use Gemini;
use Illuminate\Http\Request;

class GeminiController extends Controller
{
    //
    public function prompt(Request $request){
        $yourApiKey = getenv('GEMINI_API_KEY');
        $client = Gemini::client($yourApiKey);

        $result = $client->geminiPro()->generateContent('Can you provide a 2 sentence tip to what i am trying to code, but do not show the answer. The instruction is this: ' . $request->instruction . ' \n and my code is this : ' . $request->userCode);

        return response()->json(["result" => $result->text()]);
    }
}
