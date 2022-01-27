<template>
    <div class="accueiltable">
        <!-- tous les button en haut de la table pour checker, supprimer et ajouter un chemin -->
        
        <!-- si le hash n'est pas changer arés cliquant le button chequer afficher ce message-->
        <div class="alert alert-success" v-if="check_success">
            {{check_success}}
        </div>
        <div class="alert alert-danger" v-if="error">
            {{error}}
        </div>

        <div class="alert alert-success" v-if="success">
            {{success}}
        </div>

        <div class="btn-toolbar">
            <div class="btn-group me-1">
                <ajouter-fichier v-bind:revele="revele" v-bind:toggleModale="toggleModale"> </ajouter-fichier>
                <div v-on:click="toggleModale" class="btn btn-primary">Ajouter le fichier</div>
            </div>
            <div class="btn-group me-1">
                <button class="btn btn-danger" v-on:click="multiple_delete" >Supprimer</button>
            </div>
            <div class="btn-group me-1">
                <verification-de-connexion> </verification-de-connexion>
            </div>
            <div class="btn-group me-2">
                <button class="btn btn-secondary" v-on:click="checker">Checker</button>
            </div>
        </div>


        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <!-- columns de checkbow avec un option de selectioner tous.-->
                    <th class="select-all">
                        <input type="checkbox" @click="select_all_via_check_box" v-model="all_select"> 
                        <span> {{ all_select == true ? 'Uncheck All' : "Select All" }} </span>
                    </th>
                    <th scope="col">N°</th>
                    <th scope="col">Nom de fichier</th>
                    <th scope="col">Chemin</th>
                    <th scope="col">Hash</th>
                    <th scope="col">Date de creation</th>
                    <!--<th scope="col">Delete</th>-->
                </tr>
            </thead>
            <tbody >
                <tr v-for="hash_fichier, index of list_fichier" :key="hash_fichier.id">
                    <td> <input type="checkbox" id="checkbox" v-bind:value="hash_fichier.id" v-model="checked_box"> </td> 
                    <td>{{index+1}}</td>
                    <td>{{hash_fichier.nom_de_fichier}}</td>
                    <td>{{hash_fichier.Chemin_de_fichier}}</td>
                    <!--<td v-bind:class="{ 'text-danger' : color }">{{hash_fichier.Hash_de_fichier}}</td>-->
                    <td>{{hash_fichier.Hash_de_fichier}}</td>
                    <td>{{hash_fichier.created_at}}</td>
                    <!--<td><button class="btn btn-lg btn-danger" v-on:click="supprimer_une_ligne(hash_fichier.id)"><i class="fa fa-trash-o red-color"></i></button></td>-->
                </tr>
            </tbody>
        </table>

    </div>
</template>





<script>
import Modale from './Modale'
import verification from './verification_de_connexion.vue'

