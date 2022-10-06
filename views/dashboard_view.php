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
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editarModalLabel">Editar norma</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="editor-editar"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Editar</button>
            </div>
        </div>
    </div>
    </div>
    <h2 class="text-primary text-center pt-4">Dashboard admin</h2>


    <section class="box mb-5">
        <h3 class="text-center mb-4">Gestión de consultas</h3>
        <form action="" method="post" class="d-flex justify-content-between" style="max-width: 500px; width: 95%; margin: 0 auto;">
            <input type="text" class="form-control me-3" placeholder="Ingrese intentos">
            <button class="btn btn-primary">Actualizar</button>
        </form>
    </section>
    <section class="box">
        <h3 class="text-center mb-4">Normas crud</h3>
        <div class="text-end">
            <button class="btn btn-primary">Agregar</button>
        </div>
        <table id="normas">
            <thead>
                <tr>
                    <td>Normas</td>
                    <td style="max-width: 100px;">acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>norma 1</td>
                    <td>
                        <button class="btn btn-primary me-1" title="Editar" data-bs-toggle="modal" data-bs-target="#editarModal"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/trumbowyg.min.js"></script>


    <script>
        $(document).ready( function () {
            $('#normas').DataTable({
                "info": false,
                "searching": false,
                "lengthChange": false
            });
            $('#editor-editar').trumbowyg({
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
        } );
    </script>
</body>
</html>