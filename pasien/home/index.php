<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Karcis</title>
</head>
<body>
    <div class="tampil"></div>
<script src="../assets/js/jquery-3.6.0.js"></script>   
<script>
    $(document).ready(function() {
        setInterval(()=>{getData()}, 5000);

        function getData() {
            $.ajax({
                type: 'GET',
                url: 'getdata.php',
                data: '',
                before: () => {},
                complete: () => {},
                success: (data) => {
                    $('.tampil').html(data);
                },
                error: (e) => {alert('error');}
            })
        }

        // getData();
    })
</script>

</body>
</html>
