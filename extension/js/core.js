




function table2Json(table) {
    var info = { open : '', high : '', low :  '', mkt_cap : '', pe_ratio : '', div_yield : '' }

    table.find('tr').each(function(){
        let title = $(this).find('._Es').text().trim();
        let value = $(this).find('._Sl').text().trim();
        if(title == 'Open'){ info.open = value; }
        if(title == 'High'){ info.high = value; }
        if(title == 'Low'){ info.low = value; }
        if(title == 'Mkt cap'){ info.mkt_cap = value; }
        if(title == 'P/E ratio'){ info.pe_ratio = value; }
        if(title == 'Div yield'){ info.div_yield = value; }
    });

    return info;

}
