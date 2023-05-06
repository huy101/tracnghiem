<!-- https://www.jqueryscript.net/time-clock/Attractive-jQuery-Circular-Countdown-Timer-Plugin-TimeCircles.html -->
<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="inc/TimeCircles.js"></script>
    <link rel="stylesheet" href="inc/TimeCircles.css" />
</head>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "dbcountdown") or die($koneksi);
?>

<body>
    <div class="container text-center">
        <?php
        $tampil = mysqli_query($koneksi, "SELECT * FROM tkegiatan limit 1");
        $data = mysqli_fetch_array($tampil);
        ?>
        <h2><?= $data['nama_kegiatan'] ?> <br> [<?= $data['tanggal'] ?>] </h2>
        <div id="DateCountdown" data-date="<?= $data['tanggal'] ?> 00:00:00"></div>
    </div>
    <script>
        $("#DateCountdown").TimeCircles();
    </script>
</body>

</html>