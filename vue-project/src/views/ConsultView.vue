<template>
    <br>
    <div id="group">
        <header>Crear proceso/evento participación cerrada</header>
        <a type="button" class="btn btn-primary" href="/components">Volver</a>
    </div>

    <div id="group">
        <form id="form" action="">
            <hr>
            <div class="row">
                <div class="col-4">
                    <label for="">Descripción:</label><br>
                    <input v-model="filterProcesses.description" class="form-control" type="text">
                </div>

                <div class="col-4">
                    <label for="">Estado:</label><br>
                    <select v-model="filterProcesses.state" class="form-control">
                        <option value="">Selecione</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="PUBLICADO">PUBLICADO</option>
                        <option value="EVALUACIÓN">EVALUACIÓN</option>
                    </select>
                </div>
            </div>

        </form>
    </div>

    <br>

    <div id="group">
        <button type="button" class="btn btn-primary" @click="consult">buscar</button>
        <button type="button" class="btn btn-primary" @click="cleanFields">Limpiar campos</button>
        <button type="button" class="btn btn-success" @click="ReportExcel">Generar Reporte Excel</button>
    </div>

    <br>

    <div id="group">
        <table class="table table-bordered">

            <thead class="thead-dark">
                <tr>
                    <th scope="col">Número de registro</th>
                    <th scope="col">Objetos</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha inicio</th>
                    <th scope="col">Fecha cierre</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(process, key) of processes ? processes : ''">
                    <td>{{ process.id }}</td>
                    <td>{{ process.thing }}</td>
                    <td>{{ process.description }}</td>
                    <td>{{ process.start_date }}</td>
                    <td>{{ process.closing_time }}</td>
                    <td>{{ process.state }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script  lang="ts">
import axios from 'axios';
import exportFromJSON from "export-from-json";

export default {
    data() {
        return {
            // Array que contendra los procesos registrados
            processes: [],
            filterProcesses: []

        }
    },

    methods: {

        // Obtiene los procesos registrados en el sistema
        GetProcesses() {

            // Peticion http encargada de traer los procesos registrados
            axios.get("http://localhost/PHP/ApiRest/process.php").then((result) => {
                this.processes = result.data;
            });
        },

        // Funcion encargada de generar el reporte en excel(esta en proceso)
        ReportExcel() {

            let data: any;

            data = JSON.parse(JSON.stringify(this.processes));

            const formData = new FormData();


            // Object.keys(data).forEach((key: any) => {
            Object.keys(data).forEach((key: any) => {
                console.log("foreach -- ", typeof JSON.stringify(data[key]));

                // Se serializan los objetos que estan dentro de data para que estos puedan ser almacenados en el
                // formData como string para que el valor de estos no se vea afectado a la hora de llegar
                // al lado del servidor
                formData.append(key, JSON.stringify(data[key]))
            })

            axios.post('http://localhost/PHP/ApiRest/db/reporteExcel.php', formData)
                .then((result) => {
                    console.log("RESULT...", result, typeof result);
                    // const url = window.URL.createObjectURL(new Blob([result.data]))
                    // const link = document.createElement('a')
                    // link.href = url
                    // link.setAttribute('download', fileName)
                    // console.log(link);
                    // document.body.appendChild(link)
                    // link.click()
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        // Funcion encargada de realizar la consulta de los filtros de busqueda
        consult() {

            // Se us la funcion filter para filtrar los registros por medio de la indformacion ingresada en los campos de busqueda
            this.processes = this.processes.filter((res) => {
                if (this.filterProcesses.description !== undefined && !this.filterProcesses.state !== undefined) {
                    console.log("entro aca---", res.state == this.filterProcesses.description, res.state == this.filterProcesses.state);
                    return res.state == this.filterProcesses.state && res.description == this.filterProcesses.description
                }
                else if (this.filterProcesses.description !== undefined) {
                    return res.description == this.filterProcesses.description
                }
                else if (this.filterProcesses.state !== undefined) {
                    return res.state == this.filterProcesses.state
                }

            })

        },
        // Funcion encargada de limpiar los campos campos de busqueda y de refrescar el listado de registros
        cleanFields() {
            this.filterProcesses = [];
            this.GetProcesses();
        }

    },

    mounted() {
        // Lista los procesos
        this.GetProcesses();
    },

}

</script>

<style>
#app {
    width: 100%;
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