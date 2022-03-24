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

    $x = MootaWebhook::latest()->get();
    // return response($x);
    foreach ($x as $y) {
        $response['id'] = $y->getKey();
        $d = [];
        foreach ($y->body as $data) {
            $hook['webhook_id'] = $data['id'];
            $hook['bank_id'] = $data['bank_id'];
            $hook['account_number'] = $data['account_number'];
            $hook['bank_type'] = $data['bank_type'];
            $hook['date'] = $data['date'];
            $hook['amount'] = $data['amount'];
            $hook['description'] = $data['description'];
            $hook['type'] = $data['type'];
            $hook['balance'] = $data['balance'];
            array_push($d, $hook);
        }
        $response['data'] = $d;
        array_push($webhooks, $response);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Success',
        'data' => $webhooks
    ]);
});
