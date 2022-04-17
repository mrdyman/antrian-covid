<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Anti Covid-19</title>
</head>
<body>
    <div class="container slider-one-active">
        <div class="steps">
          <div class="step step-one">
            <div class="liner"></div>
            <span>Biodata</span>
          </div>
          <div class="step step-two">
            <div class="liner"></div>
            <span>Verifikasi</span>
          </div>
          <div class="step step-three">
            <div class="liner"></div>
            <span>Selesai</span>
          </div>
        </div>
        <div class="line">
          <div class="dot-move"></div>
          <div class="dot zero"></div>
          <div class="dot center"></div>
          <div class="dot full"></div>
        </div>
        <div class="slider-ctr">
          <div class="slider">
            <form class="slider-form slider-one">
              <h2>Masukkan Biodata Anda.</h2>
              <label class="input">
                <input type="text" class="name" placeholder="Nama Lengkap" required>
              </label>
              <label class="input">
                <input type="text" class="email" placeholder="E-mail" required>
              </label>
              <button class="first next">Selanjutnya</button>
            </form>
            <form class="slider-form slider-two">
              <h2>Apakah data anda sudah benar?</h2>
              <div class="label-ctr">
                <h3 class="yourname"></h3>
                <h3 class="your-email"></h3>
              </div>
              <button class="second next">Proses</button>
              <button class="reset" style="background: red;">Reset</button>
            </form>
            <div class="slider-form slider-three">
              <h2>Halo, <span class="yourname-finish"></span></h2>
              <h3>Terimakasih! <br> silahkan menunggu antrian.</h3>
              <label class="radio">
                <input type="radio" value="happy" name="condition">
                <div class="emot happy">
                  <div class="mouth smile"></div>
                </div>
              </label><br><br><br>
            </div>
          </div>
        </div>
      </div>
</body>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="js/script.js"></script>