<template>
    <br>

    <div id="group">
        <header>Crear proceso/evento participación cerrada</header>
        <a href="/components" class="btn btn-primary">Volver</a>
    </div>

    <!-- <div id="group">

        <ul class="navbar-nav">

            <li class="nav-item active">
                <a class="nav-link active" href="/">Información basica</a>
                <a class="nav-link active" href="/schedule">Cronograma</a>
            </li>

        </ul>
    </div> -->

    <div id="group">
        <form id="form" @submit.prevent="sendInformation()">

            <hr>

            <div class="row">
                <div class="col-6">
                    <label>Objeto:</label><br>
                    <input v-model="data.thing" class="form-control" type="text">
                </div>

                <div class="col-6">
                    <label>Actividad:</label><br>
                    <input v-model="data.activity" class="form-control" type="text">
                </div>
            </div>

            <br>

            <div class="row">

                <div class="col-6">
                    <label for="description">Descripción/Alcance:</label><br>
                    <textarea v-model="data.description" class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-6">
                    <label>Moneda:</label><br>
                    <select v-model="data.currency" class="form-control">
                        <option value="">Selecione</option>
                        <option value="COP">COP</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                    </select>
                </div>

                <div class="col-6">
                    <label>Presupuesto:</label><br>
                    <input v-model="data.budget" class="form-control" type="number">
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label for="">Fecha de inicio:</label><br>
                    <input v-model="data.start_date" class="form-control" type="date">
                </div>

                <div class="col-6">
                    <label for="">Hora de inicio:</label><br>
                    <input v-model="data.star_time" class="form-control" type="time">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-6">
                    <label for="">Fecha de cierre:</label><br>
                    <input v-model="data.deadline" class="form-control" type="date">
                </div>

                <div class="col-6">
                    <label for="">Hora de cierre:</label><br>
                    <input v-model="data.closing_time" class="form-control" type="time">
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12 ">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
            <br>

        </form>
    </div>
</template>

<script  setup lang="ts">
import axios from 'axios';
import Swal from 'sweetalert2';

let data: any = {};

function sendInformation(): void {

    const formData = new FormData();

    // Recorremos el objeto data el cual contiene todos los datos del formulario,
    // se recorre para añadir cada dato que este contiene al formData para mandarlo de
    //  esta manera al lado del servidor
    Object.keys(data).forEach((key: any) => {
        formData.append(key, data[key])
    })

    // Peticion que se realiza al servidor del back para registrar los datos en la base de datos
    axios.post('http://localhost/PHP/ApiRest/process.php', formData)
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Registro guardado con exito',
                showConfirmButton: false,
                timer: 1000
            })

            setTimeout(() => {
                window.location.href = '/consult';
            }, 1500);

        })
        .catch(function (error) {
            console.log(error);
        });

}

</script>

<style>
#app {
    width: 90%;
}

#form {
    width: 100%;
}

#group {
    width: 100%;
    margin: auto;
    padding: auto;
    width: 60%;
    justify-content: space-between;
    display: flex;

}
</style>