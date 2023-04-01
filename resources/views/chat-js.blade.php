<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('7e95d27e02e66d274c85', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('chat.{{ $auction->id }}');
    var userId = {{ auth()->user()->id }};
    var color = '';
    channel.bind('App\\Events\\ChatEvent', function(data) {
        if(userId == data.user_id){
            color = 'green';
        }else{
            color = '#4F46E5';
        }
        if(data.status)
        {
            html = '<details> <summary> <div> <span> <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"> <rect width="256" height="256" fill="none"></rect> <rect x="32" y="80" width="192" height="48" rx="7.99999" stroke-width="16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"></rect> <path d="M208,128v72a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <line x1="128" y1="80" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line> <path d="M173.25483,68.68629C161.94113,80,128,80,128,80s0-33.94113,11.31371-45.25483a24,24,0,0,1,33.94112,33.94112Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> <path d="M82.74517,68.68629C94.05887,80,128,80,128,80s0-33.94113-11.31371-45.25483A24,24,0,0,0,82.74517,68.68629Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path> </svg> </span> <h3> <strong>'+data.name+'</strong> <small></small> </h3> <span class="plus" style="color: '+color+'">"'+data.message+'"</span> </div> </summary> <div> <dl> <div> <dt>Time</dt> <dd>'+data.created_at+'</dd> </div> <div> <dt>Card used</dt><dd>•••• 6890</dd></div> <div> <dt>Reference ID</dt> <dd>3125-568912</dd> </div> </dl> </div> </details>';
            $(html).insertAfter('#insertAfter');
        }

    });
</script>


<script>
    $(function (){
        let message = $('#message');

        $('#sendMessage').on('click',function (){
            if(message.val() != '')
            {
                $.ajax({
                    url: '{{ route('message.store',$auction->id) }}',
                    type: 'POST',
                    data: {
                        'user':{{ auth()->user()->id }},
                        'message':message.val(),
                        "_token": "{{ csrf_token() }}",
                    },
                    beforeSend: (data) => {
                        $(this).html('<i class="fas fa-spinner fa-spin"></i>');
                        $('#alert').html('');
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        $('#alert').prepend('<div class="alert alert-info" style="color: red!Important;"><p>Something Wrong, Please contact supporters..</p></div>');
                        $(this).text('Send')
                    },
                    success: (data) => {
                        try{
                            if(data.status)
                            {
                                message.val('');
                                $(this).text('Send')
                                console.log(data);
                            }else{
                                message.val('');
                                $(this).text('Send')
                                $('#alert').append('<div class="alert alert-info" style="color: red!Important;"><p>Something Wrong, Please contact supporters..</p></div>')
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
    })
</script>