export default{
    name: 'Contenu',
    components: {
        'ajouter-fichier': Modale,
        'verification-de-connexion': verification 
    },
    data() {
        return {
            list_fichier : {},  //un dictionaire pour ajouter tous les données qui sont recuperer de la base de donnéés.
            checked_box: [],  // un tableu pour sauvgarder (ajouter) tous les checkbox qui sont selecter.
            all_select : false,     // variable pour verifée si tous les checkbox sont selectioner ou pas
            revele: false,          // variable pour disparaitre le fentre de Modale ( ajouter nouveau fichier)
            resultat_check: [],     //variable pour afficher le rsultat de button check
            check_success: '',      //variable pour retourner le resultat de check si il n'y a aucune modificaion
            error: '',   // afficher un message si on clique sur button supprimer et aucune case a été selectioner.
            success: '',   // affichier les message de success d'un actions


        }
    },
    methods: {
        toggleModale: function() {
            this.revele = !this.revele
            this.$forceUpdate();  
        },
        
        //checker
        checker(){
            
            var longeur = this.list_fichier.length;  // variable pour recuperer la longeur de tableau.
            var lien_de_fichiers = [];  //variable pour stoker le lien de tous les fichier.
            var nom_de_fichier  = [];   // noms de tous les fichiers
            var id = [];                //ID de tous les hash sauvgardé
            let currentObj = this;      //

            // boucle for pour recuperier l'information nécessaire à partir des donées de la base de données qui sont affichier dans la tableau
            for(var i = 0; i < longeur; i++){
                var identifiant = this.list_fichier[i].id;              // sauvgarde l'ID de chaque ligne de la tableau
                var chemin = this.list_fichier[i].Chemin_de_fichier;    // sauvgarde les chemin de chasue ligne de la tableau afficher dans un tableau (array) 
                var name = this.list_fichier[i].nom_de_fichier;         

                // ajout le id,nom,chemin de chaque ligne à la variable correspondance.
                id.push(identifiant);
                nom_de_fichier.push(name);
                lien_de_fichiers.push(chemin+'/'+name)
            }

            // crée un form et ajouter les valeur dans ce form
            let fd = new FormData();
            fd.append('id', id);
            fd.append('name', nom_de_fichier);  
            fd.append('path', lien_de_fichiers);


            //  Methode POST
            axios.post('/check', fd)
            .then( response =>{
                currentObj.resultat_check = response.data.hash_result;     //  associer les donnée à variable success. 

                //verification si il n'y a pas un erreur de hash
                if (this.resultat_check == ''){
                   this.check_success = 'Aucune fichier a été modifiée'
                }else{
                    var tableau = [];       // variable local pour sauvgarder les hash modifiée de tous les fichiers
                    //boucle for pour ajouter les hash modifiée dans le tableau local en ensuit affichier.
                    for (let index = 0; index < this.resultat_check.length; index++) {
                        tableau.push(this.resultat_check[index]);
                        //alert("hash de fichier suivant est modifié" + this.resultat_check[index]);
                    }
                    alert("hash de fichier suivant est modifié" + tableau);     //afficher l'alert en cas de modification de hash
                    //this.error = tableau;     // pour afficher le message dans en tete de tableau
                }
            })
            .catch( error => {  //  condition si il y a eu un erreur
                currentObj.error = error;
            })
        },

        
        //supprimer une ligne de la table
        supprimer_une_ligne(id) {
            if (confirm('Etes vous sue de supprimer ?')){
                axios.delete('/supprimer/'+ id)
                    .then( response => { 
                        this.success = response.data.response 
                        //window.location.reload();
                    })
                    .catch( error => {
                        console.log(error)
                    });
            }
        },


        //importer les donées depuis la base de données.
        getResult() {
            axios.get('/table-fichier')
                .then(response => {this.list_fichier = response.data.fichiers_hash})
                .catch(error => { console.log(error)});
        },
        

        // fonction pour supprimer multiple ligne de tableau en meme temps.
        multiple_delete(){
            if (this.checked_box.length){
                axios.delete('/supprimer_multiple/', {params: {'id': this.checked_box}})
                .then( response => { 
                    this.getResult();        // rappeler à la fonction gethashfile
                    //window.location.reload();
                    this.error = '';     // remis a zero le variable pour enlever l'affichage de message apres cocher une casse
                    this.success = response.data.response;
                })
            }else{
                this.error = "Aucune coche est selectioner, pour supprimer, cochez une case s'il vous plait!"
            }
        },


        //fonction qui donne vrai quand on selectione tous les lignes
        select_all_via_check_box(){
            if(this.all_select == false){
                this.all_select = true
                this.list_fichier.forEach(user => {
                    this.checked_box.push(user.id)
                });
            }else{
                this.all_select = false
                this.checked_box = []
            }
        },

    },  // fin de methods


    //crée
    created() {
        this.getResult();
    },

    // fonction par default dans la vue.js, qui donne l'information quand la page s'actuallise
    mounted() {
        console.log('acuueil table  mounted.')
    }
}
</script>



<style scoped>

.accueiltable{
    z-index: 1;
}

.select-all{
    width: 130px;
}
</style>