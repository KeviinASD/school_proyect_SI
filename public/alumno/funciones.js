
    document.addEventListener("DOMContentLoaded", function() {
        let boton = document.getElementById("btnBuscar");
        boton.addEventListener("click", traerDatos);
        function traerDatos() {
            console.log('si');
            let dni = document.getElementById("dni").value;
            let apiKey = "53e67e6cea17c3b1c1c4140e6e4c43cb489f48f1d3923dbe5546eacea85becc8";
            let url = `https://apiperu.dev/api/dni/${dni}?api_token=${apiKey}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error en la solicitud");
                    }
                    return response.json();
                })
                .then(datos => {
                    if (datos.success) {
                        document.getElementById("doc").value = datos.data.numero;
                        document.getElementById("nombres").value = datos.data.nombres;
                        document.getElementById("apellidos").value = `${datos.data.apellido_paterno} ${datos.data.apellido_materno}`;
                        //document.getElementById("cui").value = datos.data.codigo_verificacion;
                    } else {
                        alert("No se encontraron datos para el DNI proporcionado.");
                    }
                })
                .catch(error => {
                    console.error("Error al obtener los datos del DNI:", error);
                });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const paisSelect = document.getElementById('pais');
        const departamentoSelect = document.getElementById('departamento');
        const provinciaSelect = document.getElementById('provincia');
        const distritoSelect = document.getElementById('distrito');
        const countriesUrl = "{{ route('countries') }}";

        // Cargar países
        fetch('/countries')
            .then(response => response.json())
            .then(paises => {
                paises.sort((a, b) => a.countryName.localeCompare(b.countryName));
                paises.forEach(pais => {
                    const option = document.createElement('option');
                    option.value = pais.geonameId;
                    option.textContent = pais.countryName;
                    paisSelect.appendChild(option);
                });

            })
            .catch(error => console.error('Error fetching countries:', error));

            

        // Evento para cargar departamentos
        paisSelect.addEventListener('change', function() {
            const countryId = this.value;
            if (countryId) {
                fetch(`/departamentos/${countryId}`)
                    .then(response => response.json())
                    .then(departamentos => {
                        departamentoSelect.innerHTML = '<option value="">Seleccionar Departamento</option>';
                        departamentos.forEach(depto => {
                            const option = document.createElement('option');
                            option.value = depto.geonameId;
                            option.textContent = depto.name;
                            departamentoSelect.appendChild(option);
                        });
                        provinciaSelect.innerHTML = '<option value="">Seleccionar Provincia</option>';
                        distritoSelect.innerHTML = '<option value="">Seleccionar Distrito</option>';
                    })
                    .catch(error => console.error('Error fetching departamentos:', error));
            }
        });

        // Evento para cargar provincias
        departamentoSelect.addEventListener('change', function() {
            const geonameId = this.value;
            if (geonameId) {
                fetch(`/provincias/${geonameId}`)
                    .then(response => response.json())
                    .then(provincias => {
                        provinciaSelect.innerHTML = '<option value="">Seleccionar Provincia</option>';
                        provincias.forEach(prov => {
                            const option = document.createElement('option');
                            option.value = prov.geonameId;
                            option.textContent = prov.name;
                            provinciaSelect.appendChild(option);
                        });
                        distritoSelect.innerHTML = '<option value="">Seleccionar Distrito</option>';
                    })
                    .catch(error => console.error('Error fetching provincias:', error));
            }
        });

        // Evento para cargar distritos
        provinciaSelect.addEventListener('change', function() {
            const geonameId = this.value;
            if (geonameId) {
                fetch(`/distritos/${geonameId}`)
                    .then(response => response.json())
                    .then(distritos => {
                        distritoSelect.innerHTML = '<option value="">Seleccionar Distrito</option>';
                        distritos.forEach(dist => {
                            const option = document.createElement('option');
                            option.value = dist.geonameId;
                            option.textContent = dist.name;
                            distritoSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching distritos:', error));
            }
        });
    });
