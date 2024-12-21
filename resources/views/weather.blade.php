<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Weather App</h1>
            <a href="/" class="text-blue-500 underline">Home</a>
        </div>
        <form method="POST" action="/weather" class="mb-8">
            @csrf
            <div class="flex items-center justify-center space-x-4">
                <input 
                    type="text" 
                    name="city" 
                    class="p-2 border rounded-lg" 
                    placeholder="Enter city name" 
                    value="{{ old('city', isset($weather) ? $weather['city'] : '') }}" 
                    required
                >
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Get Weather</button>
            </div>
            @error('city')
                <p class="text-red-500 text-center mt-2">{{ $message }}</p>
            @enderror
        </form>
        @if(isset($weather))
            <div class="text-center bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold">{{ $weather['city'] }}</h2>
                <p class="text-lg">{{ $weather['description'] }}</p>
                <img 
                    src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" 
                    alt="Weather Icon"
                    class="mx-auto my-4"
                >
                <p><strong>Temperature:</strong> {{ $weather['temperature'] }}°C</p>
                <p><strong>Humidity:</strong> {{ $weather['humidity'] }}%</p>
                <p><strong>Wind Speed:</strong> {{ $weather['wind_speed'] }} m/s</p>
            </div>
        @endif
    </div>
</body>
</html>
