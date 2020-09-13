<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <meta name="viewport" content="width=device-width" />
        <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #627aad; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#333333" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <tr>
                <td align="center" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img src="<?= base_url(); ?>assets/img/brand/logo.png" alt="AppUI Logo" width="380"  style="display:block;" />
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#627aad" style="padding: 25px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 26px;">
                    <b>Purchase Amount Successfully Added</b><br>&#8377; <?= $amount; ?>/-
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #000;">
                    <img src="https://masterclap.in/uploads/thumbs/succ.jpg" alt="Launch Icon" width="200" height="200" style="display:block;" /><br/>
                    <span>Dear <?= $name; ?>,<br>Your purchase amount successfully added to your account. The percentage of your cashback <?= $csbk; ?> has  been added to your wallet.</span>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 10px 20px; font-family: Arial, sans-serif;">
                    <table bgcolor="#627aad" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td align="center" height="55" style=" padding: 0 35px 0 35px; font-family: Arial, sans-serif; font-size: 22px;" class="button">
                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;"><?= $bal; ?>/- <br>Wallet Balance</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 10px 20px 20px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 18px; line-height: 30px;">
                    
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 15px; line-height: 24px;">
                    
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#e9e9e9" style="padding: 12px 10px 12px 10px; color: #888888; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>Samridhi India.</b> | info@samridhiindia.com 
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                2020 &copy; <a href="https://samridhiindia.com/" style="color: #627aad;">Samridhi India.</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>