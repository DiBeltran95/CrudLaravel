<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Empleados') }}
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
                        <a class="btn btn-primary" type="button" onclick="modalCrear()">Crear Empleado</a>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>IDENTIFICACIÓN</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>CELULAR</th>
                            <th>CORREO</th>
                            <th>DEPARTAMENTO</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->identification }}</td>
                                <td>{{ $empleado->first_name }}</td>
                                <td>{{ $empleado->last_name }}</td>
                                <td>{{ $empleado->phone }}</td>
                                <td>{{ $empleado->email }}</td>
                                <td>{{ $empleado->department_name }}</td>
                                <td>
                                    <div class="flex">
                                        <a class="btn btn-sm btn-primary mr-1" onclick="modalCrear('{{ $empleado->id }}', '{{ $empleado->identification }}', '{{ $empleado->first_name }}', '{{ $empleado->last_name }}', '{{ $empleado->phone }}', '{{ $empleado->email }}', '{{ $empleado->fk_department }}')">Editar</a>
                                        <span style="margin-left: 5px;"></span>
                                        <button class="btn btn-sm btn-danger" type="button" onclick="confirmDelete('{{ $empleado->id }}', '{{ $empleado->identification }}')">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-left align-items-center" id="paginacion">
                    <span style="margin-left: 10px;"></span>
                    <div  class="text-white">Total Resultados: {{ $empleados->total() }}</div>
                    <span style="margin-left: 10px;"></span>
                    {{ $empleados->links('pagination::bootstrap-4') }}
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
                    ¿Deseas eliminar al usuario con identificación <strong id="empleadoidentification"></strong>?
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
                <h5 class="modal-title" id="modalCrearActualizarLabel"><strong>Nuevo Empleado</strong> </h5>             
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-Identificación" class="col-form-label">Identificación:</label>
                        <input type="text" class="form-control d-none" id="recipientid" name="id">
                        <input type="text" class="form-control" id="id_identification" name="identification" required>                        
                        <label for="id_first_name" class="col-form-label">Nombres:</label>
                        <input type="text" class="form-control" id="id_first_name" name="first_name" required>                       
                        <label for="recipient-name" class="col-form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="id_last_name" name="last_name" required>                        
                        <label for="recipient-name" class="col-form-label">Celular:</label>
                        <input type="text" class="form-control" id="id_phone" name="phone" required>                        
                        <label for="recipient-name" class="col-form-label">Correo:</label>
                        <input type="text" class="form-control" id="id_email" name="email" required>                       
                        <label for="recipient-name" class="col-form-label">Departamento:</label>
                        <select class="form-select" id="id_fk_department" name="fk_department" required>
                            <option value="">Seleccionar departamento</option>
                            @foreach($departamentos as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>                       
                    </div>  
                    <div class="invalid-feedback">
                        Por favor ingresa todos los datos.
                    </div>                  
                </div>                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="saveBtn">Guardar</button>
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
    var empleadoidentification;
//Funcion para abrir la ventana modal que confirma la eliminacion del dato
    function confirmDelete(id, identification) {
        deleteId = id;
        empleadoidentification = identification; 
        $('#empleadoidentification').text(identification);
        $('#modalConEliminar').modal('show');
    }        
//Funcion para el boton de confirmacion la cual envia una peticion POST a nuestro controlador
    $('#saveChangesBtn').click(function() {
        let form = document.createElement('form')
        form.method = 'POST'
        form.action = '/empleados/' + deleteId
        form.innerHTML = '@csrf @method("DELETE")'
        document.body.appendChild(form)
        form.submit()
    }); 
//Funcion para abrir la ventana modal para crear y actualizar
    function modalCrear(id, identification, first_name, last_name, phone, email, fk_department) {
        if (id) {
            id_identification.value = identification;
            id_first_name.value = first_name;
            id_last_name.value = last_name;
            id_phone.value = phone;
            id_email.value = email;
            id_fk_department.value = fk_department;
            recipientid.value = id;
            var tituloModal = document.getElementById("modalCrearActualizarLabel");
            tituloModal.innerHTML = "<strong>Actualizar Empleado</strong>";
            var buttonGuardar = document.getElementById("saveBtn");
            buttonGuardar.innerHTML = "Actualizar";
            $('#modalCrearActualizar').modal('show');
        }else{
            var tituloModal = document.getElementById("modalCrearActualizarLabel");
            tituloModal.innerHTML = "<strong>Nuevo Empleado</strong>";
            var buttonGuardar = document.getElementById("saveBtn");
            buttonGuardar.innerHTML = "Guardar";
            $('#modalCrearActualizar').modal('show');
        }
    }

    $('#saveBtn').click(function() {
        event.preventDefault();
        
        if (document.getElementById('id_identification').value && document.getElementById('id_first_name').value && document.getElementById('id_last_name').value && document.getElementById('id_phone').value && document.getElementById('id_email').value && document.getElementById('id_fk_department').value ) {
            
            var numericRegex = /^\d+$/;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!document.getElementById('id_identification').value.match(numericRegex)) {
                var Input = document.getElementById("id_identification");
                var invalidFeedback = document.querySelector('.invalid-feedback');
                invalidFeedback.textContent = "El campo Identificacion solo recibe números.";
                invalidFeedback.style.display = 'block';
                Input.focus();
                return;
            }

            if (!document.getElementById('id_phone').value.match(numericRegex)) {
                var Input = document.getElementById("id_phone");
                var invalidFeedback = document.querySelector('.invalid-feedback');
                invalidFeedback.textContent = "El campo celular solo recibe números.";
                invalidFeedback.style.display = 'block';
                Input.focus();
                return;
            }

            if (!document.getElementById('id_email').value.match(emailRegex)) {
                var Input = document.getElementById("id_email");
                var invalidFeedback = document.querySelector('.invalid-feedback');
                invalidFeedback.textContent = "El campo correo debe tener un formato valido.";
                invalidFeedback.style.display = 'block';
                Input.focus();
                return;
            }

            if (document.getElementById('id_first_name').value === "" || document.getElementById('id_last_name').value === "") {
                alert("Todos los campos deben ser completados.");
                return;
            }
            
            if (!document.getElementById('recipientid').value) {
                let form = document.createElement('form'); //crea
                form.method = 'POST';
                form.action = '/empleados';
                form.innerHTML = `
                    @csrf
                    <input type="hidden" name="identification" value="${document.getElementById('id_identification').value}">
                    <input type="hidden" name="first_name" value="${document.getElementById('id_first_name').value}">
                    <input type="hidden" name="last_name" value="${document.getElementById('id_last_name').value}">
                    <input type="hidden" name="phone" value="${document.getElementById('id_phone').value}">
                    <input type="hidden" name="email" value="${document.getElementById('id_email').value}">
                    <input type="hidden" name="fk_department" value="${document.getElementById('id_fk_department').value}">
                `;
                document.body.appendChild(form);
                form.submit();    
            }else{
                let form = document.createElement('form'); //actualiza
                form.method = 'POST';
                form.action = '/empleados/'+document.getElementById('recipientid').value;
                form.innerHTML = `
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="identification" value="${document.getElementById('id_identification').value}">
                    <input type="hidden" name="first_name" value="${document.getElementById('id_first_name').value}">
                    <input type="hidden" name="last_name" value="${document.getElementById('id_last_name').value}">
                    <input type="hidden" name="phone" value="${document.getElementById('id_phone').value}">
                    <input type="hidden" name="email" value="${document.getElementById('id_email').value}">
                    <input type="hidden" name="fk_department" value="${document.getElementById('id_fk_department').value}">
                `;
                document.body.appendChild(form);
                form.submit(); 
            }  
        }else{
            var invalidFeedback = document.querySelector('.invalid-feedback');
            invalidFeedback.textContent = "Todos los campos deben ser completados.";
            invalidFeedback.style.display = 'block';
        }    
    }); 
    
    $('#modalCrearActualizar').on('hidden.bs.modal', function () {        
        recipientid.value = "";
        id_identification.value = "";
        id_first_name.value = "";
        id_last_name.value = "";
        id_phone.value = "";
        id_email.value = "";
        id_fk_department.value = "";
    });

    window.addEventListener("load", function(){
        const buscar = document.getElementById("buscar");
        const tableBody = document.querySelector("table tbody");
        const paginationContainer = document.getElementById('paginacion');
        paginationContainer.classList.add('d-flex', 'justify-content-left', 'align-items-center');
        
        buscar.addEventListener("keyup", (e) => {
            fetch(`empleados/buscar`, {
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
                paginationContainer.innerHTML = '';

                // Verificar si hay datos
                if (data.data && data.data.length > 0) {
                    data.data.forEach(empleado => {
                        const row = document.createElement("tr");

                        row.innerHTML = `
                            <td>${empleado.identification}</td>
                            <td>${empleado.first_name}</td>
                            <td>${empleado.last_name}</td>
                            <td>${empleado.phone}</td>
                            <td>${empleado.email}</td>
                            <td>${empleado.department_name}</td>
                            <td>
                                <div class="flex">
                                    <a class="btn btn-sm btn-primary mr-1" onclick="modalCrear('${empleado.id}', '${empleado.identification}', '${empleado.first_name}', '${empleado.last_name}', '${empleado.phone}', '${empleado.email}', '${empleado.fk_department}')">Editar</a>
                                    <span style="margin-left: 5px;"></span>
                                    <button class="btn btn-sm btn-danger" type="button" onclick="confirmDelete('${empleado.id}', '${empleado.identification}')">Eliminar</button>
                                </div>
                            </td>
                        `;
                        
                        tableBody.appendChild(row);
                    });

                    // Añadir el total de resultados y los enlaces de paginación
                    paginationContainer.innerHTML = `
                        <div class="d-flex justify-content-left align-items-center">
                            <span style="margin-left: 10px;"></span>
                            <div class="text-white">Total Resultados: ${data.total}</div>
                            <span style="margin-left: 10px;"></span> ${data.links}
                        </div>
                    `;
                    paginationContainer.parentNode.appendChild(paginationContainer);

                } else {
                    // Mostrar mensaje si no hay resultados
                    const row = document.createElement("tr");
                    const cell = document.createElement("td");
                    cell.colSpan = 7; // Ajustar el colspan según el número de columnas
                    cell.textContent = "No se encontraron resultados.";
                    row.appendChild(cell);
                    tableBody.appendChild(row);
                    paginationContainer.appendChild(row);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });


    
</script>
