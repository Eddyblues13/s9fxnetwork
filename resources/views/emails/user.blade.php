<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark" />
    <title>{{ $subject ?? 'Email' }} - S9fx Network</title>
    <!--[if !mso]>-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!--<![endif]-->
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            -webkit-font-smoothing: antialiased;
        }

        table {
            border-spacing: 0;
        }

        td {
            padding: 0;
        }

        img {
            border: 0;
            display: block;
        }

        a {
            color: #3140fc;
        }

        @media only screen and (max-width: 640px) {
            .container {
                width: 100% !important;
            }

            .content-padding {
                padding: 30px 24px !important;
            }

            .header-padding {
                padding: 28px 24px !important;
            }

            .footer-padding {
                padding: 20px 24px !important;
            }
        }

        @media (prefers-color-scheme: dark) {

            body,
            .wrapper {
                background-color: #1a1a2e !important;
            }

            .main-card {
                background-color: #222244 !important;
            }

            .body-text {
                color: #e0e0e0 !important;
            }

            .sub-text {
                color: #aaaaaa !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#f0f2f5;">
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f2f5;">
        <tr>
            <td align="center" style="padding: 40px 16px;">
                <table class="container main-card" width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">
                    <!-- Header with Logo & Subject -->
                    <tr>
                        <td align="center" class="header-padding"
                            style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding: 36px 40px;">
                            <img src="{{ asset('image/logo.png') }}" alt="S9fx Network" width="160"
                                style="display:block; margin-bottom:16px;" />
                            <p
                                style="font-family: 'Inter', Arial, sans-serif; font-size: 22px; font-weight: 700; color: #ffffff; margin: 0; letter-spacing: -0.3px;">
                                {{ $subject ?? 'Notification' }}</p>
                        </td>
                    </tr>
                    <!-- Accent Bar -->
                    <tr>
                        <td style="height: 4px; background: linear-gradient(90deg, #3140fc, #00c6ff);"></td>
                    </tr>
                    <!-- Body Content -->
                    <tr>
                        <td class="content-padding" style="padding: 40px 48px;">
                            <div
                                style="font-family: 'Inter', Arial, sans-serif; font-size: 16px; color: #333333; line-height: 28px;">
                                {!! $data !!}
                            </div>
                        </td>
                    </tr>
                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 48px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-top: 1px solid #e8e8e8;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Help Section -->
                    <tr>
                        <td style="padding: 24px 48px;">
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="background-color: #f0f4ff; border-radius: 8px;">
                                <tr>
                                    <td style="padding: 20px 24px; text-align: center;">
                                        <p
                                            style="font-family: 'Inter', Arial, sans-serif; font-size: 13px; color: #555555; line-height: 22px; margin: 0;">
                                            If you have any questions or need assistance, please don't hesitate to reach
                                            out at
                                        </p>
                                        <a href="mailto:support@s9fxnetwork.com"
                                            style="font-family: 'Inter', Arial, sans-serif; font-size: 14px; color: #3140fc; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 6px;">
                                            support@s9fxnetwork.com
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td align="center" class="footer-padding"
                            style="background-color: #f8f9fa; padding: 24px 48px; border-top: 1px solid #eee;">
                            <p
                                style="font-family: 'Inter', Arial, sans-serif; font-size: 12px; color: #999999; margin: 0; line-height: 20px;">
                                &copy; {{ date('Y') }} S9fx Network. All rights reserved.
                            </p>
                            <p
                                style="font-family: 'Inter', Arial, sans-serif; font-size: 12px; color: #bbbbbb; margin: 8px 0 0;">
                                <a href="https://s9fxnetwork.com"
                                    style="color: #3140fc; text-decoration: none;">s9fxnetwork.com</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>