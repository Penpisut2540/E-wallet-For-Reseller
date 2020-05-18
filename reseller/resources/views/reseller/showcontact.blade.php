@extends('layouts.app')
@section('title','Contact')
<style type="text/css">
    html {
        height: 100%;
    }

    body {
        margin: 0px;
        height: 100%;
    }

    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>
<script type="text/javascript" src="https://api.longdo.com/map/?key=a5507f3733f6ffe017510add44f8fca4"></script>
<script>
    var marker = new longdo.Marker({ lon: 100.580696, lat: 13.800252 });
    function init() {
                var map = new longdo.Map({
                  placeholder: document.getElementById('map')
                });
                map.Overlays.add(marker);
                map.zoom(15, true);
              }
</script>

@section('content')
<body onload="init();">
    <div id="map"></div>
</body>
<br>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="au-card recent-report">
            <div class="au-card-inner">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <p><i class="fas fa-map-marker-alt" style="font-size: 20px;"></i>&nbsp; 21 ซอย ลาดพร้าว 42
                    แขวงสามเสนนอก เขตห้วยขวาง กรุงเทพฯ 10310</p>
                <br>
                <p><i class="fas fa-phone" style="font-size: 20px;"></i> 02-038-5588
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-envelope" style="font-size: 22px;"></i>
                    adminreseller@ketshopweb.com</p><br>
                <button type="button" class="btn btn-warning" value="Open Window"
                    onclick="window.open('https://www.google.co.th/maps/place/Tomato+Ideas+Co.,+Ltd./@13.8002602,100.5786063,17z/data=!3m1!4b1!4m5!3m4!1s0x30e29dc9f02f553f:0xf98d00bd0b323e07!8m2!3d13.800255!4d100.580795?hl=th&authuser=0')">คลิกเพื่อดูเส้นทาง</button>
                <br>
                <hr>
                <div class="au-card-inner">
                    <br>
                    <h3 class="title-2 tm-b-5">ติดต่อสอบถาม</h3> <br>
                    กรุณาทิ้งข้อความ หรือความต้องการของท่าน แล้วทางเจ้าหน้าที่จะติดต่อกลับไปค่ะ <br>
                    หรือโทรติดต่อได้ เวลา 9:30 - 18:30 น. ยกเว้นวันเสาร์, วันอาทิตย์ และวันหยุดนัตฤกษ์ <br>
                    <hr>
                    <form method="post" action="{{ route('sendemail') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Enter Your Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ Auth::user()->name }} {{ Auth::user()->surname }}" readonly />
                        </div>
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}"
                                readonly />
                        </div>
                        <div class="form-group">
                            <label>Enter Your Message</label>
                            <textarea name="message" class="form-control" rows="9"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="send" class="btn btn-info" value="Send" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
