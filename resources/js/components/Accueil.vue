


<template>

    
    <div class="container">        
        <div class="card">
            <div class="card-header">Operation</div>
            <div class="card-body">
            
                <modale v-bind:revele="revele" v-bind:toggleModale="toggleModale"> </modale>
                <div v-on:click="toggleModale" class="btn btn-success">Ajouter le fichier</div>
        
                <button class="btn btn-danger">Supprimer</button>
                <button class="btn btn-success">Checker</button>
                <button v-on:click="verify_connection" class="btn btn-success">Verification</button>
<!--
                            <form action="/fichier-appat" method="post">

                                <label for="fichierappat" class="btn btn-secondary">Ajouter</label>
                                <input type="file" style="visibility:hidden;" name="fichierappat" id="fichierappat">
                                <p></p>
                                <button class="btn btn-secondary"> submit </button>
                            </form>
-->

<!--add a pop up windows -->



            </div>
        </div>
    </div>  
</template>

<script>
    import Modale from './Modale'
    export default {
        name: 'Contenu',
        components: {
            'modale': Modale
        },

        data() {
            return{
                result: {},
                revele: false
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
                    this.$alert(this.result.etat)
                }else{
                    alert("Not connected")
                }
            },

            toggleModale: function() {
                this.revele = !this.revele

            }
               
        },

        mounted() {
            console.log('Component mounted.')
        }

    }
</script>