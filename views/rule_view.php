<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Norma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/app/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/app/assets/css/trumbowyg.css" rel="stylesheet">
    <style>
        .box-d-none{
            display: none;
        }
    </style>
</head>
<body onselectstart='return false'>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/app/views/partials/nav.php'); ?>

        <div class="container">

            <div class="p-4">
                <h1 class="fs-2 mb-4"><?= $rule["title"] ?></h1>
                
                <p><?= $rule["description"] ?></p>

                <?php 
                    if ($related_rules) {
                        echo "<p><b>Normas relacionadas: </b></p>";
                    }
                    foreach ($related_rules as $key => $value) {
                        echo "<a href='?id=$key'>$value</a><br>";
                    }

                ?>
            </div>

        </div>

</body>
</html>