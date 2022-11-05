<!-- Cái API bèo vãi, dùng free được có 500 lần. Hết hạn rồi!!!!!!! -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $q = $_POST["query"];
    $source = "vi";
    $target = "en";
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "q=$q&target=$target&source=$source",
        CURLOPT_HTTPHEADER => [
            "Accept-Encoding: application/gzip",
            "X-RapidAPI-Host: google-translate1.p.rapidapi.com",
            "X-RapidAPI-Key: d1dac4e3cfmsh2cf666dbd4d65ddp1e0d53jsn002945b5d406",
            "content-type: application/x-www-form-urlencoded"
        ],
    ]);

    $response = curl_exec($curl);
    $json = json_decode($response);
    $resultTranslate =  $json->data->translations[0]->translatedText;
    $err = curl_error($curl);

    curl_close($curl);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API with PHP</title>
    <link rel="shortcut icon" href="./img/api_php.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class='container mt-5'>
        <div class='row justify-content-center'>
            <div class='col-12 col-md-8 col-lg-6 col-xl-5'>
                <form action='./index.php' method='POST'>
                    <div class='mb-3'>
                        <label class='form-label'>Tiếng Việt:</label>
                        <textarea class="form-control" rows="3" name="query" placeholder="Nhập tiếng việt..." required></textarea>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Tiếng Anh:</label>
                        <?php
                        if ($err) {
                            echo "Lỗi rồi " . $err;
                        } else {
                            // echo $response;
                            echo "<textarea class='form-control' rows='3' disabled>$resultTranslate</textarea>";
                        }
                        ?>
                    </div>
                    <button type='submit' class='btn btn-primary'>Xác nhận</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>