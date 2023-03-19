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
                        {{--<p>⏰ A lightweight and performant flip styled countdown clock</p>--}}
                        <div id="flipdown" class="flipdown"></div>

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
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
