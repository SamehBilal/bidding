<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,400,900" rel="stylesheet">
        <script defer type="text/javascript" src="https://pbutcher.uk/credit-tag/credit-tag-black.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://pbutcher.uk/flipdown/css/flipdown/flipdown.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>




            body,
            .example h1,
            .example p,
            .example .button {
                transition: all .2s ease-in-out;
            }

            body.light-theme {
                /*background-color: #151515;*/
            }

            body.light-theme .example h1 {
                color: #FFFFFF;
            }

            body.light-theme .example p {
                color: #FFFFFF;
            }

            body.light-theme .buttons .button {
                color: #FFFFFF;
                /*border-color: #FFFFFF;*/
            }

            body.light-theme .buttons .button:hover {
                color: #151515;
                /*background-color: #FFFFFF;*/
            }

            .example {
                font-family: 'Roboto', sans-serif;
                width: 550px;
                height: auto;
                margin: auto;
                margin-bottom: 2rem;
                padding: 20px;
                box-sizing: border-box;
            }

            .example .flipdown {
                margin: auto;
            }

            .example h1 {
                text-align: center;
                font-weight: 100;
                font-size: 3em;
                margin-top: 0;
                margin-bottom: 10px;
            }

            .example p {
                text-align: center;
                font-weight: 100;
                margin-top: 0;
                margin-bottom: 35px;
            }

            .example .buttons {
                width: 100%;
                height: 50px;
                margin: 50px auto 0px auto;
                display: flex;
                align-items: center;
                justify-content: space-around;
            }

            .example .buttons p {
                height: 50px;
                line-height: 50px;
                font-weight: 400;
                padding: 0px 25px 0px 0px;
                color: #333;
                margin: 0px;
            }

            .example .button {
                display: inline-block;
                height: 50px;
                box-sizing: border-box;
                line-height: 46px;
                text-decoration: none;
                color: #333;
                padding: 0px 20px;
                border: solid 2px #333;
                border-radius: 4px;
                text-transform: uppercase;
                font-weight: 700;
                transition: all .2s ease-in-out;
            }

            .example .button:hover {
                /*background-color: #333;*/
                color: #FFF;
            }

            .example .button i {
                margin-right: 5px;
            }

            @media(max-width: 550px) {
                .example {
                    width: 100%;
                    height: 362px;
                }

                .example h1 {
                    font-size: 2.5em;
                }

                .example p {
                    margin-bottom: 25px;
                }

                .example .buttons {
                    width: 100%;
                    margin-top: 25px;
                    text-align: center;
                    display: block;
                }

                .example .buttons p,
                .example .buttons a {
                    float: none;
                    margin: 0 auto;
                }

                .example .buttons p {
                    padding-right: 0px;
                }

                .example .buttons a {
                    display: inline-block;
                }
            }

        </style>

        <style>
            @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap");



            section {
                width: 90%;
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
            section + section {
                margin-top: 2.5em;
            }

            h1 {
                font-weight: 700;
                line-height: 1.125;
                font-size: clamp(1.5rem, 2.5vw, 2.5rem);
            }

            h2 {
                margin-top: 0.25em;
                color: #999;
                font-size: clamp(1.125rem, 2.5vw, 1.25rem);
            }
            h2 + * {
                margin-top: 1.5em;
            }

            summary {
                /*background-color: #fff;*/
                position: relative;
                cursor: pointer;
                padding: 1em 0.5em;
                list-style: none;
            }
            summary::-webkit-details-marker {
                display: none;
            }
            summary:hover {
                /*background-color: #f2f5f9;*/
            }
            summary div {
                display: flex;
                align-items: center;
            }
            summary h3 {
                display: flex;
                flex-direction: column;
            }
            summary small {
                color: #999;
                font-size: 0.875em;
            }
            summary strong {
                font-weight: 700;
            }
            summary span:first-child {
                width: 4rem;
                height: 4rem;
                border-radius: 10px;
                /*background-color: #f3e1e1;*/
                display: flex;
                flex-shrink: 0;
                align-items: center;
                justify-content: center;
                margin-right: 1.25em;
            }
            summary span:first-child svg {
                width: 2.25rem;
                height: 2.25rem;
            }
            summary span:last-child {
                font-weight: 700;
                margin-left: auto;
            }
            summary:focus {
                outline: none;
            }
            summary .plus {
                color: #4F46E5;
            }

            details {
                border-bottom: 1px solid #b5bfd9;
            }
            details[open] {
                box-shadow: -3px 0 0 #b5bfd9;
            }
            details:first-of-type {
                border-top: 1px solid #b5bfd9;
            }
            details > div {
                padding: 2em 2em 0;
                font-size: 0.875em;
            }

            dl {
                display: flex;
                flex-wrap: wrap;
            }
            dl dt {
                font-weight: 700;
            }
            dl div {
                margin-right: 4em;
                margin-bottom: 2em;
            }
        </style>

        <style>
            @import url("https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap");
            @import url("https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500&display=swap");


            .still-needed {
                position: relative;
                padding: 10px 10px 10px 15px;
                background-color: #dbe6f8;
                color: #607acd;
                border-radius: 5px;
            }
            .still-needed:before {
                content: "";
                position: absolute;
                right: 45px;
                bottom: -8px;
                width: 16px;
                height: 16px;
                transform: rotate(45deg);
            }
            .still-needed .dollar-sign {
                position: absolute;
                top: 8px;
                left: 7px;
                display: inline-block;
                font-size: 12px;
                font-weight: 600;
            }

            .input-with-button {
                border-radius: 5px;
            }

            .input-wrapper {
                position: relative;
                display: flex;
                align-items: center;
                width: calc(100% - 120px);
                border: 1px solid rgba(91, 93, 98, 0.25);
                border-radius: 5px 0 0 5px;
            }
            .input-wrapper .dollar-sign {
                height: 100%;
                padding: 10px 0 10px 15px;
                color: #acafb7;
                font-size: 1.5em;
                line-height: 1.5;
            }
            .input-wrapper input::-webkit-outer-spin-button,
            .input-wrapper input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            .input-wrapper input[type=number] {
                -moz-appearance: textfield;
            }
            .input-wrapper input {
                width: 100%;
                height: 100%;
                padding: 10px 15px 10px 5px;
                font-size: 1.5em;
                line-height: 1.5;
                border: none;
                color: #24252a;
            }

            .donation-form {
                position: relative;
                margin-top: 60px;
                padding: 20px 30px 35px 30px;
                border-radius: 5px;
                border-top: 15px solid #4F46E5;
                box-shadow: 0px 1px 15px 1px rgba(0, 0, 0, 0.25);
            }

            .donation-form .give-now {
                cursor: pointer;
                -webkit-appearance: none;
                width: 120px;
                padding: 20px 15px;
                background-color: #4F46E5;
                border-radius: 0 5px 5px 0;
                border-width: 0;
                color: white;
                transition: background-color 0.25s ease-in-out;
            }

            .donation-form .give-now:hover {
                cursor: pointer;
                -webkit-appearance: none;
                width: 120px;
                padding: 20px 15px;
                background-color: #4F46E5;
                border-radius: 0 5px 5px 0;
                border-left: 0;
                color: white;
                transition: background-color 0.25s ease-in-out;
            }
        </style>

        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('7e95d27e02e66d274c85', {
                cluster: 'eu'
            });

            var channel = pusher.subscribe('auction');
            channel.bind('App\\Events\\BidEvent', function(data) {
                /*alert(JSON.stringify(data));*/
                //alert(data)
            });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://pbutcher.uk/flipdown/js/flipdown/flipdown.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // Unix timestamp (in seconds) to count down to
                var twoDaysFromNow = (new Date().getTime() / 1000) + (10) + 1;

                // Set up FlipDown
                var flipdown = new FlipDown(twoDaysFromNow)

                    // Start the countdown
                    .start()

                    // Do something when the countdown ends
                    .ifEnded(() => {
                        /*alert('The countdown has ended!')*/
                        console.log('The countdown has ended!');
                    });

                // Toggle theme
                var interval = setInterval(() => {
                    let body = document.body;
                    body.classList.toggle('light-theme');
                    body.querySelector('#flipdown').classList.toggle('flipdown__theme-dark');
                    body.querySelector('#flipdown').classList.toggle('flipdown__theme-light');
                }, 5000);
            });

        </script>

        <script
            src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
            crossorigin="anonymous"></script>
        <script>

            $(function (){
                const Http = window.axios;
                const Echo = window.Echo;
                const name = $('#username');
                const bid = $('#bid');

                $('button').on('click',function (){
                    if(bid.val() != '')
                    {
                        $.ajax({
                            url: '{{ route('bid.process') }}',
                            type: 'POST',
                            data: {
                                'name':name.val(),
                                'bid':bid.val(),
                                "_token": "{{ csrf_token() }}",
                            },
                            beforeSend: (data) => {

                            },
                            error: (jqXHR, textStatus, errorThrown) => {
                                alert('error')
                            },
                            success: (data) => {
                                try{
                                    bid.val('');
                                    //console.log(data);
                                }catch(e){
                                    $('#ahw-media-co').html('<div class="alert alert-info"><p>Something Wrong, Please contact supports..</p></div>')
                                }
                            },
                            complete: ()=>{

                            }
                        })
                    }
                })

                let channel = Echo.channel('auction');
                channel.listen('.bidding',function (data){
                    var html = '<details> <summary> <div> <span> <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"> <rect width="256" height="256" fill="none"></rect> <rect x="32" y="80" width="192" height="48" rx="7.99999" stroke-width="16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"></rect> <path d="M208,128v72a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <line x1="128" y1="80" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line> <path d="M173.25483,68.68629C161.94113,80,128,80,128,80s0-33.94113,11.31371-45.25483a24,24,0,0,1,33.94112,33.94112Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <path d="M82.74517,68.68629C94.05887,80,128,80,128,80s0-33.94113-11.31371-45.25483A24,24,0,0,0,82.74517,68.68629Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> </svg> </span> <h3> <strong>'+data.name+'</strong> <small>Bid</small> </h3> <span class="plus">+'+data.bid+' EGP</span> </div> </summary> <div> <dl> <div> <dt>Time</dt> <dd>8.14am</dd> </div> <div> <dt>Card used</dt><dd>•••• 6890</dd></div> <div> <dt>Reference ID</dt> <dd>3125-568912</dd> </div> </dl> </div> </details>';
                    $(html).insertAfter('#insertAfter')
                })
            })
        </script>
    </body>
</html>
