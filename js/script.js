var $firstButton = $(".first"),
  $secondButton = $(".second"),
  $resetButton = $(".reset"),
  $input = $("input"),
  $name = $(".name"),
  $email = $(".email")
  $more = $(".more"),
  $yourname = $(".yourname"),
  $yournameFinish = $(".yourname-finish"),
  $youremail = $(".your-email"),
  $reset = $(".reset"),
  $ctr = $(".container");

var namaLengkap = "";

$firstButton.on("click", function(e){
  if($(".name").val() == "" || $(".email").val() == ""){
    alert("Mohon lengkapi data!");
  } else {
    $name = $name.val();
    $email = $email.val(); 
  
  $(this).text("Processing...").delay(900).queue(function(){
        $ctr.addClass("center slider-two-active").removeClass("full slider-one-active");
  });
    
  $yourname.html("Nama Lengkap : "+'<br>'+$name)
  $youremail.html("E-mail : "+'<br>'+$email)
  namaLengkap = $name;}
  e.preventDefault();
});

$secondButton.on("click", function(e){
  $(this).text("Processing...").delay(900).queue(function(){
    $ctr.addClass("full slider-three-active").removeClass("center slider-two-active slider-one-active");
    $yournameFinish.html(namaLengkap);
  });
  e.preventDefault();
  insertData();
});

$resetButton.on("click", function(e){
  location.href=location.href;
});

// ajax insert data
function insertData(){
  $.ajax({
    url: "http://localhost/agum/insertData.php",
    type: "POST",
    data: {
      nama: namaLengkap,
      email: $email,
      is_selesai: 0,
    },
    success: function(data){
      console.log(data);
    }
  });
}