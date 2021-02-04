<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .block-grid {
            min-width: 320px; 
            max-width: 650px; 
            overflow-wrap: break-word; 
            word-wrap: break-word; 
            word-break: break-word; 
            Margin: 0 auto; 
            background-color: #fffae7;
            border-collapse: collapse;
            display: table;
            width: 100%;
        }
        .col .num12 {
            min-width: 320px; 
            max-width: 650px; 
            display: table-cell; 
            vertical-align: top; 
            width: 650px;
        }
        .img-container .left .fixedwidth {
            padding-right: 0px;
            padding-left: 60px;
        }
        .header {
            border-top: 0px solid transparent; 
            border-left: 0px solid transparent; 
            border-bottom: 0px solid transparent; 
            border-right: 0px solid transparent; 
            padding-top: 5px; 
            padding-bottom: 5px; 
            padding-right: 0px; 
            padding-left: 0px;
        }
        .under-logo {
            color: #393d47;
            font-family:'Cabin', Arial, 'Helvetica Neue', Helvetica, sans-serif;
            line-height: 2;
            padding-top: 40px;
            padding-right: 45px;
            padding-bottom: 5px;
            padding-left: 45px;
        }
        p {
            font-size: 24px; 
            line-height: 2; 
            word-break: break-word; 
            text-align: center; 
            font-family: 'Cabin', Arial, 'Helvetica Neue', Helvetica, sans-serif; 
            mso-line-height-alt: 48px; 
            margin: 0;
        }
        .reset-password {
            color: #451400; 
            font-size: 24px;
        }
        .new-password {
            -webkit-text-size-adjust: none; 
            text-decoration: none; 
            display: inline-block; 
            color: #ffffff !important; 
            background-color: #451400; 
            border-radius: 4px; 
            -webkit-border-radius: 4px; 
            -moz-border-radius: 4px; 
            width: auto; 
            border-top: 0px solid #8a3b8f; 
            border-right: 0px solid #8a3b8f; 
            border-bottom: 0px solid #8a3b8f; 
            border-left: 0px solid #8a3b8f; 
            padding-top: 5px; 
            padding-bottom: 5px; 
            font-family: 'Cabin', Arial, 'Helvetica Neue', Helvetica, sans-serif; 
            text-align: center; 
            mso-border-alt: none; 
            word-break: keep-all;
        }
        .button {
            padding-left: 20px;
            padding-right: 20px;
            font-size: 16px;
            display: inline-block;
            font-size: 16px; 
            line-height: 2; 
            word-break: break-word; 
            font-family: 'Cabin', Arial, 'Helvetica Neue', Helvetica, sans-serif; 
            mso-line-height-alt: 32px;
        }
        .photo {
            text-decoration: none; 
            -ms-interpolation-mode: bicubic; 
            height: auto; 
            border: 0; 
            width: 100%; 
            max-width: 650px; 
            display: block;
        }
    </style>
</head>
<body class="clean-body">
    <table cellpadding="0" cellspacing="0" class="nl-container" role="presentation" valign="top" width="100%">
        <tbody>
            <tr>
                <td>
                    <div class="block-grid col num12">
                        <table cellpadding="0" cellspacing="0" class="divider" role="presentation" valign="top"
                            width="100%">
                            <tbody>
                                <tr valign="top">
                                    <td class="divider_inner" valign="top">
                                        <table cellpadding="0" cellspacing="0" class="divider_content"
                                            role="presentation" valign="top" width="100%">
                                            <tbody>
                                                <tr valign="top">
                                                    <td valign="top"><span></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="block-grid col num12 img-container left fixedwidth">
                        <div class="img-container left fixedwidth header">
                            <a href="localhost:8000" target="_blank">
                                <img class="left fixedwidth" src="{{ $message->embed(public_path().'/bower_components/etrain-mail/images/logo.png') }}" alt="" width="130">
                            </a>
                        </div>
                    </div>
                    <div class="block-grid col num12 under-logo">
                        <div class="under-logo">
                            <p>
                                <span class="reset-password">
                                    <strong>{{ trans('mail.click') }}</strong>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="block-grid no-stack">
                        <div class="col num12">
                            <div align="center" class="button-container">
                                <a class="new-password" href="{{ route('newPassword', ['userId' => $data['userId'], 'token' => $data['token']]) }}" target="_blank">
                                    <span class="button">{{ trans('mail.new') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="block-grid col num12">
                        <div class="img-container center autowidth">
                            <img alt="landscape brown" class="center autowidth photo" src="{{ $message->embed(public_path().'/bower_components/etrain-mail/images/land1__1_.png') }}" title="landscape brown" width="650"/>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
