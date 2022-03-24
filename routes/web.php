<?php

use App\Http\Controllers\MootaWebhookController;
use App\Models\MootaWebhook;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/webhook/x/moota', MootaWebhookController::class);

Route::get('ai', function () {
    $webhooks = [];

    foreach (MootaWebhook::latest()->get() as $data) {
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
    }

    return response()->json([
        'status' => 200,
        'message' => 'Success',
        'data' => $webhooks
    ]);
});
