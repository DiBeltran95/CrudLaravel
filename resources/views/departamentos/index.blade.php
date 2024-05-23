<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Departamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="d-flex justify-content-between">
                    <div class="d-md-flex justify-content-md-end">
                        <form action="" method="POST">
                            <div class="btn-group">
                                <input type="text" name="texto" id="buscar" class="form-control" placeholder="Buscar">
                            </div>
                        </form>
                    </div>

                    <div>
                        <a class="btn btn-primary" type="button" onclick="modalCrear()">Crear Departamento</a>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departamentos as $departamento)
                            <tr>
                                <td>{{ $departamento->id}}</td>
                                <td>{{ $departamento->name }}</td>
                                <td>
                                    <div class="flex">
                                        <a class="btn btn-sm btn-primary mr-1" onclick="modalCrear('{{ $departamento->id }}', '{{ $departamento->name }}')">Editar</a>
                                        <span style="margin-left: 5px;"></span>
                                        <button class="btn btn-sm btn-danger" type="button" onclick="confirmDelete('{{ $departamento->id }}', '{{ $departamento->name }}')">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-left align-items-center">
                    <span style="margin-left: 10px;"></span>
                    <div  class="text-white">Total Resultados: {{ $departamentos->total() }}</div>
                    <span style="margin-left: 10px;"></span>
                    {{ $departamentos->links('pagination::bootstrap-4') }}
                </div>            
            </div>
            @if(session('success'))
                <div id="deleteSuccessAlert" class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('danger'))
                <div id="deleteSuccessAlert" class="alert alert-danger" role="alert">
                    {{ session('danger') }}
                </div>
            @endif
            @if(session('warning'))
                <div id="deleteSuccessAlert" class="alert alert-warning" role="alert">
                    {{ session('warning') }}
                </div>
            @endif
        </div>
    </div>
<!--modal para la confirmacion del eliminar -->
    <div class="modal fade" id="modalConEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-body">
                    ¿Deseas eliminar <strong id="departmentName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
<!--modal para crear o actualizar datos -->
    <div class="modal fade" id="modalCrearActualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalCrearActualizarLabel"><strong>Nuevo Departamento</strong> </h5>             
            </div>
            <div class="modal-body">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control d-none" id="recipientid" name="id">
            <input type="text" class="form-control" id="recipientname" name="name" required>
            <div class="invalid-feedback">
               Campo invalido.
            </div>
            </div> 
            </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveBtn">Guardar</button>
            </div> 
            
        </div>
        </div>
    </div>
   
</x-app-layout>

<script>
    $(document).ready(function() {
        var successAlert = $('#deleteSuccessAlert');
        if (successAlert.length > 0) {
            setTimeout(function(){
                successAlert.css('display', 'none');
            }, 3000);
        }    
    });
    
    var deleteId;
    var departmentName;
//Funcion para abrir la ventana modal que confirma la eliminacion del dato
    function confirmDelete(id, name) {
        deleteId = id;
        departmentName = name; 
        $('#departmentName').text(name);
        $('#modalConEliminar').modal('show');
    }        
//Funcion para el boton de confirmacion la cual envia una peticion POST a nuestro controlador
    $('#saveChangesBtn').click(function() {
        let form = document.createElement('form')
        form.method = 'POST'
        form.action = '/departamentos/' + deleteId
        form.innerHTML = '@csrf @method("DELETE")'
        document.body.appendChild(form)
        form.submit()
    }); 
