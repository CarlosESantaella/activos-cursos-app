<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <!-- Ver Norma Modal -->
    <div class="modal fade" id="verNormaModal" tabindex="-1" aria-labelledby="verNormaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="verNormaModalLabel">Norma</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
        </div>
    </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/app/views/partials/nav.php'); ?>
    <h2 class="text-primary-cursos text-center pt-4">Dashboard Cliente</h2>


    <section class="box mb-5">
        <h4 class="text-center mb-2">Buscar norma</h4>
        <form action="#" id="form-norma" method="post" class="d-flex justify-content-between" style="max-width: 500px; width: 95%; margin: 0 auto;">
            <input type="text" class="form-control me-3 input-search" placeholder="Ingrese en la norma...">
            <button type="submit" class="btn btn-primary btn-search">Buscar</button>
        </form>
        <p class="msg-error text-danger text-center"></p>

    </section>
    <section class="box">
        <h3 class="text-center mb-4">Normas</h3>
        <!-- <div class="text-end">
            <button class="btn btn-primary btn-create">Agregar</button>
        </div> -->
        <div class="table-responsive">
            <table class="table" id="normas">
                <thead>
                    <tr>
                        <td>Normas</td>
                        <td>Descripción</td>
                        <td style="max-width: 100px;">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
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
    <!-- <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>

    <script src="/app/assets/js/trumbowyg.min.js"></script>


    <script>
        $(document).ready( function () {

            const messages = {
                "User trial time expired": "Tu cuenta ha expirado, consulta tu estado con el administrador.",
                "User exceeded query limit": "Tu cuenta ha excedido el limite de consultas, contacta con el administrador."
            }

            const search = async (search) => {
                $('#normas tbody').html("");
                let formData = new FormData();
                formData.append('search', search);

                const rawResponse = await fetch('/app/actions/search/', {
                    method: 'POST',
                    body: formData
                });
                const content = await rawResponse.json();

                if (rawResponse.status == 401) {
                    $(".msg-error").text(messages[content.details]);
                }else {
                    Object.keys(content).forEach((key) => {
                        $('#normas tbody').append(`
                            <tr>    
                                <td>${content[key].title}</td>
                                <td>${stripHtml(content[key].description).slice(0, 30)+'...'}</td>
                                <td>
                                    <button class="btn btn-success me-1 btn-see" title="Ver norma" data-id="${content[key].id}" data-bs-toggle="modal" data-bs-target="#verNormaModal">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    
                                </td>
    
                            </tr>
                        `);
                    })
                    $('#normas').DataTable({
                        "info": false,
                        "searching": false,
                        "lengthChange": false,
                        "responsive": true
                    });
                }

            }

            $('#normas').DataTable({
                    "info": false,
                    "searching": false,
                    "lengthChange": false,
                    "responsive": true

                });

            $('#form-norma').on('submit', async function(e){
                e.preventDefault();
                let value = $('.input-search').val();

                if(value.trim() == ''){
                    $('.input-search').parent().next().text('Este campo es obligatorio');
                }else{
                    $('.input-search').parent().next().text('');
                    $('#normas').DataTable().destroy();

                    search(value);
                    


                    // $('.alert').removeClass('alert-primary');
                    // $('.alert').removeClass('alert-danger');
                    // $('.alert').addClass('alert-success');
                    // $('.alert').text('Busqueda realizada correctamente');
                    // $('.alert').slideDown();
                    // setTimeout(() => {
                    //     $('.alert').slideUp();
                    // }, 3000);
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

            // $('.btn-create').on('click', function(){
            //     window.location.href = "/dashboard#box3";
            //     $('.box3-title').text('Crear Norma');
            //     $('.box3').fadeIn();

            //     $('.box3-btn').attr('data-action', 'create');
            // });
            $('body').on('click', '.btn-see', async function(){
                let rule_id = $(this).attr('data-id');

                let formData = new FormData();
                    formData.append('id_rule', rule_id);

                    const rawResponse = await fetch('/app/actions/rules/get?id='+rule_id, {
                        method: 'GET'
                    });

                    const content = await rawResponse.json();

                    let htmlContent = content.description;
                    console.log(content.related_rules);
                    if (Object.keys(content.related_rules).length > 0) {
                        htmlContent += "<br><br><p><b>Normas relacionadas:</b></p>";
                        for (var key in content.related_rules){
                            if (content.related_rules[key]) {
                                htmlContent += "<a target='_blank' href='rule?id=" + key + "'>" + content.related_rules[key] + "</a><br>";
                            }
                        }
                    }

                    $('#verNormaModal .modal-dialog .modal-body').html('');
                    $('#verNormaModal .modal-dialog .modal-body').html(htmlContent);

                    $('#verNormaModalLabel').text('');
                    $('#verNormaModalLabel').text('Norma: '+content.title);




            });
            // $('body').on('click', '.btn-edit', function(){
                //     $('.box3-title').text('Editar Norma');
            //     let id = $(this).attr('data-id');

            //     window.location.href = "/dashboard#box3";
            //     $('.box3').fadeIn();

            //     $('.box3-btn').attr('data-action', 'edit');
            //     $('.box3-btn').attr('data-id', id);

            // });

            function stripHtml(html) {
                let tmp = document.createElement("DIV");
                tmp.innerHTML = html;
                return tmp.textContent || tmp.innerText || "";
            }

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
    
                        const rawResponse = await fetch('/app/actions/rules/create', {
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
    
                        const rawResponse = await fetch('/app/actions/rules/update', {
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