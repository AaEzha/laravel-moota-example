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
        $data = MootaWebhook::create([
            'body' => $request->getContent()
        ]);

        $webhooks = [];
        $response['id'] = $data->getKey();
        $response['webhook_id'] = $data->body->id;
        $response['bank_id'] = $data->body->bank_id;
        $response['account_number'] = $data->body->account_number;
        $response['bank_type'] = $data->body->bank_type;
        $response['date'] = $data->body->date;
        $response['amount'] = $data->body->amount;
        $response['description'] = $data->body->description;
        $response['type'] = $data->body->type;
        $response['balance'] = $data->body->balance;
        array_push($webhooks, $response);

        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $webhooks
        ]);
    }
}
