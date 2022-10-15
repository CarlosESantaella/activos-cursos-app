<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/app/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <main>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/app/views/partials/nav.php'); ?>
        <h2 class="text-primary-cursos text-center pt-4">Crear usuario</h2>
        <div class="container">


            <form action="" method="post" class="row form-register" id="formRegister">
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="">Nombre y Apellido</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese nombre y apellido..." name="full_name">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese usuario..." name="username">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="">Contraseña</label>
                    <input type="password" class="form-control validate-empty" placeholder="Ingrese contraseña..." name="password">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese email..." name="email">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese telefono..." name="phone">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="">Limite de consultas</label>
                    <input type="number" min="0" max="1000000" value="300" class="form-control validate-empty" name="limit_query">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="">Expiración de cuenta</label>
                    <input type="date" class="form-control validate-empty" name="expires_at">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-12 text-center mb-3">
                    <button type="button" class="btn btn-primary btn-submit">Crear usuario</button>
                </div>
            </form>
        </div>
    </main>

    <div class="alert " role="alert">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function(){
            $('.btn-submit').on('click', async function(){
                let flag_empty = false;
                $('.validate-empty').each(function(){
                    let value = $(this).val();

                    if(value.trim() == ''){
                        $(this).next().text('Este campo es obligatorio');
                        flag_empty = true;
                    }else{
                        $(this).next().text('');
                    }
                })
                
                if(!flag_empty){
                    var formRegister = document.getElementById('formRegister');
                    formData = new FormData(formRegister);

                    const rawResponse = await fetch('/app/actions/auth/register', {
                        method: 'POST',
                        body: formData
                    });
                    const content = await rawResponse.json();

                    if (rawResponse.status == 201) {
                        $('.alert').removeClass('alert-primary');
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-success');
                        $('.alert').text('Usuario registrado correctamente.');
                        $('.alert').slideDown();
                        formRegister.reset();
                        setTimeout(() => {
                            $('.alert').slideUp();
                        }, 3000);
                        
                    }else if(rawResponse.status == 409){
                        $('.alert').removeClass('alert-primary');
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-danger');
                        $('.alert').text('Usuario registrado, intente con otro nombre de usuario');
                        $('.alert').slideDown();
                        setTimeout(() => {
                            $('.alert').slideUp();
                        }, 3000);
                    }else{
                        $('.alert').removeClass('alert-primary');
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-danger');
                        $('.alert').text('Error al registrar, intente nuevamente');
                        $('.alert').slideDown();
                        setTimeout(() => {
                            $('.alert').slideUp();
                        }, 3000);
                    }
                }

            })
        })
    </script>
</body>
</html>