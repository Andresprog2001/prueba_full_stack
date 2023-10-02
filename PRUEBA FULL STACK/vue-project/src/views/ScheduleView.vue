<template>
    <div id="group">
        <ul class="navbar-nav">

            <li class="nav-item active">
                <a class="nav-link active" href="/">Información basica</a>
                <a class="nav-link active" href="/about">Cronograma</a>
            </li>

        </ul>
    </div>

    <div id="group">

        <form id="form" @submit.prevent="sendInformation">

            <div class="row">
                <div class="col-6">
                    <label for="">Fecha de inicio:</label><br>
                    <input class="form-control" type="date">
                </div>

                <div class="col-6">
                    <label for="">Hora de inicio:</label><br>
                    <input class="form-control" type="time">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-6">
                    <label for="">Fecha de cierre:</label><br>
                    <input class="form-control" type="date">
                </div>

                <div class="col-6">
                    <label for="">Hora de cierre:</label><br>
                    <input class="form-control" type="time">
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12 ">
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
            </div>

        </form>

    </div>
</template>

<script setup lang="ts">
function sendInformation(): void {

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
