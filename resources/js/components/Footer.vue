


<template>
    <div class="card-footer text-muted card flex-item">
        <div class="jumbotron">
            <h2 class="display-8">Bonjour Monsieur. ((client name))</h2>
            <p class="lead"> Information de client </p>
            <hr class="my-4">
            
            <div v-if="errors_client.length" class="alert alert-danger">
                <ul>
                    <li v-for="error in errors_client" :key="error"> {{error}} </li>
                    </ul>
            </div>
<!--
            /* pour afficher les erreur de validation des données coté */
            <div v-if="errors_server.length && !errors_client.length" class="alert alert-danger">
                <ul v-for="error in errors_server" :key="error">
                    <li v-if="error['mobile']"> {{error['mobile']}}</li>
                    <li v-if="error['email']"> {{error['email']}}</li>
                
                </ul>
            </div>
-->

            <p>on affiche les informationd de client à partir de base de données</p>
            
            <!-- class pour tous les input-->
            <form @submit.prevent="formSubmit" method="POST">
            <div class="input_style">
                <div class="form-group row">
                    <label for="inputCompany" class="col-sm-2 col-form-label"> <i class="fa fa-building"></i> &nbsp; Company Name :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nom_entreprise" id="inputCompany" placeholder="Company name" v-model="nom_entreprise" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label"> <i class="fa fa-user-circle"></i> &nbsp; Client Name :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nom_client" id="inputName" placeholder="Cleint name" v-model="nom_client">
                    </div>
                </div>

                <!-- add Bootstrap .has-error if title field has errors -->
                <div class="form-group row">
                    <label for="inputMobile" class="col-sm-2 col-form-label"> <i class="fa fa-phone"></i> &nbsp; Mobile N° :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="mobile"  id="inputMobile" placeholder="Mobile number" v-model="mobile">
                        <!--<small class="alert-danger" v-for="error in errors_server" :key="error">{{ error['mobile']}} </small>-->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label"><i class="fa fa-envelope"></i> &nbsp; Email Adresse :</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email @" v-model="email">
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <div class="me-2">
                    <button class="btn btn-secondary">Submit</button>
                </div>
                <div class="me-2">
                    <button class="btn btn-secondary">dd</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>


<script>

export default {
    name: 'Footer',


    data(){
        return{
            nom_entreprise : 'khan',
            nom_client: 'jan',
            mobile: '0',
            email: 'khan@gmail.com',
            errors_client: [],      //verification des données coté client.
            errors_server: [],      //verification des données coté serveur.
            success: '',            // resultat de success
        }
    },

    methods: {
        formSubmit(){
            this.errors_client = [];
       
            // condition à verifiée si les inputs sont vide (empty).
            // Afficher l'erreur si input text est vide ou pas.
            if (!this.nom_entreprise){
                this.errors_client.push("Nom d'entreprise est required!")
            }
            // Afficher l'erreur si la nom de client est vide, 
            if(!this.nom_client){
                this.errors_client.push("Nom de client est requis!");
            }
            // Afficher l'erreur si la numero de mobile n'est pas entrée. 
            if(!this.mobile){
                this.errors_client.push("Numéro de mobile est requis!");
            }
            // Afficher l'erreur si email est vide, 
            if(!this.email){
                this.errors_client.push("Email adresse est requis!");
            }

    

            let currentObj = this;


            // si les entrée ne sont pas vide 
            if (this.nom_entreprise && this.nom_client && this.mobile && this.email) {

                this.errors_client = [];    // vider la variable erreur.
                this.errors_server = [];    // decalrer le tableau
                let fd = new FormData();    //declaration de variable formdata comme fd

                fd.append('nom_entreprise', this.nom_entreprise_model);    // Ajouter une entree dans le tableau fd la key c'est file et value c'est la variable fichier qui est declaré dans data(). 
                fd.append('nom_client', this.nom_client_model);       // Ajouter une entree file path le tableau fd
                fd.append('mobile', this.mobile_model);       // Ajouter une entree file path le tableau fd
                fd.append('email', this.email_model);       // Ajouter une entree file path le tableau fd
            
                //  Methode POST
                axios.post('/ajouter-client', fd)
                .then( response =>{ 
                    console.log(response);
                    currentObj.success = response.data      //  associer les donnée à variable success. 
                    //window.location.href = '/';
                })
                .catch( error  => {  //  condition si il y a eu un erreur
                    //currentObj.errors.push(error);
                    console.log(error.response.data.errors);
                    //this.error_mobile = error.response.data.errors.mobile;
                    //currentObj.errors_server.push(error.response.data.errors);
                    this.errors_server.push(error.response.data.errors);
                })
            }
        },
    },
    mounted() {
        console.log("footer mounted");
    }
    
}
</script>



<style scoped>


.input_style .row {
    padding: 2px;
}


</style>