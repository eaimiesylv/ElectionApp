
           async function fetchData(url,selectField,optionId,optionValue) {
                try {
                    const response = await fetch(url);
                    const options = await response.json();
                    option=loopOver(options,optionId,optionValue)
                    selectField.html(option);
                    finals=options;
                } catch (error) {
                    alert("An error has occur");
                    console.log(error);
                }
            }
    
   async function fetchDataII(url,url2,link="poll_unit") {
                try {
                    const response = await fetch(url);
                    const options = await response.json();
                    let unqid="";
                    if(link == 'poll_unit'){
                        unqid=options['uniqueid'];
                    }
                    else{
                        console.log('lga')
                        unqid=[];
                        for (key in options) {
                            unqid.push(options[key]['polling_unit_id']);
                            
                          }
                         
                    }
                   
                    url=`${url2}/${unqid}`;
                   
                    const secondResponse = await fetch(url);
                    const secondOptions = await secondResponse.json();
                    
                    present(secondOptions,link);
                } catch (error) {
                    alert("An error has occur");
                    console.log(error);
                }
            }
     