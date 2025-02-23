<div class="modal fade" id="modalAddComentario" tabindex="-1" aria-labelledby="modalAddComentario" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Novo comentário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAddComentario">
          <div class="mb-3">
            <label for="nome_instituicao" class="col-form-label">Instituição:</label>
            <input type="text" class="form-control" id="nome_instituicao" disabled>
            <input type="hidden" class="form-control" id="idinstituicao_modal">
            <input type="hidden" class="form-control" id="iduser_modal">
          </div>
          <div class="mb-3">
            <label for="comentario_modal" class="col-form-label">Comentário:</label>
            <textarea class="form-control" id="comentario_modal" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    const modalAddComentario = document.getElementById('modalAddComentario')
    if (modalAddComentario) {
        modalAddComentario.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            
            const nome_instituicao = button.getAttribute('data-bs-nome_instituicao')
            const idinstituicao = button.getAttribute('data-bs-idinstituicao')
            const iduser = button.getAttribute('data-bs-iduser')

            const modalTitle = modalAddComentario.querySelector('.modal-title')
            const modalBodyInput = modalAddComentario.querySelector('.modal-body input')

            modalTitle.textContent = `New message to ${nome_instituicao}`
            modalBodyInput.value = nome_instituicao

            $('#idinstituicao_modal').val(idinstituicao);
            $('#iduser_modal').val(iduser);

        })
    }

    //no evento do form submit
    document.getElementById('formAddComentario').addEventListener('submit', validaformAddComentario);

    function validaformAddComentario() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('#formAddComentario')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            if (!form.checkValidity()) {
                showToast("toastWhoops");
                event.preventDefault()
                event.stopPropagation()
            } else {
                event.preventDefault();
                addComentario(form);
            }

            form.classList.add('was-validated')
        })
    }

    function addComentario(Data) {
        console.log('cheguei');
        var PostData = {
            "iduser": Data.iduser_modal.value,
            "idinstituicao": Data.idinstituicao_modal.value,
            "comentario": Data.comentario_modal.value,
            "operacao": "add_comentario",
            "controller": "ComentarioController",
        };
        
        $.ajax({
            type: "POST",
            url: "./public/controllers/endpoint.php",
            data: PostData,
            success: function(response) {
                responseJson = JSON.parse(response);

                if (responseJson.status == 200 && responseJson.mensagem == "COMENTARIO_CRIADO") {
                    showToast("toastOperacaoConcluida");
                    setTimeout(function() {
                        window.location.href = "./ver_instituicao.php?id=" + Data.idinstituicao_modal.value;
                    }, 500);
                    return;
                }

                showToast("toastWhoops");
            },
            error: function(response) {
                showToast("toastWhoops");
                console.log('error: ' + response);
            }
        });
    }
</script>