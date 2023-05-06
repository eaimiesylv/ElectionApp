<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Election Application</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
       
        <!-- convert all form field to html tag 
       -->
         <!--  holds all api url
        <script  src="{{asset('js/api.js')}}"></script>-->
         <!--  generate the html tag to be render
        <script src="{{asset('js/form/generateform.js')}}"></script>-->
        <style>
        *{
            margin:0;
            padding:0;
            list-style-type:none;
        }
        ul{
            paddding:0;
            margin:0;
        }
        a {
            text-decoration:none !important;
        }
            body{
              
                
                display:grid;
                grid-template-rows:min-content, 1fr;
                grid-template-columns:auto;
                background:rgb(240,242,245);
			    position:relative;
               
                
            }
           nav .fa-solid{
                color:white;
             }
             nav{
                background:#3B82F6;
                padding:2px 1em;
                
             }
            nav ul {
                display: flex;
                align-items: baseline;
                justify-content: space-between;
            }

            nav .mobile {
                margin-left:30px;
            }
            nav li:last-child {
                margin-left: auto;
            }
            aside{
                display:none;
            }
            aside{
                position:absolute;
                background:white;
                min-height:100vh;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                width:auto;
                left:0px;
                z-index:2;
                padding:1em 2em;
               
            
             }
             aside li{
                 padding-top:1.3em;
            }
            aside .fa-solid{
                color:blue;
                padding-right:0.3em;
             }
             .show{
                display:block;
            }
           
            .content{
                background:white;
                margin-top:2em;
                padding:2em;
               
            }
            @media (min-width:900px)  {
                aside{
                    display:block;
                 } 
            }
        </style>
    </head>
    <body>
            <aside>
                <div style="text-align:center" ><img src="{{asset('images/logo.png')}}"/></div>
                <ul>
                  
                    <li><i class="fa-solid fa-bar-chart"></i><a href="/">Polling Result</a></li>
                    <li><i class="fa-solid fa-book"></i><a href="/lga_result">LGA Result</a></li>
                    <li><i class="fa-solid fa-upload"></i><a href="/party">Enter Party Result</a></li>
                    
                    
                 </ul>
            </aside>
            <main>
                <nav>
                    
                    <ul>
                     
                        <li>
                           <img src="{{asset('images/banner.png')}}"/>
                            
                        </li>
                        
                        <li><i class="fa-solid fa-bars mobile" id="mobile_bar"></i></li>
                      
                        
        
                        <li><i class="fa-solid fa-user mobile"></i></li>
                    </ul>
            
                </nav>
                <section class="row">
                
                     @yield('content')
                </section>
            </main>
    </body>
    <script>
        $(document).ready(function() {
       

            $("#mobile_bar").click(function(e) {
               
                if ($("aside").css("display") == "none") {
                $("aside").css("display", "block");
            } else {
                $("aside").css("display", "none");
            }
            
            });

        
        });
    </script>
</html>