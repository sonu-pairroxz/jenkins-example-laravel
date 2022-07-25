@component('mail::message')
    <table class="es-content" cellspacing="0" cellpadding="0" align="center"
           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
        <tr style="border-collapse:collapse">
            <td align="center" style="padding:0;Margin:0">
                <table class="es-content-body"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                       cellspacing="0" cellpadding="0" align="center">
                    <tr style="border-collapse:collapse">
                        <td align="left" style="padding:0;Margin:0">
                            <table width="100%" cellspacing="0" cellpadding="0"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                <tr style="border-collapse:collapse">
                                    <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                                        <table
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#FFFFFF"
                                            width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                            role="presentation">
                                            <tr style="border-collapse:collapse">
                                                <td class="es-m-txt-l" bgcolor="#ffffff" align="center"
                                                    style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px;padding-left:30px;padding-right:30px">
                                                    <h2 style="Margin:20px 0;line-height:31px;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#666666;text-align: center">
                                                        Reset Password!</h2>
                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:48px;color:#666666;font-size:18px;text-align: left">
                                                        Dear {{ $user->fullname }},</p>
                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666;font-size:18px;text-align: left">
                                                        We have received a reset password request from your email. Please click on the below button to reset your password.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="box-sizing: border-box; font-family:lato, 'helvetica neue', helvetica, arial, sans-serif; position: relative;">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation"
                                                           style="width: 100%;box-sizing: border-box; font-family:lato, 'helvetica neue', helvetica, arial, sans-serif; position: relative;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="box-sizing: border-box; font-family:lato, 'helvetica neue', helvetica, arial, sans-serif; position: relative; text-align: center;">
                                                                <a target="_blank" rel="noopener noreferrer"
                                                                   href="{{ route('users.reset_password', ['token' => $user->token]) }}"
                                                                   style="box-sizing: border-box; position: relative; -webkit-text-size-adjust: none; border-radius: 4px; color: #fff; display: inline-block; overflow: hidden; text-decoration: none; background-color: #FF5645; padding: 8px 24px;">Reset Password</a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p style="margin: 20px 0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666;font-size:18px;text-align: center">
                                                        If you have any questions, feel free to contact <a
                                                            target="_blank"
                                                            href="mailto:support@ris.com"
                                                            style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#FF5645;font-size:18px">support@ris.com</a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endcomponent
