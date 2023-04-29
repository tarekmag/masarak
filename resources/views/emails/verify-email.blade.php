<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clinic Gulf</title>
</head>

<body>
    <center>
        <table
            style="width:100%; max-width:600px; min-width: 320px; border:none; background:url('{{asset('images/email-template/bg_bottom.png')}}'); background-repeat: repeat-x;background-position: bottom center;background-color: #fff;">
            <tr>
                <td colspan="3"><img src="{{asset('images/email-template/banner.jpg')}}" alt=""></td>
            </tr>
            <tr style="height:700px;">
                <td style="width: 30%;" valign="top"><br>
                    <img src="{{asset('images/email-template/doc_image.jpg')}}" alt="">
                </td>
                <td style="width: 67%;" valign="top"><br><br><br>
                    <h2
                        style="color:#3b9bd5; font-weight: 900; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-size:30px;">
                        Hello, </h2>
                    <p
                        style="color:#333; font-weight: 400; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-size:18px;margin:0;">
                        Welcome to clinic gulf app.</p><br>
                    <p
                        style="color:#333; font-weight: 400; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-size:18px;margin:0;">
                        Please click the button below to verify your email address <a href="{{$url}}"> Click
                            here</a></p><br>
                    <p
                        style="color:#333; font-weight: 400; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-size:18px;margin:0;">
                        If you did not create an account, no further action is required.</p><br>
                    <p
                        style="color:#333; font-weight: 400; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-size:18px;margin:0;">
                        Thanks,</p>
                    <p
                        style="color:#333; font-weight: 400; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-size:18px;margin:0;">
                        Best Regards</p>
                </td>
                <td style="width:3%;"></td>
            </tr>
            <tr>
                <td align="center" colspan="3">

                    <table style="min-width:320px;width:100%;max-width:570px;">
                        <tr>
                            <td colspan="7">
                                <hr style="height:4px;background:#379ad3; max-width:552px;">
                            </td>
                        </tr>
                        <tr>
                            @if(isset($setting['apple_store_link']) && $setting['apple_store_link'] !='')
                            <td style="width:7%;">
                                <a href="{{$setting['apple_store_link']}}"><img style="width:100%;"
                                        src="{{asset('images/email-template/app_store.png')}}" alt=""></a>
                            </td>
                            @endif

                            @if(isset($setting['google_play_link']) && $setting['google_play_link'] !='')
                            <td style="width:7%;">
                                <a href="{{$setting['google_play_link']}}"><img style="width:100%;"
                                        src="{{asset('images/email-template/google_playstore.png')}}" alt=""></a>
                            </td>
                            @endif

                            <td style="width: 18%;">&nbsp;</td>

                            @if(isset($setting['facebook_link']) && $setting['facebook_link'] !='')
                            <td style="width: 1%;max-width:20px;" align="right;">
                                <a href="{{$setting['facebook_link']}}" target="_blank"><img
                                        src="{{asset('images/email-template/facebook.png')}}" alt=""></a>
                            </td>
                            @endif

                            @if(isset($setting['instagram_link']) && $setting['instagram_link'] !='')
                            <td style="width: 1%;max-width:20px;" align="right;">
                                <a href="{{$setting['instagram_link']}}" target="_blank"><img
                                        src="{{asset('images/email-template/instagram.png')}}" alt=""></a>
                            </td>
                            @endif

                            @if(isset($setting['twitter_link']) && $setting['twitter_link'] !='')
                            <td style="width: 1%;max-width:20px;" align="right;">
                                <a href="{{$setting['twitter_link']}}" target="_blank"><img
                                        src="{{asset('images/email-template/twitter.png')}}" alt=""></a>
                            </td>
                            @endif

                            @if(isset($setting['youtube_link']) && $setting['youtube_link'] !='')
                            <td style="width: 1%;max-width:20px;" align="right;">
                                <a href="{{$setting['youtube_link']}}" target="_blank"><img
                                        src="{{asset('images/email-template/youtube.png')}}" alt=""></a>
                            </td>
                            @endif
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td colspan="3"><br></td>
            </tr>
        </table>

    </center>
</body>

</html>