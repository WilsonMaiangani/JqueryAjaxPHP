<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
 <title>Document</title>
</head>

<body>
 <section id="">
  <div class="row container">
   <div class="col-lg-6">
    <div class="detalhe-area">
     <form action="" id="frms" name="frms" enctype="multipart/form-data">
      <div class="row">

       <div class="col-lg-8 col-md-6">
        <div class="form-group">
         <label for="">Nome Filme: </label>
         <span class="lblErroGeral" id="lblNomeFilme" style="color: red;"></span>
         <input type="text" class="form-control limpaValor" id="txtNomeFilme">
        </div>

        <div class="form-group">
         <label for="list">Categoria: </label>
         <span class="lblErroGeral" id="lblListCategoria" style="color: red;"></span>
         <select name="" class="form-control limpaValor" id="listCategoria">
         </select>
        </div>

        <div class="form-group">
         <label for="">SubCategoria: </label>
         <input type="text" class="form-control limpaValor" id="txtSubCategoria" disabled>
        </div>

        <div class="form-group">
         <label for="list">Descrição: </label>
         <span class="lblErroGeral" id="lblDescricao" style="color: red;"></span>
         <textarea id="txtDescricao" class="form-control limpaValor"></textarea>
        </div>

        <div class="form-group">
         <input type="submit" value="Save" class="btn" id="btnSave" style="cursor:pointer;">
        </div>

       </div>
      </div>
     </form>
    </div>
   </div>
  </div>
 </section>
 <script src="/public/assets/js/jquery-3.3.1.min.js"></script>
 <script>
  // Bloqueando a submissão 'submit' do formulário
  $("#frms").submit(function(e) {
   e.preventDefault();
  })

  let dataCategoria = {};
  let dataSubCategoria = {};

  function fetchCategoria(listValue = []) {
   let tags = "";
   let count = 0;

   const table = document.querySelector("#listCategoria");
   table.innerHTML = "";

   dataCategoria.forEach(function(item, index) {

    if (count == 0) {
     tags += `<option value="...">...</option>`;
     tags += `<option value="${item.idSubCategoria}">${item.nome}</option>`;
    } else if (count > 0) {
     tags += `<option value="${item.idSubCategoria}">${item.nome}</option>`;
    }
    count++;
   });
   table.innerHTML += tags;
   tags = "";
  }

  // Consumindo uma base API com Ajax
  const consummerAPI = async () => {
   $.ajax({
    url: "app/controllers/api.php",
    type: "Get",
    dataType: "Json",
    success: function(data) {
     dataCategoria = data.data.Categoria;
     dataSubCategoria = data.data.SubCategoria;
     fetchCategoria(dataCategoria);
    }
   })
  }

  consummerAPI();

  // Evento change da comboBox de categorias
  $(document).on('change', '#listCategoria', function() {
   let idSubCategoria = $(this).val();

   if (idSubCategoria > 0 && idSubCategoria != '...') {
    dataSubCategoria.forEach(function(item, index) {
     if (item.id == idSubCategoria)
      $('#txtSubCategoria').val(item.nome);
    });
   } else
    $('#txtSubCategoria').val('')
  })

  function flashMessage(att, sms = "Preencha este campo") {
   $(att).html(`${sms}`);
  }

  const sendData = async (data = {}) => {
   $.ajax({
    url: "app/controllers/getRequest.php",
    type: "Post",
    data: {
     data
    },
    success: function(data) {
     if (data == '200') {
      alert('Dados enviando com sucesso.')
      $(".limpaValor").val('');
      $("#listCategoria").val('...');
     }
    }
   })
  }

  function save() {

   let nomeFilme = $.trim($('#txtNomeFilme').val());
   let categoria = $.trim($('#listCategoria').val());
   let subCategoria = $.trim($('#txtSubCategoria').val());
   let descricao = $.trim($('#txtDescricao').val());

   if (nomeFilme == '' && categoria == '...' && descricao == '')
    flashMessage(".lblErroGeral")
   else {
    $(".lblErroGeral").html('');
    if (nomeFilme == '') flashMessage("#lblNomeFilme")
    if (categoria == '...') flashMessage("#lblListCategoria", 'Selecione a categoria do filme')
    if (descricao == '') flashMessage("#lblDescricao", 'Faça a descrição do filme.')

    if (nomeFilme != '' && categoria != '...' && descricao != '') {
     let data = {
      nomeFilme,
      categoria,
      subCategoria,
      descricao
     }
     sendData(data);
    }
   }
  }

  $("#btnSave").click(function() {
   save();
  })
 </script>

</body>

</html>