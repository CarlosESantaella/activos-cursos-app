<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <div class="container">
            <form action="" method="post" class="row form-register" id="formRegister">
                <h3 class="text-center text-success">Registro</h3>
                <div class="col-12 mb-3">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese Nombre...">
                    <div class="msg-error text-danger"></div>

                </div>
                <div class="col-12 mb-3">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese usuario...">
                    <div class="msg-error text-danger"></div>

                </div>
                <div class="col-12 mb-3">
                    <label for="">Contraseña</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese contraseña...">
                    <div class="msg-error text-danger"></div>

                </div>
                <div class="col-12 text-center mb-3">
                    <button class="btn btn-success btn-submit">Registrarse</button>
                </div>
                <div class="col-12 text-center">
                    <a href="/login">¿Ya tienes cuenta?</a>
                </div>
            </form>
        </div>
    </main>

    <div class="alert alert-primary" role="alert">
        A simple primary alert—check it out!
    </div>
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

                    const rawResponse = await fetch('/login', {
                        method: 'POST',
                        body: formData
                    });
                    const content = await rawResponse.json();
                    console.log(content);
                    if (rawResponse.status == 200) {
                        console.log('login exitoso');
                    }else {
                        // $('.alert-register-error').slideDown();
                        // setTimeout(() => {
                        //     $('.alert-register-error').slideUp();
                        // }, 3000);
                        console.log('error login');
                    }
                }

            })
        })
    </script>
</body>
</html>