<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server email</title>
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">

</head>

<body>
    <h1 style="color:white;text-align: center;">Email Server</h1>
    <div style="display:flex;justify-content: center;width:100vw">
        <div style="width: 700px;">           
            <table style="width:100%">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Office</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="1">
                        <td class="email" data-email="nt.nguyen042nn@gmail.com">nt.nguyen042nn@gmail.com</td>
                        <td>Tiger Nixon</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                    </tr>
                    <tr id="2">
                        <td class="email" data-email="nguyen.tan@sunhitech.co">nguyen.tan@sunhitech.co</td>
                        <td>Garrett Winters</td>
                        <td>Tokyo</td>
                        <td>63</td>
                    </tr>
                    <tr id="3">
                        <td class="email" data-email="thaongo8989@gmail.com">thaongo8989@gmail.com</td>
                        <td>Ashton Cox</td>
                        <td>San Francisco</td>
                        <td>66</td>
                    </tr>
                    <tr id="4">
                        <td class="email" data-email="0306201053@caothang.edu.vn">0306201053@caothang.edu.vn</td>
                        <td>Cedric Kelly</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                    </tr>
                    <tr id="5">
                        <td class="email" data-email="cofax@mailvoxa.com">cofax@mailvoxa.com</td>
                        <td>Airi Satou</td>
                        <td>Tokyo</td>
                        <td>33</td>
                    </tr>
                    <tr id="6">
                        <td class="email" data-email="cofax@icircearth.com">cofax@icircearth.com</td>
                        <td>Brielle Williamson</td>
                        <td>New York</td>
                        <td>61</td>
                    </tr>
                </tbody>
            </table>
            <button id="btncheckls" >Check ListEmail</button>
        </div>
        <h3 class="check"></h3>
    </div>
    <br><br><br><br><br><br><br>
    <h1>Check 1 email</h1>
    <input type="email" id="email">
    <button id="btncheck">checkemail</button>
    <h3 id="emailcheck"></h3>
</body>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/dataTables.min.js')}}"></script>

<script src="{{asset('js/checkemail.js')}}"></script>
<script>
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$( document ).ready(function() {
    setInterval(displayHello, 200);
});
    $("#btncheckls").on('click',function(){    
    var arr =[];
    var lsemail = $('.email');
        $.each(lsemail,function(key,item){ 
            key=key+1;  
            $("#"+key).css('background','#ff6363');
            var check ='';
        $.ajax({            
                type:'POST',
                url: "EmailCheck",
                async: false,
                data:{                
                    email:$(item).attr('data-email'),
                },
                success:function(data){ 
                    check=data; 
                    if(data=='250'){
                        $("#"+key).css('background','#6763ff');
                    }else{
                        $("#"+key).css('display','none');  
                    }     
                }            
            });   
        })
     
    }) 
setInterval(displayHello, 200);

function displayHello() {
    var emailcheck =localStorage.getItem('checkemails');
    $('.check').html(emailcheck);
}
</script>
</html>