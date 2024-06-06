<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* style.css */

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhwWFXk0v9EXikl1nZoctIdNSIFltVdYHL43YiNQsZEGwf3AW5p8fBTBNAl3ia01Nup6Q9U5RoLB-2Be0H691HjeCheaA5cNyyXX4UdGswkKoRm9hYh6ZpEc5svuVJ8bONp14kpuasYW1WxR_6T2dC9XkRPuUjDiRcvS8aY-0o96ZRdvyhxBUrsomSRoa_O/s1080/Snapinsta.app_418535883_18290819038158269_1485815525352137896_n_1080.jpg);
            background-size: cover;
            background-position: center;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form, .pap {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Rental Motor</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="motor_sewa">Jenis Motor:</label><br>
        <select id="motor_sewa" name="motor_sewa" required>
            <?php
            // Dictionary untuk menyimpan data motor dan harganya
            $motor = array(
                "keong balap" => 60000,
                "beat kabur" => 70000,
                "vakrio" => 90000,
                "aerog" => 120000,
            );

            // Tampilkan pilihan motor dari data yang tersedia
            foreach ($motor as $nama_motor => $harga) {
                echo "<option value='$nama_motor'>$nama_motor - Rp. $harga/hari</option>";
            }
            ?>
        </select><br>
        <label for="lama_sewa">Lama Sewa (hari):</label><br>
        <input type="number" id="lama_sewa" name="lama_sewa" min="1" required><br>
        <label for="nama_pelanggan">Nama Pelanggan:</label><br>
        <input type="text" id="nama_pelanggan" name="nama_pelanggan" required><br><br>
        
        <?php
        // Pass motor data as hidden fields
        foreach ($motor as $nama_motor => $harga) {
            echo "<input type='hidden' name='motor_data[$nama_motor]' value='$harga'>";
        }
        ?>
        
        <input type="submit" value="Submit">
    </form>

    <?php
    // Array untuk menyimpan nama-nama member
    $nama_member = array("Bara", "irwan", "capung");

    // Fungsi untuk menghitung total biaya sewa motor
    function hitung_biaya($motor, $motor_sewa, $lama_sewa, $nama_pelanggan, $nama_member) {
        $total_biaya = $motor[$motor_sewa] * $lama_sewa;
        if (in_array($nama_pelanggan, $nama_member)) {
            $total_biaya -= $total_biaya * 0.05;  // Diskon 5% untuk member
        }
        $total_biaya += 10000;  // Tambahan pajak Rp. 10.000
        return $total_biaya;
    }

    // Ambil data dari form jika ada
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_pelanggan = htmlspecialchars($_POST["nama_pelanggan"]);
        $lama_sewa = htmlspecialchars($_POST["lama_sewa"]);
        $motor_sewa = htmlspecialchars($_POST["motor_sewa"]);
        $motor_data = $_POST['motor_data'];

        // Hitung total biaya
        $total_biaya = hitung_biaya($motor_data, $motor_sewa, $lama_sewa, $nama_pelanggan, $nama_member);
        
        echo "<div class='pap'>"; // Tampilkan hasil
        echo "<hr><h2>Detail Sewa</h2>";
        echo "<p><strong>Jenis Motor:</strong> $motor_sewa</p>";
        echo "<p><strong>Lama Sewa:</strong> $lama_sewa hari</p>";
        echo "<p><strong>Nama Pelanggan:</strong> $nama_pelanggan</p>";
        echo "<p><strong>Total Biaya:</strong> Rp. $total_biaya</p><hr>";
        echo "</div>";
    }
    ?>
    
</body>
</html>
    