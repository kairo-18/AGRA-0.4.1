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
            $result = "Tips is suddenly not working. Keep on coding you can do it even without tips!";
        }else{
            $result = "Tips is suddenly not working. Keep on coding you can do it even without tips!";
        }

        return response()->json(["result" => $result->text()]);
    }
}
