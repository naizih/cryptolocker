
<template>    
    <div class="bloc-modale" v-if="revele">
        <div class="overlay" v-on:click="toggleModale"></div>
        <div class="modale card">
            <h2> Upload </h2>
            <!--<div v-if="success != ''" class="alert alert-success" role="alert">
                {{success}}
            </div>-->

            <div v-if="errors.length" class="alert alert-danger">
                <ul>
                    <li v-for="error in errors" :key="error"> {{error}} </li>
                </ul>

            </div>
        
            <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                <div class="mb-3 pt-3">
                    <label for="forpath" class="form-label">Copie la Chemin de fichier</label>
                    <input class="form-control" type="text" id="forpath" name="path" v-model="path">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choisir un fichier appat</label>
                    <input class="form-control" type="file" id="formFile" name="file" v-on:change="onFileChange">
                </div>
                <button class="btn btn-success">Ajouter</button>
                <button class="btn btn-danger" v-on:click="toggleModale"> Cancel </button>
            </form>
        </div>
    </div>
</template>



<script>
export default {
    name: 'Modale',
    props: ['revele', 'toggleModale'],


    data() {
        return{
            path: '',       //chemin de fichier inserer par utilisateur.
            fichier: null, //variable to get file 
            success: '', //variable pour donner le resultat de post 
            errors:  [], //variable pour afficher l'erreurs 
        }
    },

    methods: {
        
        onFileChange(event){
            console.log(event.target.files[0]);
            this.fichier = event.target.files[0];
        },

        //fonction pour soumettre la form
        formSubmit(){
            this.errors = [];
            
            // condition à verifiée si les inputs sont vide (empty).
            // Afficher l'erreur si input text est vide ou pas.
            if (!this.path){
                this.errors.push("path is required!")
            }
            // Afficher l'erreur si la input upload est vide, 
            if(!this.fichier){
                this.errors.push("file is required");
            }

            let currentObj = this; //variable pour ne pas ecrire chaque fois this on le remplace avec un variable qui est plus parlant.
            
            // pass le header mais c'est pas nécessaire.
            const config = {
                Headers: {'content-type': 'multipart/form-data'}
            }

            // si les entrée ne sont pas vide 
            if (this.path && this.fichier) {
                let fd = new FormData();    //declaration de variable fd come formdata
                //var file = document.getElementById('formFile').files[0];
                fd.append('file', this.fichier);    // Ajouter une entree dans le tableau fd la key c'est file et value c'est la variable fichier qui est declaré dans data(). 
                fd.append('path', this.path);       // Ajouter une entree file path le tableau fd
            
                //  Methode POST
                axios.post('/ajouter-nouveau-fichier', fd)
                .then( response =>{ 
                    //console.log(response);
                    currentObj.success = response.data      //  associer les donnée à variable success. 
                    //window.location.href = '/';
                })
                .catch( error => {  //  condition si il y a eu un erreur
                    currentObj.errors = error;
                })
            }
        }
    },

    mounted() {
        console.log('composant modale a monté.')
    }
}
</script>



<!-- CSS  -->
<style scoped>

    .bloc-modale{
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }

    .overlay{
        background: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .modale {
        background: #f1f1f1;
        color: #333;
        padding: 50px;
        position: fixed;
        top: 30%;
        border-radius: 10px;
    }

    .btn-modale {
        position: absolute;
        top: 10px;
        right: 10px;
    }

</style>