<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';
 


    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    public function getPaintFormulaFromOrder($order)
    {
       $prompt = "You are a paint production assistant. Based on the following order details, return only the required materials and their estimated quantities in **pure JSON format only**. 
Do not include any markdown formatting, triple quotes, explanations, or code blocks — just valid JSON.\n\n"
. "Order details:\n"
. "- Paint color: {$order->paintcolor}\n"
. "- Paint category: {$order->paintCategory}\n"
. "- Paint type: {$order->paintType}\n"
. "- Capacity per unit: {$order->capacity} liters\n"
. "- Quantity: {$order->quantity} units\n\n"
. "Example format:\n"
. '{ "materials": [ { "name": "Alkyd Resin", "quantity": "16kg" }, { "name": "Titanium Dioxide", "quantity": "10Kg " } ] }';


           // For debugging, remove in production
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $this->apiKey,
 ])->post($this->baseUrl, [
            'contents' => [[
                'parts' => [['text' => $prompt]]
            ]]
        ]);
// dd($response); // For debugging, remove in production
       
        // Uncomment the line below to see the full response structure for debugging
        //
// dd($response->body()); // For debugging, remove in production
   
  
        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
    }
}

//yet to filter the response am getting and instead of manufacturer manually entering the ingredients they get a editable form 