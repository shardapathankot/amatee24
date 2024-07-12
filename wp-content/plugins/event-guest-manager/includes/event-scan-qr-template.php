<!-- <script src="https://unpkg.com/html5-qrcode"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
.page-wrap.padding-default {
    background-color: #000;
}
.page-wraper.clearfix {
    border: 5px solid #fff;
    padding: 25px 25px;
}
.event-template-part p {
    color: #fff;
    /* border-bottom: 1px solid; */
    text-align: center;
    font-size: 25px;
    font-weight: bold;
}
#reader {
    border: none !important;
    /*padding: 25px 0 !important;*/
}

#reader__scan_region {
    background-color: #fff;
    width: 130px !important;
    height: 130px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
}
#reader__scan_region img {
    width: 80px;
}
#reader__dashboard_section_csr button {
    text-decoration: none;
    color: #002642;
    background-color: #cde0ef;
    padding: 10px 15px;
    display: inline-block;
    border-radius: 0px;
    font-size: 15px;
    margin: 10px 0 15px;
}
#html5-qrcode-anchor-scan-type-change {
    color: #fff;
    font-size: 16px;
}
#user-search-form {
    max-width: 500px;
    width: 100%;
    margin: auto;
    display: flex;
    align-items: center;
}
#user-search-form #user-search-query:focus {
    outline: none;
    box-shadow: none;
}
#user-search-form #user-search-query {
    width: 100%;
    height: 45px;
    border-radius: 5px 0px 0px 5px;
    box-shadow: none;
    border: none;
    font-size: 15px;
    padding: 0 10px;
}
#user-search-form button {
    height: 45px;
    font-size: 16px;
    border: none;
    padding: 0 25px;
    color: #002642;
    background-color: #cde0ef;
    border-radius: 0px 5px 5px 0px;
}
.page-wraper table tbody tr td {
    color: #ffffff;
}
.event_detail {
    margin: 20px 0 20px;
}
.event_detail div {
    text-align: center;
    color: #fff;
    padding: 10px 0 0;
    font-size: 16px;
}
p#successmsg {
    margin: 0px !important;
}
    p#successmsg .success {
        padding: 10px;
        background: green;
        width: 93%;
        margin: 10px 15px 0px;
        color: #FFF;
        max-width: 500px;
    width: 100%;
    margin: 0px auto;
    }
    p#successmsg .success p {
        margin: 0px !important;
        font-size: 18px;
    }
    p#errormsg {
        margin: 0px !important;
    }
    p#errormsg .error{
        padding: 10px;
        background: red;
        width: 93%;
        margin: 10px 15px 0px;
        color: #FFF;
        max-width: 500px;
    width: 100%;
    margin: 0px auto;
    }
    p#errormsg .error p {
        margin: 0px !important;
        font-size: 18px;
    }
    p#successmsg .success p, p#successmsg .error p {
        color: #FFF;
        font-size: 18px;
    }
    div#event_name {
        margin: 10px 10px auto;
    }
    button#saveButton {
    text-decoration: none;
    color: #002642;
    background-color: #cde0ef;
    padding: 10px 15px;
    display: inline-block;
    border-radius: 0px;
    font-size: 15px;
    margin: 0px 0 0px;
}
div#event-users-list {
    overflow: auto;
}
</style>
<div class="event-template-part">
    <p>Scan Event QR Code </p>
    <div id="reader"></div>
    <div class="event_detail">
        <div id="event_name"></div>
        <div id="guestname"></div>
        <div id="guest_contact"></div>
        <div id="guest_email"></div> 
        <div id="table_number"></div> 
        <div id="associated_guests"></div>
        <div id="attendance"></div>
        <p id="successmsg"></p>
        <p id="errormsg"></p>
        <div id="button-container"></div> 
    </div>
</div>