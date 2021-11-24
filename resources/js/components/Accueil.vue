


<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.

                        
                        <hr>

                            <button v-on:click="verify_connection" class="btn btn-success">Verification</button>

                            <button class="btn btn-danger">Supprimer</button>

                            <button class="btn btn-success">Checker</button>

<br><br>
                            <form action="/fichier-appat" method="post">
                                <label for="fichierappat" class="btn btn-secondary">Ajouter</label>
                                <input type="file" style="visibility:hidden;" name="fichierappat" id="fichierappat">
                            </form>

                        <button v-on:click="submitFile()">Submit</button>







<!--add a pop up windows -->










                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
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
                    this.$alert(this.result.etat)
                }else{
                    alert("Not connected")
                }
            }
               
        },

        mounted() {
            console.log('Component mounted.')
        }

    }
</script>