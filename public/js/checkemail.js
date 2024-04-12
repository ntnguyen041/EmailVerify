var index =0;
var text =document.getElementById('text');
var shadow ='';
for(var i =0;i<10;i++){
    shadow+=(shadow?',':'')+-i*1+'px '+i*1+'px 0 #d9d9d9';
}
text.style.textShadow =shadow;
var inter = setInterval(settext,50);
textname ='ICHECK AUTHENTICATE ALL EMAILS';
var text2name='';
function settext(){     
    if(index>textname.length){
        clearInterval(inter)
    }
    else{
        text2name = textname.slice(0,index);
    }
    index++;          
    text.setAttribute("data-text", text2name);
    text.innerHTML=text2name;
}

var table= $('#example').DataTable({
    paging: false,
    scrollCollapse: true,
    scrollY: '500px',   
    columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }] 
});
$('.Clear').on('click',function(){
    var blu =$('.email');   
    if(blu.length>0){
        location.reload();
    }
})
$(".SaveEmail").click(function() {
    var blu =$('.blue');
   
    if(blu.length>0){
        
        var csvContent = "data:text/csv;charset=utf-8,";
        var rowTop2 = ["Id","Email"];
    var rowTop = ["ICheck","ICHECK AUTHENTICATE ALL EMAILS"];
    csvContent += rowTop.join(",") + "\r\n";
    csvContent += rowTop2.join(",") + "\r\n";
        $("#example tr").each(function(key,item) {
            if ($(item).hasClass("blue")) {
                var rowData = [];
                $(item).find("td").each(function() {
                    rowData.push($(this).text());
                });
                csvContent += rowData.join(",") + "\r\n";
            }
            if ($(item).hasClass("err")) {
                var rowData = [];
                $(item).find("td").each(function() {
                    rowData.push($(this).text());
                });
                rowData[2]="Insecure";
               
                csvContent += rowData.join(",") + "\r\n";
            }
        });
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "IcheckEmail.csv");
        document.body.appendChild(link); // Required for Firefox
        link.click();
    }else{
        alert('No authentication email found');
    }
   
});

    var counter = 1;
    $('#addRow').on('click', function () {
        var email =$('.addmail').val();
        if(validateEmail(email)==true){
            table.row
            .add([
                counter,
                email, 
                '',                 
            ])
            .draw(false); 
            $('.addmail').css('display','none'); 
            var tr =$("table > tbody > tr");
            $.each(tr,function(key,item){
                $(item).addClass('check '+key+'');
                $(item).attr('data-id',key);
                $(item).find("td:eq(1)").addClass('email');
                $(item).find("td:eq(1)").attr('data-id',key);
                $(item).find("td:eq(2)").addClass('verify');
            }) 
         counter++;            
        }else{
            alert('The email you just entered is in the wrong format');
        }
    });
    function validateEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
        return regex.test(email);
      }
var ExcelToJSON = function() {
this.parseExcel = function(file) {
var reader = new FileReader();
reader.onload = function(e) {
var data = e.target.result;
var workbook = XLSX.read(data, {
type: 'binary'
});
workbook.SheetNames.forEach(function(sheetName) {
var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
var productList = JSON.parse(JSON.stringify(XL_row_object)); 
var rows = $('#example tbody');
for (i = 0; i < productList.length; i++) {
  var columns = Object.values(productList[i])
  table.row
        .add([
            counter,
            ''+columns[0],
            '',
        ])
        .draw(false);
        counter++;
}
    var tr =$("table > tbody > tr");
    $.each(tr,function(key,item){
        $(item).addClass('check '+key+'');
        $(item).attr('data-id',key);
        $(item).find("td:eq(1)").addClass('email');
        $(item).find("td:eq(1)").attr('data-id',key);
        $(item).find("td:eq(2)").addClass('verify');
    }) 

})
};
reader.onerror = function(ex) {
console.log(ex);
};
reader.readAsBinaryString(file);
};
};
function handleFileSelect(evt) {
var files = evt.target.files; // FileList object
var xl2json = new ExcelToJSON();
xl2json.parseExcel(files[0]);
}
document.getElementById('fileupload').addEventListener('change', handleFileSelect, false);

// click cat
$('.listcat').on('click',function(){
    var id = $(this).attr('data-id');
    if(id=='2'){
        $('.cat2').css('display','none');
        $('.cat1').css('display','block');
        $('.cate2').css('display','block');
        $('.cate1').css('display','none');       
        $('.tableCheck').css('display','none');
        $('.docCheck').css('display','block');
    }else{
        $('.cat2').css('display','block');
        $('.cat1').css('display','none');
        $('.cate2').css('display','none');
        $('.cate1').css('display','block');
        $('.tableCheck').css('display','block');
        $('.docCheck').css('display','none');
    }
})
$('#addRow').hover(function(){
    $('.addmail').css('display','block'); 
})
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(".CheckEmail").on('click',function(){    
    var arr =[];
    var lsemail = $('.email');
    var blu =$('.blue');
    var red =$('.red');
    if(lsemail.length<=0){
        alert("Add list before authenticating");
    }
   
    if(blu.length>0||red.length>0){
         alert("Clear the list before authenticating");
    }else{
        $.each(lsemail,function(key,item){ 
            var id = $(item).attr('data-id');
            $("#"+key).css('background','#ff6363'); 
            if(validateEmail($(item).text())==true){
                $.ajax({            
                    type:'POST',
                    url: "EmailCheck",
                    async: true,
                    data:{                
                        email:$(item).text(),
                    },
                    success:function(data){ 
                        console.log(data);
                        if(data=='503'){
                            $("."+id).addClass('err');  
                        }
                        else if(data=='250'){
                            $("."+id).addClass('blue');                   
                        }else{
                            $("."+id).addClass('red'); 
                        }   
                    },
                    error: function (jqXHR, exception) {
                        $("."+id).addClass('red'); 
                    },          
                });  
            }else{
                $("."+id).addClass('red');
            }        
        })
    }
   
}) 
var countbtn =0;
$('.EmailVery').on('click',function(){
    countbtn++;   
    if(countbtn>=3){
        countbtn=0;
    }
    if(countbtn==0){
        $('.EmailVery').text("All Emails");
        $('.check').removeClass('d-none');
        $('.blue').removeClass('d-none');
        $('.red').removeClass('d-none');
    }
    if(countbtn==1){
        $('.EmailVery').text("True");
        $('.check').addClass('d-none');
        $('.blue').removeClass('d-none');
        $('.red').addClass('d-none');
    }
    if(countbtn==2){
        $('.EmailVery').text("False");
        $('.check').addClass('d-none');
        $('.blue').addClass('d-none');
        $('.red').removeClass('d-none');
    }
})
 $('.checkdoc').on('click',function(){
    var id = $(this).attr('data-id');
    var view = $('.DocView');
    $.each(view,function(key,item){
        if($(item).attr('data-id')==id){
            $(item).css('display','block');
        }else{
            $(item).css('display','none'); 
        }
    })
 })
 