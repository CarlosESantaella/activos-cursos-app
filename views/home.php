<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/assets/css/trumbowyg.css" rel="stylesheet">
    <style>
        .box-d-none{
            display: none;
        }
    </style>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/views/partials/nav.php'); ?>
    <h2 class="text-primary text-center pt-4">Dashboard Cliente</h2>


    <section class="box mb-5">
        <h4 class="text-center mb-2">Buscar norma</h4>
        <form action="" method="post" class="d-flex justify-content-between " style="max-width: 500px; width: 95%; margin: 0 auto;">
            <input type="text" class="form-control me-3 input-search" placeholder="Ingrese en la norma...">
            <button type="button" class="btn btn-primary btn-search">Buscar</button>
        </form>
        <p class="msg-error text-danger text-center"></p>

    </section>
    <section class="box">
        <h3 class="text-center mb-4">Normas crud</h3>
        <div class="text-end">
            <button class="btn btn-primary btn-create">Agregar</button>
        </div>
        <table id="normas">
            <thead>
                <tr>
                    <td>Normas</td>
                    <td>Descripción</td>
                    <td style="max-width: 100px;">acciones</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>
    <section class="box box3 box-d-none" id="box3">
        <h3 class="text-center mb-4 box3-title">Crear</h3>
        <div class="mb-3">
            <label for="">Título</label>
            <input type="text" placeholder="Ingrese el título.." class="form-control title-rule validate-empty" >
            <p class="msg-error text-danger"></p>

        </div>
        <div id="description" class="validate-empty"></div>
        <p class="msg-error text-danger"></p>

        <div class="text-end mt-3">
            <button class="btn btn-primary box3-btn" data-action="" data-id="">Enviar</button>
        </div>

    </section>


    <div class="alert" role="alert">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/trumbowyg.min.js"></script>


    <script>
        $(document).ready( function () {

            const init = async () => {
                // let formData = new FormData();
                // formData.append()

                const rawResponse = await fetch('/actions/rules/get_list', {
                    method: 'GET'
                });
                const content = await rawResponse.json();

                Object.keys(content).forEach((key) => {
                    console.log(content[key].description);
                    $('#normas tbody').append(`
                        <tr>    
                            <td>${content[key].title}</td>
                            <td>${content[key].description}</td>
                            <td>
                                <button class="btn btn-primary me-1 btn-edit" title="Editar" data-id="${content[key].id}"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger" title="Eliminar" data-id="${content[key].id}"><i class="fa-solid fa-trash"></i></button>
                            </td>

                        </tr>
                    `);
                })
                $('#normas').DataTable({
                    "info": false,
                    "searching": false,
                    "lengthChange": false
                });
            }
            
            init();

            $('.btn-search').on('click', function(){
                let value = $('.input-search').val();

                if(value.trim() == ''){
                    $('.input-search').parent().next().text('Este campo es obligatorio');
                }else{
                    $('.input-search').parent().next().text('');

                }
            })

            $('#description').trumbowyg({
                svgPath: '/assets/css/icons.svg',
                btnsDef: {
                    underline: {
                        fn: 'underline',
                        tag: 'u',
                        title: 'underline',
                        text: '<u>U</u>',
                        isSupported: function () { return true; },
                        param: '' ,
                        forceCSS: false,
                        class: 'btn-underline',
                        hasIcon: false
                    }
                    
                },
                btns: [
                    ['viewHTML'],
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['formatting'],
                    ['strong', 'em', 'del', 'underline'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['insertImage'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen']
                ]
            });

            $('.btn-create').on('click', function(){
                window.location.href = "/dashboard#box3";
                $('.box3-title').text('Crear Norma');
                $('.box3').fadeIn();

                $('.box3-btn').attr('data-action', 'create');
            });
            $('body').on('click', '.btn-edit', function(){
                $('.box3-title').text('Editar Norma');
                let id = $(this).attr('data-id');

                window.location.href = "/dashboard#box3";
                $('.box3').fadeIn();

                $('.box3-btn').attr('data-action', 'edit');
                $('.box3-btn').attr('data-id', id);

            });
            $('body').on('click', '.box3-btn', async function(){
                let action = $(this).attr('data-action');
                let id = $(this).attr('data-id');

                let title = $('.title-rule').val();
                let description = $('#description').html();

                
                let flag_empty = false;
                
                if(title.trim() == ''){
                    $('.title-rule').next().text('Este campo es obligatorio');
                    flag_empty = true;
                }else{
                    $('.title-rule').next().text('');

                }
                if(description.trim() == ''){
                    $('#description').parent().next().text('Este campo es obligatorio');
                    flag_empty = true;
                }else{
                    $('#description').parent().next().text('');

                }
                

                if(!flag_empty){

                    if(action == 'create'){
    

    
                        let formData = new FormData();
                        formData.append('title', title);
                        formData.append('description', description);
    
                        const rawResponse = await fetch('/actions/rules/create', {
                            method: 'POST',
                            body: formData
                        });
    
                        const content = await rawResponse.json();

                        $('.alert').removeClass('alert-primary');
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-success');
                        $('.alert').text('Norma creada correctamente');
                        $('.alert').slideDown();
                        setTimeout(() => {
                            $('.alert').slideUp();
                        }, 3000);

                        $('.title-rule').val('');
                        $('#description').html('');

                        $('#normas').DataTable().destroy();
                        $('#normas tbody').html('');
                        init();

                        window.location.href = "/dashboard#normas";
    
                    }else if(action == 'edit'){
                        let formData = new FormData();
                        formData.append('title', title);
                        formData.append('description', description);
                        formData.append('id_rule', id);
    
                        const rawResponse = await fetch('/actions/rules/update', {
                            method: 'POST',
                            body: formData
                        });
    
                        const content = await rawResponse.json();

                        $('.alert').removeClass('alert-primary');
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-success');
                        $('.alert').text('Norma editada correctamente');
                        $('.alert').slideDown();
                        setTimeout(() => {
                            $('.alert').slideUp();
                        }, 3000);

                        $('.title-rule').val('');
                        $('#description').html('');

                        $('#normas').DataTable().destroy();
                        $('#normas tbody').html('');
                        init();

                        window.location.href = "/dashboard#normas";
                    }
                }

            });
        } );
    </script>
</body>
</html>