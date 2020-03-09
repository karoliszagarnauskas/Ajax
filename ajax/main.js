console.log("ar veikia?");

$('#btn-isvedimas').on('click',function() {
  console.log("veikia mygtukas");
  $('body').css('background-color','black');
  $('body').css('color','white');
  /* Act on the event */
  $.ajax({
    url: "controller/getDoctor-ajax.php",   //kur jis eis Ajaxas
    type: "POST",   // kaip jis nes duomenis
    data: {sk: "6"},  //kokius duomenis jis nesa
    success: function(gryzo){
          console.log("ajax success, php faile nera sintakses klaidu");
          console.log(gryzo);

          // =======jei PHP darot: echo "String";================
          // gryzoPaverstasIString = JSON.stringify(gryzo);
          // console.log(gryzoPaverstasIString);
          // $("#results").append(gryzoPaverstasIString.vardas);
                  /* OR */
          //====== jei PHP darot: echo parseTOJSON( $manoAray);====
          // kintamasis 'gryzo' - yra string tipo:  { 'vardas': 'John', 'vietove': 'Boston' }
          gryzoPaverstasIJSON = JSON.parse(gryzo);
          // // JSON.parse sukuria is String (kuris atrodo kaip JSON)
          // // tikra JSON objekta
          console.log(gryzoPaverstasIJSON);
          // //this is what I am unsure about?
          document.querySelector('#gyd-duomenys').innerHTML += gryzoPaverstasIJSON.vietove;
          // // ARBA
          //  $("#results").append(gryzoPaverstasIJSON.vardas);
    },
});

//
//   error: function(e) {
//        //called when there is an error
//        //console.log(e.message);
//        $("#results").append( "Request failed: " + e );
//        console.log("NESUVEIKE!@@@ php failas");
//  }
});
