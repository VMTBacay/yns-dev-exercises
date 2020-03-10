<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MicroBlog Chaste</title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <div style="padding: 40px; background: #fff;">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
            <tbody>
            <tr>
            <td style="vertical-align: top; padding-bottom:30px;" align="center"><a target="_blank">
                <img src="https://serving.photos.photobox.com/25515512dc84656e11a24278578314c096e8e1d24c93a4ddb707b0d584eaad5b92e1e668.jpg" width="200"></a> </td>
            </tr>
            </tbody>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
            <tbody>
            <tr>
                <?php $email_data = json_decode($content); ?>
            <td><b>Dear <?= $email_data->fullname;?>,</b>
                <p>This is to inform you that, Your account with MicroBlog Chaste has been created successfully. Click the button to activate your account</p>
                <a href="<?= $email_data->link; ?>" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;">Activate Now! </a>
                <br>
                <b>- Thanks (MicroBlog Chaste Team)</b> </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
</html>
