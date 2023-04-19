<?php
ob_start();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contributors</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- tailwind css CDN (solve after npm install [note])  if no npm modules -->
    <!-- <script src="https://cdn.tailwindcss.com"></script>  -->
    <link type="image/png" sizes="96x96" rel="icon" href="https://img.icons8.com/external-soft-fill-juicy-fish/60/000000/external-appointment-online-services-soft-fill-soft-fill-juicy-fish.png">
    <!-- Gfonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet" />
    <!-- icon -->
    <link type="image/png" sizes="16x16" rel="icon" href="imgs\1611814068005.jpg" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <style>
        .myfont {
            font-family: "Bungee", cursive;
        }

        .container {
            padding: 2.5rem;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        ul {
            list-style-type: square;
            padding: 1.5rem;
            padding: 2rem;
            display: inline-block;
            justify-content: center;
        }

        p a {
            font-size: 1.2rem;
            font-weight: bold;
            font-family: monospace;
            padding: 0.4rem;
        }

        #Contribute {
            border-radius: 0.4rem;
            display: inline-block;
            width: 99%;
            height: 99%;
            overflow: scroll;
            border: none;
            pointer-events: none;
        }

        .p-1 {
            line-height: 1.8rem;
        }
    </style>
</head>

<body class="p-1 m-0">
    <div class="container">
        <div>
            <p style="font-size:2.2rem;text-decoration: underline;" class="myfont">Contributors:</p>
            <br />
            <code style="font-size:1.2rem;color:#A10035;">(Developers)</code>
            <br>
            <br>
            <p class="p-1">
                <a title="Mail" href="#">Bhavesh Gosavi</a> |
                <a title="Mail" href="#">Himanshu Chaudhari</a> |
                <a title="Mail" href="#">Pushkar Sane</a> |
                <a title="Mail" href="#">Durvesh More</a> |
                <a title="Mail" href="#">Devashish Sule</a> |
                <a title="Mail" href="#">Atharv Desai</a>
            </p>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script type="text/javascript">
    // dark mode js plugin
    const options = {
        bottom: '64px', // default: '32px'
        right: 'unset', // default: '32px'
        right: '32px', // default: 'unset'
        time: '0.5s', // default: '0.3s'
        mixColor: '#fff', // default: '#fff'
        backgroundColor: '#fff', // default: '#fff'
        buttonColorDark: '#100f2c', // default: '#100f2c'
        buttonColorLight: '#fff', // default: '#fff'
        saveInCookies: false, // default: true,
        label: '💡', // default: ''
        autoMatchOsTheme: true // default: true
    }

    const darkmode = new Darkmode(options);
    darkmode.showWidget();
</script>

</html>