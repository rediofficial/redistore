<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
        }
        .content {
            margin-left: 220px; /* Menggeser konten ke kanan */
            padding: 20px;
        }
    
        .chat-box {
            position: fixed;
            bottom: 0;
            right: 20px;
            width: 300px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            font-size: 16px;
            text-align: center;
        }
        .chat-body {
            height: 200px;
            overflow-y: auto;
            padding: 10px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        .chat-footer {
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .chat-footer input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }
        .chat-footer button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .message {
            margin-bottom: 10px;
        }
        .message.user {
            text-align: right;
        }
        .message .text {
            display: inline-block;
            padding: 10px;
            border-radius: 5px;
        }
        .message.user .text {
            background-color: #007bff;
            color: #fff;
        }
        .message.admin .text {
            background-color: #f1f1f1;
        }
    </style>

    <!-- Live Chat -->
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="86cf2103-28ac-4545-98ac-4ea36fa21ad4";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

</head>
<body>

</body>
</html>
