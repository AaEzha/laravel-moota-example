<?php

namespace App\Http\Controllers;

use App\Models\MootaWebhook;
use Illuminate\Http\Request;

class MootaWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        MootaWebhook::create([
            'body' => $request->getContent()
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Success'
        ]);
    }
}
