<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Shorten Url</title>
</head>
<body class="bg-gray-200 flex items-center justify-center h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mt-20">
    @if(session('new_link'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">Your new short link is ready:</span>
            <a href="{{url('/')}}/{{ session('new_link')->short_code }}" class="font-bold text-green-800 underline" target="_blank">
                {{url('/')}}/{{ session('new_link')->short_code }}
            </a>
        </div>
    @endif
    <h1 class="text-3xl font-bold text-center mb-6">URL shortener</h1>
    <form method="POST" action="/shorten">
        @csrf
        <input type="text"
               name="original_url"
               class="w-full p-3 border rounded-lg"
               value="{{ old('original_url') }}"
               placeholder="Enter your long URL here...">
        @error('original_url') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        <input type="text"
               name="custom_code"
               class="w-full p-3 border rounded-lg mt-3"
               value="{{ old('custom_code') }}"
               placeholder="Enter your custom shortcode(optional)...">
        <p class="text-gray-400 text-xs truncate mt-0.2 pl-2">Leave empty to generate unique short code!</p>
        @error('custom_code') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        <button type="submit" class="w-full bg-blue-500 text-white p-3 mt-4 rounded-lg font-bold hover:bg-blue-600">
            Shorten
        </button>
    </form>
        <!-- Recent Links -->
        <div class="mt-8">
            <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-widest mb-3">Recent Links</h2>
            <div class="divide-y divide-gray-100 max-h-64 overflow-y-auto">
                @foreach($links as $link)
                    <div class="py-3 flex items-center justify-between group">
                        <div class="overflow-hidden pr-4">
                            <a href="{{ url('/' . $link->short_code) }}"
                               target="_blank"
                               class="text-blue-500 font-mono text-sm font-bold hover:text-blue-700 transition">
                                {{ url('/') }}/{{ $link->short_code }}
                            </a>
                            <p class="text-gray-400 text-xs truncate mt-0.5">{{ $link->original_url }}</p>
                        </div>
                        <span class="text-xs text-gray-300 whitespace-nowrap flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                         -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ $link->click }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
</div>
</body>
</html>
