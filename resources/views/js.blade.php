<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('7e95d27e02e66d274c85', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('auction.{{ $auction->id }}');
    channel.bind('App\\Events\\BidEvent', function(data) {
        if(data.status)
        {
            $('.plus').css('color','#4F46E5')
            html = '<details> <summary> <div> <span> <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"> <rect width="256" height="256" fill="none"></rect> <rect x="32" y="80" width="192" height="48" rx="7.99999" stroke-width="16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"></rect> <path d="M208,128v72a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <line x1="128" y1="80" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line> <path d="M173.25483,68.68629C161.94113,80,128,80,128,80s0-33.94113,11.31371-45.25483a24,24,0,0,1,33.94112,33.94112Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <path d="M82.74517,68.68629C94.05887,80,128,80,128,80s0-33.94113-11.31371-45.25483A24,24,0,0,0,82.74517,68.68629Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> </svg> </span> <h3> <strong>'+data.name+'</strong> <small>Bid</small> </h3> <span class="plus" style="color: green">+'+data.bid+' EGP</span> </div> </summary> <div> <dl> <div> <dt>Time</dt> <dd>'+data.created_at+'</dd> </div> <div> <dt>Card used</dt><dd>•••• 6890</dd></div> <div> <dt>Reference ID</dt> <dd>3125-568912</dd> </div> </dl> </div> </details>';
            $(html).insertAfter('#insertAfter');
            $('#highest_bid').text(data.bid);
        }

    });
</script>

<script src="https://pbutcher.uk/flipdown/js/flipdown/flipdown.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

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

<script>
    $(function (){
        const Http = window.axios;
        const Echo = window.Echo;
        const auction = $('#auction');
        const bid = $('#bid');

        $('#bidButton').on('click',function (){
            if(bid.val() != '')
            {
                $.ajax({
                    url: '{{ route('bid.process') }}',
                    type: 'POST',
                    data: {
                        'user':{{ auth()->user()->id }},
                        'bid':bid.val(),
                        'auction':auction.val(),
                        "_token": "{{ csrf_token() }}",
                    },
                    beforeSend: (data) => {
                        $(this).html('<i class="fas fa-spinner fa-spin"></i>');
                        $('#alert').html('');
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        $('#alert').prepend('<div class="alert alert-info" style="color: red!Important;"><p>Something Wrong, Please contact supporters..</p></div>')
                    },
                    success: (data) => {
                        try{
                            if(data.status)
                            {
                                bid.val('');
                                $(this).text('bid')
                                console.log(data);
                            }else{
                                bid.val('');
                                $(this).text('bid')
                                $('#alert').append('<div class="alert alert-info" style="color: red!Important;"><p>'+data.problems+'</p></div>')
                            }

                        }catch(e){
                            $('#alert').prepend('<div class="alert alert-info" style="color: red!Important;"><p>Something Wrong, Please contact supporters..</p></div>')
                        }
                    },
                    complete: ()=>{

                    }
                })
            }
        })
        /*let channel = Echo.channel('auction');
        channel.listen('BidEvent',function (data){
            console.log(data)
            /!*var html = '<details> <summary> <div> <span> <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"> <rect width="256" height="256" fill="none"></rect> <rect x="32" y="80" width="192" height="48" rx="7.99999" stroke-width="16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"></rect> <path d="M208,128v72a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <line x1="128" y1="80" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line> <path d="M173.25483,68.68629C161.94113,80,128,80,128,80s0-33.94113,11.31371-45.25483a24,24,0,0,1,33.94112,33.94112Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <path d="M82.74517,68.68629C94.05887,80,128,80,128,80s0-33.94113-11.31371-45.25483A24,24,0,0,0,82.74517,68.68629Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> </svg> </span> <h3> <strong>'+data.name+'</strong> <small>Bid</small> </h3> <span class="plus">+'+data.bid+' EGP</span> </div> </summary> <div> <dl> <div> <dt>Time</dt> <dd>8.14am</dd> </div> <div> <dt>Card used</dt><dd>•••• 6890</dd></div> <div> <dt>Reference ID</dt> <dd>3125-568912</dd> </div> </dl> </div> </details>';
            $(html).insertAfter('#insertAfter')*!/
        })*/
        /*window.Echo.private('auction.'+{{ $auction->id }}).listen('BidEvent', (event) => {
            console.log(event)
        })*/
    })
</script>
