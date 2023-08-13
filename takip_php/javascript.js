
$(document).ready(function(){

var gelenn="";
headmesajsorgu();
hazir();
    
$(document).on("click", '#idgit', function(event) {   // PERSONEL SİLME İŞLEMİ

    var gelen=event.target.value;

    $("#sil").attr("href","islem.php?silid="+gelen);
                                      
 
  //  })
});



$(document).on('click','#temizlebuton',function(){  // MESAJ SİLME İŞLEMİ


   var silinicekid=$('#temizlebuton').val();

      $("#msil").attr("href","islem.php?msilid="+silinicekid);
                                      
    

});


function hazir(){

  
 

 $("#sayfa").load("mesajislemleriajax.php #sayfag");  // BİLDİRİM PANELİ LOAD İŞLEMİ

}

function dongu(){   // DENEME.PHP DEN MESAJLARI SÜREKLİ DÖNDÜRME 

   $.ajax({

    type:"post",
    url:"deneme.php",
    data:{deger:gelenn},
    success:function(cevap){
         var gelencevap=$('#cardg',cevap).html();
         $('#cardg').html(gelencevap);
  //     console.log(cevap);

    }   

   });
}
    


function headmesajsorgu(){  // head mesaj bagde sorgusu

    $.ajax({

    type:"post",
    url:"islem.php",
    data:{head:"geldi"},
    dataType:"text",
    success:function(headcevap){
      
       var deger =jQuery.parseJSON(headcevap);
      

    if(deger>0 && gelenn===""){
         
            $("#badge").show();
            $("#badge").text("Yeni Mesaj");

        }
        else if (gelenn!=="") {

                $("#badge").hide();
            }
               
        else {

            $("#badge").hide();
            console.log("basarisiz.");
        }
         
        
          //  console.log("yok");
        
    
    }   

   });

}

    setInterval(function(){
    headmesajsorgu();
    hazir();
    dongu();
   
    },2500);
  
$(document).on("click", '#mesajgonder1,#mesajoku', function(event) {

     gelenn=event.target.value;
     //gelenn=$("#mesajgonder1,#mesajoku").value();
var isim="firat";
    
$.ajax({

    type:"get",
    url:"mesajislemleriajax.php?veri="+gelenn,
    data:$("#formjs").serialize(),  
    success: function(cevap) {
  

         $("#mesajana").fadeIn(500);

         var gelencevap = $('#mesaj',cevap).html();
          var gelencevap2 = $('#cardg',cevap).html();
          var gelencevap3 = $('#sayfag',cevap).html();  // bu değişiklik önemli
          $('#sayfa').html(gelencevap3);
          $('#sayfag').html(gelencevap3);
       //   $('#card').html(gelencevap2);
       //  var gelencevap2 = $('#mesajlarg',cevap).html();
      //  $("#mesajana").load("mesajislemleriajax.php #mesaj");
         $('#mesajana').html(gelencevap);
         $("#scroll").animate({ scrollTop: $("#scroll")[0].scrollHeight }, 0);
     //   $('#mesajg').html(gelencevap2);
     //   console.log(cevap);
    
    
     //   console.log("gonderildi");
     //     $("#mesajana").load('#anamesaj',cevap);
     //      var gelencevap = $('#mesaj',cevap).html();
   //    $('#mesajana').html(gelencevap);
       
      

    },
    error: function(error){
            console.log(error.toString());
    }
    
});

         $.ajax({
    type:"post",
    url:"islem.php",
    data:{personelid:gelenn},
    success: function(event){

          var gelenyanit =jQuery.parseJSON(event);
         if(gelenyanit=="basarili"){
            console.log(gelenyanit);
            $("#td1").hide();
          //  $("#badge").hide();    
       }
       else{
        console.log("olmadı");
      
       }
    }

}); 

//////////////////////////////
     
});

 $('#mesajana').on('click','#gonderbuton',function(event){

// $(document).on("click",'#gonderbuton', function(e) {
    console.log("tıkla");

    $.ajax({

    type:"post",
    url:"islem.php",
    data:$("#mesajform").serialize(),
    success: function(cevap) {

       
         var gelencevap2 = $('#mesaj',cevap).html();
         $('#mesajana').html(gelencevap2);
           
   $("#scroll").animate({ scrollTop: $("#scroll")[0].scrollHeight }, 0);
        console.log(gelencevap2);

            
    },
    error: function(error){
            console.log(error.toString());
    }

    });

});


});


