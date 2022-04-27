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
    url: "http://localhost/antrian-covid/insertData.php",
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

function runWebSocket() {
  // var token = "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJhbmRpbWFyZGltYW5zYXB1dHJhQGdtYWlsLmNvbSIsInNjb3BlcyI6WyJURU5BTlRfQURNSU4iXSwidXNlcklkIjoiYzFmOTVjNjAtYTM4Ny0xMWVjLTg2YjgtMzMzZmY2MWJkY2EzIiwiZmlyc3ROYW1lIjoiQW5kaSIsImxhc3ROYW1lIjoiTWFyZGltYW4gU2FwdXRyYSIsImVuYWJsZWQiOnRydWUsInByaXZhY3lQb2xpY3lBY2NlcHRlZCI6dHJ1ZSwiaXNQdWJsaWMiOmZhbHNlLCJ0ZW5hbnRJZCI6ImMwYWU2NWQwLWEzODctMTFlYy04NmI4LTMzM2ZmNjFiZGNhMyIsImN1c3RvbWVySWQiOiIxMzgxNDAwMC0xZGQyLTExYjItODA4MC04MDgwODA4MDgwODAiLCJpc3MiOiJ0aGluZ3Nib2FyZC5pbyIsImlhdCI6MTY1MDg0MjcyNCwiZXhwIjoxNjUyNjQyNzI0fQ.jQHZTi66ot1HHlqdLxw2mN1qOlk0ftA9UrlfxtbSmpDtjVlqRrlMPmeILJQ_iUGVsyl-9FFeDih-8M0riObERA";
  // var entityId = "ca1b9340-a387-11ec-86b8-333ff61bdca3";
  var token = "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJibHlua3RhNEBnbWFpbC5jb20iLCJzY29wZXMiOlsiVEVOQU5UX0FETUlOIl0sInVzZXJJZCI6ImE5MmM4OWUwLWI0MDQtMTFlYy1hMTRhLWRkZWUyYjIxNmQxYiIsImZpcnN0TmFtZSI6ImJseW5rIiwibGFzdE5hbWUiOiJ0YSIsImVuYWJsZWQiOnRydWUsInByaXZhY3lQb2xpY3lBY2NlcHRlZCI6dHJ1ZSwiaXNQdWJsaWMiOmZhbHNlLCJ0ZW5hbnRJZCI6ImE3ZTI3ZGIwLWI0MDQtMTFlYy1hMTRhLWRkZWUyYjIxNmQxYiIsImN1c3RvbWVySWQiOiIxMzgxNDAwMC0xZGQyLTExYjItODA4MC04MDgwODA4MDgwODAiLCJpc3MiOiJ0aGluZ3Nib2FyZC5pbyIsImlhdCI6MTY1MDg0NTEwMSwiZXhwIjoxNjUyNjQ1MTAxfQ.mQDgZSWY8tkwNaQABBoPY4AAwuqUaJlIiyZKWF7pzFAIau-QA9m4xEJHNXZv6Ww4bd7ncXAUqM8Mb_Zjct2Kgg";
  var entityId = "eacff950-b4a3-11ec-a14a-ddee2b216d1b";
  var webSocket = new WebSocket("ws://demo.thingsboard.io:80/api/ws/plugins/telemetry?token=" + token);

  if (entityId === "YOUR_DEVICE_ID") {
      alert("Invalid device id!");
      webSocket.close();
  }

  if (token === "YOUR JWT TOKEN") {
      alert("Invalid JWT token!");
      webSocket.close();
  }

  webSocket.onopen = function () {
      var object = {
          tsSubCmds: [
              {
                  entityType: "DEVICE",
                  entityId: entityId,
                  scope: "LATEST_TELEMETRY",
                  cmdId: 10
              }
          ],
          historyCmds: [],
          attrSubCmds: []
      };
      var data = JSON.stringify(object);
      webSocket.send(data);
      alert("Message is sent: " + data);
  };

  webSocket.onmessage = function (event) {
      var received_msg = event.data;
      var value = JSON.parse(received_msg);
      // console.log(value.data.Antrian[0][1]);
      // console.log(JSON.parse(received_msg));
      alert("Message is received: " + received_msg);
      sendWebHook(value.data.Antrian[0][1], value.data.notif_count[0][1]);
  };

  webSocket.onclose = function (event) {
      alert("Connection is closed!");
  };
}

function sendWebHook(antrian, notif_count){
  $.ajax({
    url: "http://localhost/antrian-covid/webhook.php",
    type: "POST",
    data: {
      antrian: antrian,
      incoming_count : notif_count,
    },
    success: function(data){
      console.log(data);
    }
  });
}