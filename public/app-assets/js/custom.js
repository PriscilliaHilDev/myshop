var stripe = Stripe('pk_test_51Ie3sDCyc4kniZkt0ruwaJGRIAxFHKFOYFagTEPaMKdIfIn5NP9LLEI3cxllzta90gUeSIPR1LqPcTSI47mVi8bJ00g4EU8mxp');
 
 var urlSite ="http://shopping/" ;
 let totalItem = null;
 $( document ).ready(function() {
    // var param = { };
  $.ajax({
        url : urlSite+"panier/counOrdertItems",
        type : "GET",
        // data : param,
        success:function(res){
            totalItem += parseInt(res);
            //  $(".cart-qty").text(totalItem +1) ;
            $(".cart-qty").text(res) ;
        },
        error:function(){
            console.log('error' )
        }
    })
     
   });
 $( document ).ready(function() {
   
  $.ajax({
        url : urlSite+"/article/addProduct",
        type : "GET",
        // data : param,
        success:function(res){
        //    $('#addPanier').attr('disabled', res.button)
           $('#addPanier').tooltip();
        //    $("#addPanier").toggleClass(res.button);
        //    $('#addPanier').focus().toggleClass('active')
        },
        error:function(){
            console.log('error' )
        }
    })
     
   });


$(document).on("click", "#addPanier", function (e) {
    var id= $(this).data('ref');
    var qt = $('.qt-produit').val();
    var name = $(this).data('article');

    
    var param = {
            id : id,
            qt: qt,
        };
            $.ajax({
            url : urlSite+"article/addProduct",
            type : "POST",
            data : param,
            success:function(res){
                $('p.name_article').text(' Bravo vous avez bien ajouté '+name+ "a votre panier");
                $('#smallModal').modal('toggle');
                console.log(res.message + name)

                // si il n'y a pas de cookie et pas de session on redirige
                // if(res.message == "reconnexion obligatoire")
                // {
                //     window.location = urlSite + "auth";
                // }
                // on alors on desactive le button, on le donnant comme attribut la response  button disabled
            
               },
            error:function(){
    
               }
        })
    })

    
$(document).on("click", "#addPanier", function (e) {
    $.ajax({
        url : urlSite+"panier/counOrdertItems",
        type : "GET",
        // data : param,
        success:function(res){
            totalItem += parseInt(res);
            //  $(".cart-qty").text(totalItem +1) ;
            $(".cart-qty").text(res) ;
        },
        error:function(){
            console.log('error' )

        }
    })

 })

 $(document).on("click", ".deleteProduct", function (e) {
     e.preventDefault();     
    // attention les data ne prennent pas de kamelCase !!!! que des masjuscules
    var id = $(this).data("product");
     console.log(id)
     var param = {
        id : id,
    };
    $.ajax({
        url : urlSite+"panier/deleteProduct",
        type : "POST",
        data : param,
        success:function(res){
            location.reload()  
            
        },
        error:function(){
            console.log('error' )

        }
    
    })

})

var idEditQT = null;
$(document).on("click", ".editProduct", function (e) {
    e.preventDefault();     
    // je remplace la valeur de idEditQT var l'id obtenu au clique de edit pour que cette variable soit accessible dans la requete ajax
    idEditQT = $(this).data('product');
    // quand j'ouvre le modal met a 1 la valeur de champs quantité que l'user pour + ou -
    var qt = $('.edit-qt-produit').val(1);
   $('#editModal').modal('toggle');

})

$(document).on("click", "#editQuant", function (e) {
    e.preventDefault();     

   var qt = $('.edit-qt-produit').val();
   var param = {
       id :  idEditQT,
       quant: qt,
   };
   console.log(param)
   $.ajax({
       url : urlSite+"panier/editProduct",
       type : "POST",
       data : param,
       
        success:function(res){
         console.log(res)
            location.reload()             
               },
       error:function(){
           console.log('error' )

       }
   
   })

})
    
/*************** manange view list souscat and cat list**************/
$('.sousCat-custom').on("click", ()=> {
  console.log('type');
  if($('.menu-custom').hasClass('show')){
    $('.menu-custom').removeClass('show')
    $('.menu-custom').addClass('closed')
    $('.deroulant-custom').css('height', "auto");
}
});

$('.cat-custom').on("click", ()=> {
    console.log('cat');
  if($('.nav-custom').hasClass('show')){
      $('.nav-custom').removeClass('show');
  }
  });