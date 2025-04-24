<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        h2 {
            color: #0d6efd;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="mb-4 text-center">📝 Registro de Paciente</h2>

        <div id="alerta" style="display:none;" class="alert" role="alert"></div>

        <form id="formPaciente">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="CUI" class="form-label">CUI</label>
                    <input type="text" class="form-control" id="CUI" placeholder="1234 56789 0123" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="primerNombre" class="form-label">Primer Nombre</label>
                    <input type="text" class="form-control" id="primerNombre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="primerApellido" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" id="primerApellido" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select class="form-select" id="sexo" required>
                        <option value="">Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="peso" class="form-label">Peso (kg)</label>
                    <input type="number" class="form-control" id="peso" required>
                </div>
                <div class="col-md-9 mb-3">
                    <label for="lugarVivienda" class="form-label">Lugar de Vivienda</label>
                    <input type="text" class="form-control" id="lugarVivienda" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="famiEnCadep" class="form-label">Familiar en CADEP</label>
                    <select class="form-select" id="famiEnCadep" required>
                        <option value="Sí">Sí</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="MotivoConsulta" class="form-label">Motivo de Consulta</label>
                    <textarea class="form-control" id="MotivoConsulta" rows="3" required></textarea>
                </div>
            </div>
            
                <button type="submit" class="btn btn-primary">Registrar</button>
            

        </form>
    </div>
</div>

<script>
const alerta = document.getElementById('alerta');

document.getElementById('formPaciente').addEventListener('submit', async function (e) {
    e.preventDefault();

    const data = {
        CUI: document.getElementById('CUI').value.trim(),
        primerNombre: document.getElementById('primerNombre').value.trim(),
        primerApellido: document.getElementById('primerApellido').value.trim(),
        fechaNacimiento: document.getElementById('fechaNacimiento').value,
        edad: parseInt(document.getElementById('edad').value),
        sexo: document.getElementById('sexo').value,
        telefono: document.getElementById('telefono').value.trim(),
        direccion: document.getElementById('direccion').value.trim(),
        peso: parseFloat(document.getElementById('peso').value),
        lugarVivienda: document.getElementById('lugarVivienda').value.trim(),
        famiEnCadep: document.getElementById('famiEnCadep').value,
        MotivoConsulta: document.getElementById('MotivoConsulta').value.trim(),
        id_Departamento: 1,
        id_Municipio: 1,
        id_Religion: 1,
        id_Escolaridad: 1,
        id_EstadoCivil: 1,
        FechaCreacion: new Date().toISOString().split('T')[0],
        UsuarioCreacion: "frontend_test"
    };

    try {
        const res = await fetch('http://localhost/apisistemas/backend/endpoints/paciente/paciente.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await res.json();
        alerta.className = 'alert alert-success';
        alerta.innerText = result.results || 'Paciente registrado exitosamente';
        alerta.style.display = 'block';
        document.getElementById('formPaciente').reset();
    } catch (error) {
        alerta.className = 'alert alert-danger';
        alerta.innerText = 'Error al registrar paciente. Intente nuevamente.';
        alerta.style.display = 'block';
        console.error(error);
    }
});
</script>

</body>
</html>
