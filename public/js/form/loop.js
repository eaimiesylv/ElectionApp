 function loopOver(options,optionId,optionValue){
                let option = '<option disabled selected>Select '+ optionValue +' </option>'
                for (key in options) {
                      let id=options[key][optionId];
                      let value=options[key][optionValue];
                    option += '<option value="' + id + '">' + value + '</option>';
                    }
                return option;
            }

 function present(results,link="poll_unit"){
        const count = results.length;
        let total=0;
        $('#poll_result').html('<h2>No score has been uploaded</h2>');
        if(count <=0){
            return "";
        }
        let result = "<table class='table'><thead><th>Party</th><th class='text-right' scope='col'>Score</th></thead>"
        result+="<tbody>"
                for (key in results) 
                {
                    result+="<tr>"
                    result+="<td>"+results[key]['party_abbreviation'] +"<td>"
                    result+="<td>"+results[key]['party_score'] +"<td>"
                    result+="</tr>"
                    total+=results[key]['party_score'];
                }
                if(link == 'lga'){
                    result+="<tr>"
                    result+="<td><b>Total</b><td>"
                    result+="<td><b>"+total+"</b><td>"
                    result+="</tr>"
                }
                result+="</tbody>"
                result+="</table>"
             
                $('#poll_result').html(result)
              }