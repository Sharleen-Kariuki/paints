<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    public function index(Request $request){
        $userId = $request->session()->get('loginId');
         if (!$userId) {
            $Amount = 0; // No orders for guests
        } else {
            $Amount = Order::where('user_id', $userId)
                ->sum('total_price');
            $PhoneNumber = Order::where('user_id', $userId)
                ->orderByDesc('created_at')
                ->value('phone');
        }
        return view('mpesa.index', compact('Amount', 'PhoneNumber'));
    }
    public function token()
    {
            $mpesa = new Mpesa();
            
            // Check environment and generate appropriate token
            $environment = env('MPESA_ENV', 'sandbox');
            
           $token = $mpesa->generateSandBoxToken();

            return response()->json([
                'success' => true,
                'token' => $token,
                'environment' => $environment
            ]);            
    }

    public function STKpush(Request $request){
        $mpesa = new Mpesa();

        $environment = env('MPESA_ENV', 'sandbox');
        // Generate token first
        if ($environment === 'live') {
            $token = $mpesa->generateLiveToken();
        } else {                
            $token = $mpesa->generateSandBoxToken();
        }


        //error when getting token
        dd($token); // Debugging line to check the token
     
        // Define required variables for STKPushSimulation
        $BusinessShortCode = env('MPESA_BUSINESS_SHORTCODE', '174379');
        $LipaNaMpesaPasskey = env('MPESA_PASSKEY', 'your_passkey_here');
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $request->input('amount', 1); // Default to 1 if not provided
        $PartyA = '254721483296'; // Customer phone number
        $PartyB = $BusinessShortCode;
        $PhoneNumber = $request->input('phone');
        $CallBackURL = 'https://at-checks-physics-bachelor.trycloudflare.com';
        $AccountReference = 'TestAccount';
        $TransactionDesc = 'Payment for goods';
        $Remarks = 'Test payment';

     
        // Send the STK push request
        $stkPushSimulation = $mpesa->STKPushSimulation(
            
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );
       
     

        return response()->json($stkPushSimulation);
    }

    public function callback(Request $request)
    {
        // Handle the callback from M-Pesa
        // You can log the request or process it as needed
        Log::info('M-Pesa Callback:', $request->all());

        return response()->json(['status' => 'success']);
    }
}