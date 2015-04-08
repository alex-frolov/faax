<html>
<head>
    <title><?php echo isset($params['title']) ? $params['title'] : ''; ?></title>
</head>
<body>
    <h1><?php echo isset($params['title']) ? $params['title'] : ''; ?></h1>
    <hr/>
    Today: <?php echo isset($params['dat']) ? $params['dat'] : ''; ?>


    <div style="margin:50px 0 0 0;">
        Author: <a href="mailto:alex.frolov@gmail.com">Aleksander Frolov</a> &copy; 2015
    </div>
</body>
</html>