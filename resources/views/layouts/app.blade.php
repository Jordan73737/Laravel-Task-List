<!DOCTYPE html>
<html>

<head>
  <title>Laravel 10 Task List App</title>
      {{-- below is a cdn link (shortcut for content delivery network)
  a distributed network of third party servers that deliver content to users --}}
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- Alpine is a js library that I am using to create an interactive button
    on the top right corner of the flash message so you can close it.
    Alpine allows for some interactivity without having to use js or DOM --}}
  <script src="//unpkg.com/alpinejs" defer></script>

  {{-- blade-formatter-disable --}}
  <style type="text/tailwindcss">
    .btn {
      @apply rounded-md px-2 py-1 text-center font-medium text-slate-700 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50
    }

    .link {
      @apply font-medium text-gray-700 underline decoration-pink-500
    }

    label {
      @apply block uppercase text-slate-700 mb-2
    }

    input, 
    textarea {
      @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
    }

    .error {
      @apply text-red-500 text-sm
    }
  </style>
  {{-- blade-formatter-enable --}}

  @yield('styles')
</head>

{{-- 'container' creates a centered container with max width based on screen size
mx-auto (max outer) will horizontally center the element within the container
mt-10 (margin top 10) will add margin on top of the body using 10 units
max-w-lg maximum screen size to large = 32rem (512px) --}}
<body class="container mx-auto mt-10 mb-10 max-w-lg">
  <h1 class="mb-4 text-2xl">@yield('title')</h1>
    {{-- @if (session()->has('success')) --}}
    {{-- <div>{{ session('success') }}</div> --}}
  <div x-data="{ flash: true }">
    @if (session()->has('success'))
      <div x-show="flash"
        class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
        role="alert">
        <strong class="font-bold">Success!</strong>
        <div>{{ session('success') }}</div>

        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            {{-- upon clicking, it closes the div element (<div x-show="flash") disappear --}}
            stroke-width="1.5" @click="flash = false" 
            stroke="currentColor" class="h-6 w-6 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </span>
      </div>
    @endif

    @yield('content')
  </div>
</body>

</html>