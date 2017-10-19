window.addEventListener('DOMContentLoaded', function () {
  // ...query for the active tab...
  chrome.tabs.query({
    active: true,
    currentWindow: true,
  }, function (tabs) {
    // ...and send a request for the DOM info...
    chrome.tabs.sendMessage(
      tabs[0].id,
      { from: 'popup', subject: 'DOMInfo' },
      // ...also specifying a callback to be called
      //    from the receiving end (content script)
      function(data){
        var stock = data.stock_data;
        var name = stock.name;
        var symbol = stock.symbol;
        var cmp = stock.cmp;
        var price_net_change = stock.price_net_change;
        var price_net_percentage = stock.price_net_percentage;
        var price_status = stock.price_status;
        var open = stock.open;
        var high = stock.high;
        var low = stock.low;

        var data = { 'name'                 : name,
                     'symbol'               : symbol,
                     'cmp'                  : cmp,
                     'price_net_change'     : price_net_change ,
                     'price_net_percentage' : price_net_percentage,
                     'price_status'         : price_status,
                     'open'                 : open,
                     'high'                 : high,
                     'low'                  : low };

        $.ajax({
          // api call for adding into db
          url: "http://localhost:8000/stock/add/",
                type: "POST",
                data: JSON.stringify(data),// now data come in this function
                contentType: "application/json; charset=utf-8",
                crossDomain: true,
                dataType: "json",
                statusCode: {
                    // calling notify function with corresponding messages
                    404: function (response) { notify('Path Not Found', 'The specific path not found in api'); },
                    405: function (response) { notify('Method Not Allowed', 'Method Not Allowed'); },
                    406: function (response) { notify('No Recommendations', 'Not found in recommendations table'); },
                    409: function (response) { notify('Conflict', 'Todays data already entered'); },
                    444: function (response) { notify('No Market', 'Markets are closed on sundays and Saturdays'); },
                    201: function (response) { notify('Saved Sucessfully', 'Data saved :)'); }
                 }
              });

      });
  });
});



// notification function
function notify(message_title, message=''){
  var options = {
      type    : 'basic',
      title   : message_title,
      message : message,
      iconUrl : 'icon.png'
  }

  chrome.notifications.create(options, function(message){
    console.log(message);
  });
}
