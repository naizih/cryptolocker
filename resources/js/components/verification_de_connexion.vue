

<template>
    <button class="btn btn-secondary" v-on:click="verify_connection" v-bind:class="{color: color}">Verification</button>
</template>


<script>
export default {

    data(){
        return{
            result: {},     // variable pour recupérier les données de API
        }
    },

    created() {
        axios.get("http://192.168.56.100:8000/api/connexion")
            .then(response => {this.result = response.data})
            .catch(error => console.log(error))
    },
    
    methods: {
        verify_connection: function(){
            if(this.result.etat == "connected"){
                alert(this.result.etat) 
            }else{
                alert("Not connected")
            }
        }
    },

    mounted() {
        console.log('composant de verification de connexion monté.')
    }
}

</script>




<style scoped>

</style>