chrome.runtime.onMessage.addListener(function (msg, sender, response) {

  if ((msg.from === 'popup') && (msg.subject === 'DOMInfo')) {
    response({'stock_data':googleData()});
  }

});

//-------------------------------------------------------------------------------------------------------------
//------------------------------- THIS IS FOR RETREVING DATA FROM GOOGLE.COM  ---------------------------------
//-------------------------------------------------------------------------------------------------------------

function googleData(){


      var card = $('.vk_c .card-section .fac-lstng');

      let name = $('._KNe').text();
      let price = $('[data-value]').text();
      let price_change = $('.fac-cc').eq(0).text().split(' ');
      let price_status = ($('.finance_answer_card__apc').hasClass('vk-fin-dn')) ? "down" : "up";
      let stock_details =  table2Json($('.card-section .ts'));
      let symbol_details = $('.vk_gy.vk_sh').text();

      var company = {
        name                 : name,
        symbol               : symbol_details.split(' ')[1],
        cmp                  : price,
        price_net_change     : price_change[0],
        price_net_percentage : price_change[1],
        price_status         : price_status,
        open                 : stock_details.open,
        high                 : stock_details.high,
        low                  : stock_details.low,
        mkt_cap              : stock_details.mkt_cap,
        pe_ratio             : stock_details.pe_ratio,
        div_yield            : stock_details.div_yield
      };

      return company;

}


//------------------------------------------------------------------------------------------------------------------------
//------------------------------- THIS IS FOR RETREVING DATA FROM ECONOMICS TIMES WEBSITE ---------------------------------
//------------------------------------------------------------------------------------------------------------------------

function economicTimesData(){
  if ($('section#nseStock').length) {
  let name = $('#stockTitle').find('.no_newline').text();
  // NSE
  let nseTradeprice = $('#nseTradeprice').text();
  let nseNetchange  = $('#nseNetchange').text();
  let nsePercentChange  = $('#nsePercentChange').text();
  let nseOpenprice = $('#nseOpenprice').text();
  // BSE
  let bseTradeprice = $('#bseTradeprice').text();
  let bseNetchange = $('#bseNetchange').text();
  let bsePercentChange = $('#bsePercentChange').text();
  let bseOpenprice   = $('#bseOpenprice').text();

  let pe = $('.p_e').text();

  // data
  var data = { 'name'              : name,
               'nseTradeprice'     : nseTradeprice,
               'bseTradeprice'     : bseTradeprice,
               'nseNetchange'      : nseNetchange ,
               'bseNetchange'      :  bseNetchange,
               'nsePercentChange'  :  nsePercentChange,
               'bsePercentChange'  :  bsePercentChange,
               'nseOpenprice'      :  nseOpenprice,
               'bseOpenprice'      :  bseOpenprice,
               'pe_ratio'          :  pe}

  }
}
