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

        if($request->type === "output"){
            $result = $client->geminiPro()->generateContent('Provide any relevant information that can help to improve or correct the code, however, do not include the answer to your response and limit your response for up to 2 sentences only. Refer to this instruction: ' . $request->instruction . ' \n and refer to this code : ' . $request->userCode . 'for reference, this code is written in this language: ' . $request->progLanguage . 'and this is an output-based task so no need to point out the lack of body of code since we provide that in our backend, limit your response to tips on solving the logical problem of the task');

        }else{
            $result = $client->geminiPro()->generateContent('Provide any relevant information that can help to improve or correct the code, however, do not include the answer to your response and limit your response for up to 2 sentences only. Refer to this instruction: ' . $request->instruction . ' \n and refer to this code : ' . $request->userCode . 'for reference, this code is written in this language: ' . $request->progLanguage);

        }

        return response()->json(["result" => $result->text()]);
    }
}
