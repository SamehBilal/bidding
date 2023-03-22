<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Auction {{ $auction->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="example">
                        <h1>Auction</h1>
                        <p style="color: darkolivegreen"><strong >Highest Bid:</strong> <span id="highest_bid" >{{ $auction->highest_bid }}</span> EGP</p>
                        <div id="flipdown" class="flipdown"></div>
                        <br><div id="alert"></div>
                        <div class="flex input-with-button donation-form">
                            <div class="input-wrapper text-poppins">
                                <span class="dollar-sign">$</span>
                                <input  type="number" style="background: transparent!Important;color: #acafb7!Important;" name="bid" id="bid" step="0.01" class="text-poppins outline-none" placeholder="Bid...">
                            </div>
                            <input type="hidden" name="auction" value="{{ $auction->id }}" id="auction"><br>
                            <button  class="give-now outline-none text-poppins" id="bidButton">Bid</button>
                        </div>

                    </div>
                    <section id="bidrResults">
                        <h1>Latest Bids</h1>
                        <h2 id="insertAfter">Today</h2>
                        @foreach($auction->bid as $bid)
                            <details>
                                <summary>
                                    <div>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect> <rect x="32" y="80" width="192" height="48" rx="7.99999" stroke-width="16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"></rect>
                                                <path d="M208,128v72a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
                                                <line x1="128" y1="80" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                                <path d="M173.25483,68.68629C161.94113,80,128,80,128,80s0-33.94113,11.31371-45.25483a24,24,0,0,1,33.94112,33.94112Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
                                                <path d="M82.74517,68.68629C94.05887,80,128,80,128,80s0-33.94113-11.31371-45.25483A24,24,0,0,0,82.74517,68.68629Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
                                            </svg>
                                        </span>
                                        <h3>
                                            <strong>{{ $bid->user->name }}</strong> <small>Bid</small>
                                        </h3>
                                        <span class="plus" style="{{ $auction->highest_bid == $bid->bid_amount ? 'color: green':'' }}">{{ $bid->bid_amount }} EGP</span>
                                    </div>
                                </summary>
                                <div>
                                    <dl>
                                        <div>
                                            <dt>Time</dt>
                                            <dd>{{ $bid->created_at->diffForHumans() }}</dd>
                                        </div>
                                        <div>
                                            <dt>Card used</dt>
                                            <dd>•••• 6890</dd>
                                        </div>
                                        <div>
                                            <dt>Reference ID</dt>
                                            <dd>3125-568912</dd>
                                        </div>
                                    </dl>
                                </div>
                            </details>
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </div>

    @include('js',['auction' => $auction])

</x-app-layout>
