let stateId = $('#state').val();
let url=`http://localhost:8000/api/lgas/${stateId}`;

        //fetchData expect the url, id of the select field, the option id and option name
            fetchData(url,$('#lga-select'),'lga_id','lga_name');
           
           
     // Get the selected Lga
    $('#lga-select').on('change', function() {
        $('#poll_result').empty();
        
        let selectedLgaId = $(this).val();
        //console.log(selectedLgaId);
        if (typeof page !== 'undefined' && page === 'lga_result') {
            //we are getting all the poll unit id under this lga
            url=`http://localhost:8000/api/poll_unit_id/${selectedLgaId}`;
            let url2="http://localhost:8000/api/announced_lga_result";
           
            fetchDataII(url,url2,'lga')
            return;
        }
        url=`http://localhost:8000/api/ward/${selectedLgaId}`;
        fetchData(url,$('#ward'),'ward_id','ward_name');
    });


     // Get the selected ward
    $('#ward').on('change', function() {
        let wardId = $(this).val();
        //console.log(wardId)
         url=`http://localhost:8000/api/poll_unit/${wardId}`;
        fetchData(url,$('#poll_unit'),'polling_unit_id','polling_unit_name');
    });


    $('#poll_unit').on('change', function() {
        const pollUnitId = $(this).val();
        console.log(pollUnitId)
        const wardId = $('#ward').val();
        //const lgaId = $('#lga-select').val();
        //get the unique polling id and pass it to url2 to get the result
        url=`http://localhost:8000/api/poll_unit_id/${pollUnitId}/${wardId}`;
       let url2="http://localhost:8000/api/announced_poll_unit_result";
       //console.log(url);
      fetchDataII(url,url2)
   });
  
	 
     