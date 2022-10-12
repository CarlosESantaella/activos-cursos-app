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
            <form action="" method="post" class="row form-login" id="formLogin">
                <h3 class="text-center text-primary-cursos">Login</h3>
                <div class="col-12 mb-3">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control validate-empty" placeholder="Ingrese usuario..." name="username">
                    <p class="msg-error text-danger"></p>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Contraseña</label>
                    <input type="password" class="form-control validate-empty" placeholder="Ingrese contraseña..." name="password">
                    <p class="msg-error text-danger"></p>

                </div>
                <div class="col-12 text-center mb-3">
                    <button type="button" class="btn btn-primary btn-submit">Acceder</button>
                </div>
                <div class="col-12 text-center">
                    <a href="/registro">¿No tienes cuenta?</a>
                </div>
            </form>
        </div>
    </main>

    <div class="alert" role="alert">
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
                    var formLogin = document.getElementById('formLogin');
                    formData = new FormData(formLogin);

                    const rawResponse = await fetch('/actions/auth/login', {
                        method: 'POST',
                        body: formData
                    });
                    const content = await rawResponse.json();
                    
                    if (rawResponse.status == 200) {
                        if(content.type == 'user'){
                            
                            window.location.href = "/";
                        }else if(content.type == 'client'){
                            window.location.href = "/";
                            
                        }else if(content.type == 'admin'){
                            window.location.href = "/dashboard";

                        }
                    }else {
                        // $('.alert-register-error').slideDown();
                        // setTimeout(() => {
                        //     $('.alert-register-error').slideUp();
                        // }, 3000);
                        $('.alert').removeClass('alert-primary');
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-danger');
                        $('.alert').text('Usuario o contraseña incorrecto');
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