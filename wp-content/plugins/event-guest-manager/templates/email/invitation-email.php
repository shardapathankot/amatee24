<style>
    @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@400..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');

    body {
      font-family: "Poppins", sans-serif;
    }

    .Courgette {
      font-family: "Courgette", cursive;
    }

    .our {
      font-family: "Edu NSW ACT Foundation", cursive;
    }

    .font_brush {
      font-family: "Caveat Brush", cursive;
      font-weight: 400;
    }
    p {
    font-size: unset;
    color: unset;
}
.page-wrapper p {
    line-height: unset;
    margin: 0 0 0em;
}
table {
    caption-side: unset;
    border-collapse: unset;
}
td, th {
    border: 1px solid #ebebf1;
    padding: 0px;
    font-size: unset;
    color: unset;
}

@media screen and (max-width:576px) {
    .crmny_section td {
    font-size: 22px !important;
}
.crmny_section td {
    font-size: 18px !important;
}
.Courgette {
    font-size: 40px ! IMPORTANT;
}

.image_time p span:first-child {
    font-size: 13px !important;
}
.crmny_section {
    display: contents;
}
.table_main {
    width: 90% !important;
    padding: 10px !important;
}

}
    /* Old css */
    a.btn.btn-default {
    background: #000;
    color: #FFF;
    font-weight: bold;
    padding: 10px 30px 10px 30px;
    font-size: 25px;
    text-decoration: none;
    }
    a.btn.btn-default:hover{
        background: #CCC;
        color: #000;
    }
    #link-message {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: <?php echo isset($_SESSION['link_message']['decline']) && !empty($_SESSION['link_message']['decline']) ? '#ee0404' : 'green'; ?>;
        padding: 20px 15px;
        border-radius: 5px;
        border-collapse: collapse;
        border-spacing: 0;
        width: inherit;
        max-width: 762px;
        color: #FFF;
        font-size: 20px;
    }
    td {
        border: none;
    }
    
    /* form new design */
    .form-container h1 {
    font-size: 40px;
    line-height: 55px;
    margin: 0;
    margin: 15px 0;
    position: relative;
    text-transform: uppercase;
    font-family: "Futura PT";
    font-weight: 700;
    text-align: center;
    color: #fff;
}
.hideform p {
    line-height: 55px;
    position: relative;
    text-transform: uppercase;
    font-family: "Futura PT";
    font-weight: 500;
    text-align: center;
    color: #fff;
}
.hideform input[type="text"] {
    height: 50px;
    margin-bottom: 20px;
    border: 0;
    border-bottom: 1px solid #CDE0EF;
    background: transparent;
    border-radius: 0;
     color: #fff;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    -moz-appearance: none;
    appearance: none;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
.hideform input[type="text"]::placeholder {
    color: #fff;
}
.hideform input[type="text"]:focus {
    background-color: transparent;
    outline: none;
}
.form-container .btn {
    background-color: #CDE0EF;
    color: #002642;
    padding: 16px 20px;
        border: 1px solid;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px;
    font-weight: 600;
    outline: none;
    box-shadow: none;
    
}
.form-container .btn:hover {
    background-color: #000;
    color: #fff;
    border-color: #fff;
}
.form-container .cancel {
    background-color: transparent;
    border: 2px solid #CDE0EF;
        color: #fff;
}
#qrCodeImage img {
    margin: 10px 0;
    height: 150px;
}
#qrCodeImage p {
    color: #fff;
    font-size: 13px;
}
#event_paypal_button .register-button {
    text-decoration: none;
    background-color: #cde0ef;
    padding: 10px 30px;
    display: inline-block;
    border-radius: 0px;
    font-size: 14px;
    margin: 5px 0;
    color: #111111;
}
#qrCodeImage button {
    text-decoration: none;
    background-color: #cde0ef;
    padding: 5px 10px;
    display: inline-block;
    border-radius: 0px;
    font-size: 12px;
    margin: auto;
    width: 105px;
    border: none;
}

 /* Button used to open the contact form - fixed at the bottom of the page */
 .open-button {
                        background-color: #555;
                        color: white;
                        padding: 16px 20px;
                        border: none;
                        cursor: pointer;
                        opacity: 0.8;
                        bottom: 23px;
                        right: 28px;
                        width: 280px;
                    }

                    /* The popup form - hidden by default */
                    .form-popup {
                        display: none;
                        position: fixed;
                        bottom: 0;
                        right: 15px;
                        z-index: 999999;
                        left: 0;
                        top: 0;
                        background-color: #00000085;
                    }

                    .form_rsvp {
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    /* Add styles to the form container */
                    .form-container {
                        max-width: 500px;
                        padding: 10px;
                        background-color: black;
                        text-align: center;
                        border: 5px solid #fff;
                    }

                    /* Full-width input fields */
                    .form-container input[type=text],
                    .form-container input[type=password] {
                        width: 93%;
                    }
                    

                    /* Add some hover effects to buttons */
                   

                    select.widefat {
                        width: 94%;
                        padding: 15px;
                        margin: 5px 0 22px 0;
                        border: none;
                        background: #f1f1f1;
                    }
  </style>


<div style="background-color: #000000;    padding-bottom: 100px;">
  <table style="    margin: 0px auto 0px;
    background-color: #000;
    caption-side: unset;
    border-collapse: unset;">
    <tbody>

      <tr>
        <td style="  text-align: center;  margin: 1rem auto 0px;
        padding: 30px;
        /* background-image: linear-gradient(180deg, #00000094, #0000001f); */
        background-color: #000000;">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td>
                  <img src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/section-title2.png" alt="">
                </td>
              </tr>
              <tr>
                <td style="font-size: 40px;
                color: #ffffff;">WEDDING INVITATION</td>
              </tr>
              <tr>
                <td>
                  <img style="height: 12px;
                  width: auto;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/heading-border.png" alt="">
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr class="height: 30px;"></tr>
    </tbody>
  </table>
  <table class="table_main" style="max-width: 100%;
  margin: 0px auto 0px;
  width: 50%;
  background-color: #000;
  padding: 30px;
  border: 10px solid #fff;    caption-side: unset;
    border-collapse: unset;">
    <tbody>
      <tr>
        <td style="    margin: 1rem auto 0px;
        border: 1px solid #939393;
        padding: 30px;
        /* background-image: linear-gradient(180deg, #00000094, #0000001f); */
        background-color: #fff;">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td class="Courgette" style="text-align: center;
                font-size: 60px;font-weight: 500; line-height: 100%; color: #000000;">
                  <p style="letter-spacing: 20px;display: inline;">S</p>
                  <p style="letter-spacing: 20px;display: inline;">A</p>
                  <p style="letter-spacing: 20px;display: inline;">V</p>
                  <p style="display: inline;">E</p>
                </td>
              </tr>
              <tr>
                <td class="our" style="
                    text-align: center;
    font-weight: 600;
    font-size: 50px;line-height: 100%; color: #000000;">our</td>
              </tr>
              <tr>
                <td class="Courgette" style=" font-weight: 500;   text-align: center;
                font-size: 60px; color: #000000;">
                  <p style="letter-spacing: 20px;display: inline;">D</p>
                  <p style="letter-spacing: 20px;display: inline;">A</p>
                  <p style="letter-spacing: 20px;display: inline;">T</p>
                  <p style="display: inline;">E</p>
                </td>
              </tr>
              <tr>
                <td style="    text-align: center;
                font-size: 25px;
                padding: 15px 0;
                font-weight: 500;color: #000000;">08 . 17 . 2024</td>
              </tr>
              <tr>
                <td style="    text-align: center;">
                  <img style="        height: 260px;
                  box-shadow: inset 0px 0px 220px #ffffffe0;
                  /* background-color: #ffffff9e; */
                  padding: 10px;
                  border-radius: 5px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/name-logo.png" alt="">
                </td>
              </tr>
              <tr>
                <td style="text-align: center;
                font-weight: 400;
                font-size: 18px; color: #000000;">Request Your Presence At Their Wedding</td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr style="height: 30px;"></tr>
      <tr>
        <td style="">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td>
                  <img style="    width: 100%;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/couple-image.jpg" alt="">
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr style="height: 30px;"></tr>
      <tr>
        <td style="margin: 1rem auto 0px;
                  border: 1px solid #939393;
                  background-image: url(https://amatee24.com/wp-content/uploads/2024/04/background-blank-white-scaled.jpg);background-color: black;
                  background-repeat: no-repeat;
                  background-size: 100%;  -webkit-filter: grayscale(100%);  filter: grayscale(100%);">
          <table class="table_image" style="width: 100%;
                        padding: 30px;
                        background-image: linear-gradient(180deg, #00000042, #000000);">
            <tbody>
              <tr>
                <td class="crmny_section" style="text-align: center; width: 30%;    border-right: 3px solid #fff;">
                  <table style="width: 100%;">
                    <tbody>
                      <tr>
                        <td class="image_time" style="text-align: center;
                                  font-weight: 500;
                                  font-size: 32px;
                                  color: #ffffff;
                                  text-shadow: 1px 2px 0px #000000;font-style: italic;">
                          <p style="margin: 0px 0px;">
                            <span style="font-size: 20px;">11:00 am</span>
                            <br>
                            <span class="font_brush">Ceremony</span>
                          </p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td class="crmny_section" style="text-align: center; width: 65%;">
                  <table style="width: 100%;">
                    <tr>
                      <td class="image_time" style="text-align: center;
                            font-weight: 500;
                            font-size: 32px;
                            color: #ffffff;
                            text-shadow: 1px 2px 0px #000000;font-style: italic;">
                        <p style="margin: 0px 0px;">
                          <span style="font-size: 20px;">5:00 pm</span>
                          <br>
                          <span class="font_brush">Reception/Traditional marriage</span>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="text-align: center;
                color: #fff;">
                  <p style="font-size: 22px; color: #fff; font-weight: 500; margin-top:1rem; margin-bottom:1rem;    text-align: center;">
                    <img style="    display: inline;
                    height: 104px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/location.png" alt="">
                    <br>
                    <span style="color: #fff;">ICCH Hall 8250 Creekbend Dr
                      <br>
                      Houston
                      <br>
                      TX 77071</span>
                  </p>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;">
                  <img style="    width: auto;
                  height: 36px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/border-b-removebg-preview.png" alt="">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;
                color: #fff;
                font-size: 32px;
                font-weight: 500;">RSVP</td>
              </tr>
              <tr>
                <td colspan="2" style="text-align: center;
                color: #ffffff;
                font-size: 15px;
                width: 80%;
                max-width: 100%;
                margin: auto;">
                  We are so excited to celebrate this day with our nearest and dearest, and are hoping to keep the guest
                  list limited. So, a guest specific access QR code will be assigned following your RSVP on our website:
                  amatee24.com. Security will scan QR codes to direct guests to their assigned tables upon arrival.
                  Thank you for respecting our wishes.
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;">
                  <img style="    width: auto;
                  height: 36px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/border-b-removebg-preview.png" alt="">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;
                color: #fff;
                font-size: 32px;
                font-weight: 500;">Adults-Only</td>
              </tr>
              <tr>
                <td colspan="2" style="text-align: center;
                color: #ffffff;
                font-size: 15px;
                width: 80%;
                max-width: 100%;
                margin: auto;    padding-bottom: 50px;">
                  While we adore your little ones, we have opted for an adults-only event to allow everyone enjoy the
                  festivities without any restrictions.
                  We appreciate your understanding.
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr style="height: 30px;"></tr>
      <tr>
        <td>
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td style="text-align: center;">
                  <a style="text-decoration: none;
                  color: #002642;
                  background-color: #cde0ef;
                  padding: 10px 50px;
                  display: inline-block;
                  border-radius: 0px;
                  font-size: 24px;" href="{{accept_url}}"
                  >ACCEPT</a>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</body>