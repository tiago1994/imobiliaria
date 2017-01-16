        <br>
    </div>
        </div>
        <br>

        <script src="js/jquery.js"></script>
        <script src="js/jquery.fittext.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/creative.js"></script>
        <script src="dist/js/lightbox-plus-jquery.min.js"></script>
        <script src='https://code.jquery.com/jquery-1.12.3.js'></script>
        <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js'></script>
        <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
        <script src='https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js'></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable( {
                    "oLanguage": {
                        "oPaginate": {
                            "sNext": "Próxima",
                            "sPrevious": "Anterior"
                        },
                        "sSearch": "Buscar:",
                        "sLengthMenu": "Mostrar _MENU_ linhas",
                        "sInfo": "Mostrando da _START_ a _END_ de _TOTAL_ linhas"
                    }
                } );
            });
        </script>

        <script type="text/javascript">
            // confirmacao remocao
            $(".btnremover").click(function(){
                var link = $(this).attr("href");
                $('.confirmaexclusao').modal('show');
                $("#btnconexclusao").attr('href', link);
                return false;
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#upload_recibo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imgInp").change(function(){
                $("#upload_recibo").show();
                readURL(this);
            });
            function moeda(z){      
                v = z.value;    
                v=v.replace(/\D/g,"");  
                v=v.replace(/[0-9]{12}/,"inválido"); 
                v=v.replace(/(\d{1})(\d{8})$/,"$1.$2");  
                v=v.replace(/(\d{1})(\d{5})$/,"$1.$2");
                v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2"); 
                z.value = v;  
            }
        </script>
    </body>
</html>      