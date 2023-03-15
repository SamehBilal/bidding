const bidresult = document.getElementById("bidrResults");
const bidInput = document.getElementById("bid");
const bidProcess = document.getElementById("sendBid");
let name = document.getElementById("username");
/*const { default: axios } = require('axios');*/

let repeatCheck = [];

bidProcess.addEventListener('submit', function(e) {
    e.preventDefault();

    if (bidInput.value != '') {
        const options = {
            method: 'post',
            url: '/bid-process',
            data: {
                name: name.value,
                bid: bidInput.value
            },
        }
        console.log(options);
        axios(options);
    }

    window.Echo.channel('auction').listen('Bid', (res) => {
        console.log(res);
    });

    /*window.Echo.channel('auction').listen('.bidding', (res) => {
        if (!repeatCheck.includes(res.bid)) {
            repeatCheck.push(res.bid);
            console.log(res.bid);
            bidresult.innerHTML += '<div class="message"><strong class="name pr-3">' + res.name + '</strong> <span class="singleMessage">' + res.bid + '</span></div><hr>';
        }
    })*/

    bidInput.value = '';
});
