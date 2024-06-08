@extends('main.App')

    @section('style')
      <style>
        .account-tab-wrapp {
          width: 70%;
          height: max-content;
          background-color: #eee;
          margin: 0 auto;
          border-radius: 2.5rem;
          padding: 1rem;
        }
        .bg-remove {
          background-color: transparent !important;
        }
        @media (max-width:991px) {
          .head-tabs {
            display: block !important;
          }

          .login-btn-mobile,
          .account-btn-mobile {
            width: 100% !important;
          }

          .margin-mobile-updated {
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
          }
          .label-first-wrapp {
            display: block !important;
            margin-left: 1.5rem;
            margin-right: 1.5rem;
          }
          .label-first-wrapp .name-wrapp,.surname-wrapp {
            width: 100% !important;
          }
          .confirm-document p {
            font-size: 0.7rem;
          }
        }
      </style>
    @endsection

    @section('content')

      <!-- Section Account   -->
      <section class="account-update-sec py-5">
        <div class="container my-5">

          <div class="row my-3">
            <div class="col-lg-12">
              <div class="account-tab-wrapp">
                <div class="head-tabs d-flex justify-content-around align-items-centr">
                  <a href="#" class="btn btn-primary mt-3 login-btn-mobile login-show"
                    style="width: 45%; border-radius: 2rem;"> Giriş
                    Yap</a>
                  <a href="#" class="btn btn-outline-primary mt-3 account-btn-mobile show-account-sec
                   bg-change-blue" style="width: 45%; border-radius: 2rem;">
                    Hesap Oluştur</a>
                </div>
                <!-- ! New account tab -->
                <form callback="{{$_GET['callback']?? ''}}" method="POST" action="ajax" target="Login" class="form-horizontal">
                  <div class="password-click-hide-sec" >
                    <div class="account-tab-title my-2">
                      <h3 class="text-center pt-3"><b>Hesap Oluşturun veya Giriş Yapın !</b></h3>
                      <h4 class="text-center" style="color:#398ddb !important;"><b>Hesabın yok mu?</b></h4>
                    </div>
                    <div class="mail-pass-wrap my-1">
                      <div class="ms-4 me-4 margin-mobile-updated">
                        <label for="" class="ms-2">E-posta</label> <br>
                        <input type="text" class="w-100 p-2" placeholder="E-posta giriniz..." name="email" style="border-radius: 2rem; background-color: transparent !important; outline:none !important;
                       border:2px solid #111 !important;">
                      </div>
                      <div class="ms-4 me-4 mt-2 margin-mobile-updated">
                        <label for="" class="ms-2">Şifre</label> <br>
                        <input type="password" class="w-100 p-2" placeholder="Şifre giriniz..." name="password" style="border-radius: 2rem; background-color: transparent !important; outline:none !important;
                      border:2px solid #111 !important;">
                      </div>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary p-2  ms-4 mb-3 margin-mobile-updated "
                      style="border-radius: 2rem; width: 95%;"> <span style="font-size: 1.3rem;">Giriş</span></button>
                    <a href="#" class="mt-4 ms-4 text-dark " style="border-bottom:1px solid #398ddb !important;
                    text-decoration: none !important;" id="hide-account-sec">Şifremi unuttum</a>
                  </div>
                </form>
                <!-- ! New account tab End -->
                <!-- ! Forgot Password tab  -->
                <div class="password-update-sec" style="display: none;">
                  <div class="account-tab-title my-2">
                    <h3 class="text-center pt-3"><b>Yeni Şifrenizi Girin</b></h3>
                  </div>
                  <form action="ajax" method="POST" target="FindMyAccount" class="form-horizontal">
                      @csrf
                      <div class="password-update-wrapp my-2">
                        <label for="">Hesabmı bul</label> <br>
                        <input type="email" placeholder="Mail adresinizi giriniz..." class="w-100 p-2" name="Mail" style="background-color: transparent !important;
                          border:2px solid #111 !important; border-radius: 2rem;">
                        <a href="#" class="btn btn-primary w-100 p-2" style="margin-top: 1rem; border-radius: 2rem;">Şifre
                          Değiştir</a>
                      </div>
                  </form>
                </div>
                <!-- ! Forgot Password tab end -->
                <!-- ? Create Account Tab -->
                <div class="create-account-sec w-100" style="display: none;">
                  <h3 class="text-center pt-3"><b>Hesap Oluşturun</b></h3>
                  <div class="create-account-wrapp my-2">
                    <form action="ajax" method="POST" target="SignUp">
                    <div class="label-first-wrapp d-flex  justify-content-around">
                      <div class="name-wrapp" style="width: 45%;">
                        <label for="">İsim</label>
                        <br>
                        <input type="text" placeholder="isim giriniz..." name="FirstName" style="width: 100%;
                          background-color: transparent !important; border:2px solid #111 !important;
                          border-radius: 2rem;" class="p-2">
                      </div>
                      <div class="surname-wrapp" style="width: 45%;">
                        <label for="">Soyisim</label>
                        <br>
                        <input type="text" placeholder="Soyisim giriniz..."  name="LastName" style="width: 100%;
                          background-color: transparent !important; border:2px solid #111 !important;
                          border-radius: 2rem;" class="p-2">
                      </div>
                    </div>
                    <div class="label-other-sec my-1 ms-4 me-4">
                      <label for="">E-posta</label> <br>
                      <input type="email" placeholder="E-posta giriniz..." name="Mail" style="width: 100%;
                        background-color: transparent !important; border:2px solid #111 !important;
                        border-radius: 2rem;" class="p-2">

                      <label for="" class="my-1">Telefon</label> <br>
                      <input type="tel" placeholder="Telefon giriniz..." name="Cell" style="width: 100%;
                        background-color: transparent !important; border:2px solid #111 !important;
                        border-radius: 2rem;" class="p-2">

                      <label for="" class="my-1">Şifre</label> <br>
                      <input type="password" placeholder="Şifre giriniz..." style="width: 100%;
                        background-color: transparent !important; border:2px solid #111 !important;
                        border-radius: 2rem;" class="p-2 first-password">

                      <label for="" class="my-1">Şifre Tekrar</label> <br>
                      <input type="password" name="Password" placeholder="Şifre giriniz..." style="width: 100%;
                        background-color: transparent !important; border:2px solid #111 !important;
                        border-radius: 2rem;" class="p-2" onchange="javascript:$(this).val() != $('.first-password').val() ? Swal.fire('Şifreler aynı değil!','','error').then(()=>{ $(this).val(''); }) : void(0) ;">

                    </div>
                    <div class="mt-3 mb-3 confirm-create-account-sec ms-4">
                      <div class="confirm-document d-flex">
                        <input type="checkbox" class="me-2" style="width: 25px; height: 25px;" name="MembershipAggreement">
                        <p id="MembershipAggreement" style="margin-bottom: 0px !important;">Üyelik Sözleşmesi ve Web Site Aydınlatma Metnini okudum, onaylıyorum</p>
                      </div>
                      <div class="confirm-document d-flex mt-2">
                        <input type="checkbox" class="me-2" style="width: 25px; height: 25px;" name="AddConsent">
                        <p style="margin-bottom: 0px !important;">Ticari Elektronik İleti Metni kapsamında tarafıma reklam, pazarlama ve 
                          tanıtım amaçlı <br>
                          iletiler gönderilmesini kabul ediyorum</p>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 p-2 "
                    style="border-radius: 2rem; width: 95% !important; margin-left: 1.5rem;"> Kayıt Ol</button>
                    </form>
                  </div>
                </div>
                <!-- ? Create Account Tab end-->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section Account End -->
    @endsection

    @section('script')
      <script>

        $(document).ready(function () {
          $('#hide-account-sec').click(function () {
            $('.password-click-hide-sec').fadeOut(100);
            $('.password-update-sec').fadeIn(200);
          });

          $('.login-show').click(function () {
            $('.password-click-hide-sec').fadeIn(100);
            $('.password-update-sec').fadeOut(200);
            $('.create-account-sec').fadeOut(200);
            $(this).css({'background-color':'#0d6efd','color':'#fff'});
            $('.bg-change-blue').css({'background-color':'transparent','color':'#0d6efd'})
          
          });
          $('.show-account-sec').click(function(){
            $('.create-account-sec').fadeIn(200);
            $('.password-click-hide-sec').fadeOut(100);
            $('.password-update-sec').fadeOut(200);
            $('.bg-change-blue').css(
              {
                'background-color':'#0d6efd !important;', 'border-color':' #0d6efd !important',
                'color':'#fff !important'
              });
              $('.login-show').css({'background-color':'#eee !important','color':'#0d6efd'});

          });



        });
      </script>
    @endsection