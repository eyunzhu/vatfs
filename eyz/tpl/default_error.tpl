<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>啊嘞,出错啦</title>
    <style>
        .container {
            width: 60%;
            margin: 10% auto 0;
            background-color: #f0f0f0;
            padding: 2% 5%;
            border-radius: 10px
        }
        a{
            text-decoration: none;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            line-height: 2.3
        }

        a {
            color: #20a53a
        }
    </style>
</head>
<body>
<div class="container">
    <h3>出错啦</h3>
    <p id="ShowDiv"></p>
    <ul>
        <li>当前页面访问出错</li>
        <li>请确认访问地址是否正确</li>
        <li><a href="/">返回首页</a>  本程序基于&nbsp;<a href="https://github.com/eyunzhu/eyz" target="_blank">eyz</a></li>
    </ul>
</div>
</body>
<script language="javascript">
    !function () {
        for(var i=3;i>=0;i--)
            window.setTimeout('doUpdate(' + i + ')', (3-i) * 1000);
    }();
    function doUpdate(num)
    {
        document.getElementById('ShowDiv').innerHTML = '将在'+num+'秒后自动跳转到主页' ;
        if(num == 0)window.location = '/';
    }
</script>
</html>