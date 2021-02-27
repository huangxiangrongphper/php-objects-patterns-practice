<?php
namespace popp\ch12\batch07;

/**
 *  在页面控制器中，控制逻辑与一个或一组视图关联。
 *  嵌入视图的页面控制器
 *
 */
try {
    $venuemapper = new VenueMapper();
    // Venue对象列表，并将其存储在$venues全局变量中
    $venues = $venuemapper->findAll();
} catch (\Exception $e) {
    include('error.php');
    exit(0);
}

// default page follows
?>
<html>
<head>
<title>Venues</title>
</head>
<body>
<h1>Venues</h1>

<?php foreach ($venues as $venue) { ?>
    <?php print $venue->getName(); ?><br />
<?php } ?>

</body>
</html>
