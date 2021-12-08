

<template>
    <button class="btn btn-secondary" v-on:click="verify_connection" v-bind:class="{color: color}">Verification</button>
</template>


<script>
export default {

    data(){
        return{
            result: {},
        }
    },

    created() {
        axios.get("http://192.168.141.207:8000/api/connexion")
            .then(response => {this.result = response.data})
            .catch(error => console.log(error))
    },
    
    methods: {
        verify_connection: function(){
            if(this.result.etat == "connected"){
                this.alert(this.result.etat)
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