//Funcion para abrir la ventana modal para crear y actualizar
    function modalCrear(id, name) {
        if (id) {
            recipientname.value = name;
            recipientid.value = id;
            var tituloModal = document.getElementById("modalCrearActualizarLabel");
            tituloModal.innerHTML = "<strong>Actualizar Dato</strong>";
            var buttonGuardar = document.getElementById("saveBtn");
            buttonGuardar.innerHTML = "Actualizar";
            $('#modalCrearActualizar').modal('show');
        }else{
            var tituloModal = document.getElementById("modalCrearActualizarLabel");
            tituloModal.innerHTML = "<strong>Nuevo Departamento</strong>";
            var buttonGuardar = document.getElementById("saveBtn");
            buttonGuardar.innerHTML = "Guardar";
            $('#modalCrearActualizar').modal('show');
        }
    }

    $('#saveBtn').click(function() {
        if (document.getElementById('recipientname').value) {
            if (!document.getElementById('recipientid').value) {
                let form = document.createElement('form'); //crea
                form.method = 'POST';
                form.action = '/departamentos';
                form.innerHTML = `
                    @csrf
                    <input type="hidden" name="name" value="${document.getElementById('recipientname').value}">
                `;
                document.body.appendChild(form);
                form.submit();    
            }else{
                let form = document.createElement('form'); //actualiza
                form.method = 'POST';
                form.action = '/departamentos/'+document.getElementById('recipientid').value;
                form.innerHTML = `
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="${document.getElementById('recipientname').value}">
                `;
                document.body.appendChild(form);
                form.submit(); 
            }  
        }else{
            var nameInput = document.getElementById("recipientname");
            var invalidFeedback = document.querySelector('.invalid-feedback');
            invalidFeedback.style.display = 'block';
            nameInput.focus();
        }    
    }); 
    
    $('#modalCrearActualizar').on('hidden.bs.modal', function () {
        recipientname.value = "";
        recipientid.value = "";
    });

    window.addEventListener("load", function(){
    const buscar = document.getElementById("buscar");
    const tableBody = document.querySelector("table tbody");

    buscar.addEventListener("keyup", (e) => {
        fetch(`departamentos/buscar`, {
            method: 'POST',
            body: JSON.stringify({ text: buscar.value }),
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content
            }
        })
        .then(response => response.json())
        .then(data => {
            // Limpiar el contenido existente de la tabla
            tableBody.innerHTML = '';

            // Verificar si hay datos
            if (data.data && data.data.length > 0) {
                // Iterar sobre los datos y crear filas
                data.data.forEach(departamento => {
                    const row = document.createElement("tr");

                    // Crear celdas de la fila
                    const idCell = document.createElement("td");
                    idCell.textContent = departamento.id;

                    const nameCell = document.createElement("td");
                    nameCell.textContent = departamento.name;

                    const actionCell = document.createElement("td");
                    const actionDiv = document.createElement("div");
                    actionDiv.className = "flex";

                    const editButton = document.createElement("a");
                    editButton.className = "btn btn-sm btn-primary mr-1";
                    editButton.onclick = () => modalCrear(departamento.id, departamento.name);
                    editButton.textContent = "Editar";

                    const spacer = document.createElement("span");
                    spacer.style.marginLeft = "5px";

                    const deleteButton = document.createElement("button");
                    deleteButton.className = "btn btn-sm btn-danger";
                    deleteButton.type = "button";
                    deleteButton.textContent = "Eliminar";
                    deleteButton.onclick = () => confirmDelete(departamento.id, departamento.name);

                    actionDiv.appendChild(editButton);
                    actionDiv.appendChild(spacer);
                    actionDiv.appendChild(deleteButton);
                    actionCell.appendChild(actionDiv);

                    // Añadir celdas a la fila
                    row.appendChild(idCell);
                    row.appendChild(nameCell);
                    row.appendChild(actionCell);

                    // Añadir fila al cuerpo de la tabla
                    tableBody.appendChild(row);
                });
            } else {
                // Mostrar mensaje si no hay resultados
                const row = document.createElement("tr");
                const cell = document.createElement("td");
                cell.colSpan = 3;
                cell.textContent = "No se encontraron resultados.";
                row.appendChild(cell);
                tableBody.appendChild(row);
                recipientname.value = buscar.value;
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

    
</script>
