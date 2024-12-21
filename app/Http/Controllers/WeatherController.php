<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather');
    }

    public function fetchWeather(Request $request)
    {
        $request->validate(['city' => 'required|string']);

        $apiKey = env('WEATHER_API_KEY');
        $city = $request->city;
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($apiUrl);
        if ($response->successful()) {
            
            $weatherData = $response->json();
            return view('weather', [
                'weather' => [
                    'city' => $weatherData['name'],
                    'temperature' => $weatherData['main']['temp'],
                    'description' => ucfirst($weatherData['weather'][0]['description']),
                    'humidity' => $weatherData['main']['humidity'],
                    'wind_speed' => $weatherData['wind']['speed'],
                    'icon' => $weatherData['weather'][0]['icon'],
                ]
            ]);
        }

        return back()->withErrors(['city' => 'City not found or API error.']);
    }
}
