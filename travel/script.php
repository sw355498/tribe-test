<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>

<script>
    $("#login").click(function(){
        let account=$("#account").val();
        let password=$("#password").val();
        let formdata=new FormData();
            formdata.append("account", account);
            formdata.append("password", password);

            axios.post('/api/do-login.php', formdata)
                .then(function (response) {
                    // console.log(response.data)
                    let status=response.data.status;
                    if(status===1){
                        location.href="";
                    }else if(status===2){
                        $("#login-error").text("帳號或密碼錯誤")
                    }
                })
                .catch(function (error) {
                console.log(error);
            });
    })
/*  */
    ClassicEditor
        .create( document.querySelector( '#floatingTextarea2' ) )
        .then( editor => {
            console.log( editor );
                            } )
        .catch( error => {
            console.error( error );
        } );

</script>