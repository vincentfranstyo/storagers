@extends('layouts.app')

@section('content')

    <style>
        @media (prefers-color-scheme: dark) {
            .bg-dots {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(200,200,255,0.15)'/%3E%3C/svg%3E");
            }
        }

        @media (prefers-color-scheme: light) {
            .bg-dots {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,50,0.10)'/%3E%3C/svg%3E")
            }
        }
    </style>

    <div
        class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots dark:bg-gray-900 selection:bg-indigo-500 selection:text-white">

        @if (Route::has('login'))
            <div x-data="{ open: false }" class="p-6 text-right sm:fixed sm:top-0 sm:right-0">
                @auth
                    <button
                        id="dropdownDefaultButton"
                        x-on:click="open = !open"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button"
                    >
                        {{ Auth::user()->username }}
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 10 6">
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 4 4 4-4"
                            />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div
                        id="dropdown"
                        x-show="open"
                        x-cloak
                        class="z-10 mt-1 bg-white divide-y divide-gray-100 rounded-lg shadow w-30 dark:bg-gray-700"
                    >
                        <ul class="py-2 text-md text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a
                                    href="{{ route('home') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500 px-5"
                                >
                                    Home
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('history') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500 px-5"
                                >
                                    History
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500 px-5"
                                >
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                    @endif
                @endauth
            </div>

        @endif
        <div class="p-6 mx-auto max-w-7xl lg:p-8">
            <div class="flex justify-center">
                <h1 class="text-gray-500 dark:text-white text-4xl font-bold">Purchase</h1>
            </div>
            <div class="mt-16 min-w-fit">
                <div
                    class="scale-100 p-7 pt-3 pb-3 pr-10 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-indigo-500 min-w-fit w-auto flex-col">
                    <div class="flex min-w-fit justify-between">
                        <div class="flex">
                            <div
                                class="flex text-3xl pl-4 pt-2 justify-center items-center text-gray-500 dark:text-white">
                                {{ $catalog['nama'] }}
                            </div>
                        </div>
                        <div
                            class="flex items-center h-auto text-gray-500 dark:text-white text-xl pt-7 pb-7 w-40">
                            <div
                                class="flex flex-col-reverse gap-1 items-end h-auto text-gray-500 dark:text-white text-lg pb-1 pr-5 pt-1 min-w-fit">
                                <div>total:</div>
                                <div><label for="amount">amount:</label></div>
                                <div>stock:</div>
                            </div>
                            <div
                                class="flex flex-col-reverse gap-1 h-auto text-gray-500 dark:text-white text-lg pb-1 pr-5 pt-1 min-w-fit">
                                <div>{{ $catalog['harga'] }}</div>
                                <div><input type="number" name="amount" id="amount" min="0" max="$catalog['stok']"
                                            class="w-[4rem] h-8 dark:text-white bg-blue-950"></div>
                                <div>{{ $catalog['stok'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-auto min-w-fit justify-center  gap-x-10">
                        <button type="button"
                                class="bg-blue-950 text-white border-b-indigo-800 rounded-full max-w-xl min-w-fit w-40 p-x-10 hover:bg-blue-200  hover:underline">
                            <a class="text-xl hover:text-gray-500" href="{{ route('detail', ['name' => $catalog['nama']]) }}">Back</a>
                        </button>
                        <button type="button"
                                class="bg-blue-950 text-white border-b-indigo-800 rounded-full max-w-xl min-w-fit w-40 p-x-10 hover:underline disabled:bg-gray-300 hover:text-gray-500 hover:bg-blue-200">
                            <a class="text-xl " id="buy" href="#">Buy</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex justify-center px-0 mt-16 sm:items-center sm:justify-between">
                <div class="text-sm text-center text-gray-500 dark:text-gray-400 sm:text-left">
                    <div class="flex items-center gap-4">
                        <a href="https://github.com/sponsors/taylorotwell"
                           class="inline-flex items-center group hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 class="w-5 h-5 mr-1 -mt-px stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                            </svg>
                            Sponsor
                        </a>
                    </div>
                </div>
                <div class="ml-4 text-sm text-center text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    made with ❤️ by Vincent Franstyo
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkStock(stock) {
            let amountInput = document.getElementById("amount");
            let buyButton = document.getElementById("buy");
            let stockQuantity = stock;

            buyButton.addEventListener("click", () => {
                if (amountInput.value > stockQuantity) {
                    alert("Stock is not enough!");
                } else {
                    alert("Purchase success!");
                }
            })
        }
        checkStock({{ $catalog['stok'] }})
    </script>
@endsection
