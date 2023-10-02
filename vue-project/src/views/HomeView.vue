<script setup lang="ts">
import '../assets/base.css';

</script>

<template>
    <br>
    <div id="panel">
        <div id="titleMod">
            <h4>Procesos/Eventos</h4>
        </div>
    </div>
    <div id="buttonAcc">
        <a href="/components">Acceder</a>
    </div>
</template>

<style>
#panel {
    align-self: center;
    font-weight: normal;
    width: 400px;
    height: 200px;
    margin-top: auto;
    margin-bottom: auto;
    background-color: rgb(95, 95, 156);

}

a {
    outline: none;
    text-decoration: none;
    color: white;
}

a:focus {
    border-bottom: 1px solid;
    background: rgb(71, 82, 243);
}

a:hover {
    border-bottom: 1px solid;
    background: rgb(71, 82, 243);
}

#buttonAcc:active {
    background: rgb(71, 82, 243);
    color: rgb(71, 82, 243);
}

#buttonAcc {
    text-align: center;
    padding: 15px;
    background-color: rgb(66, 66, 156);
}

#titleMod {
    text-align: left;
    padding: 50px 20px 50px;
    color: white;
}

#h4 {
    color: white;
}
</style>

