<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            background-color: black;
        }

        body {
            padding: 0;
            margin: 0;
            padding-top: 10px;
            overflow: hidden;
        }

        div.frame {
            width: 95%;
            height: 95%;
            background-color: whitesmoke;
            padding: 10px;
            margin: 0 auto;
            border-radius: 5px;
            border-width: 4px;
            border-style: solid;
            border-color: #d2b106;
            border-right-color: #af8928;
            border-bottom-color: #af8928;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <div class="frame">
        <?php echo $content; ?>
    </div>
</body>
</html>