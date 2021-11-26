


<template>
    <div class="accueiltable">
        <h1>Bienvenue à la Page d'Accueil - Client en Vue.js</h1>
       
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="30%">
                        <input type="checkbox" @click="select_all_via_check_box" v-model="all_select"> 
                        <span> {{ all_select == true ? 'Uncheck All' : "Select All" }} </span>
                    </th>
                    <th scope="col">N°</th>
                    <th scope="col">Nom de fichier</th>
                    <th scope="col">Chemin</th>
                    <th scope="col">Hash</th>
                    <th scope="col">Date de creation</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="hash_fichier of list_fichier">
                    <td>
                        <input type="checkbox" id="checkbox" v-bind:value="hash_fichier.id" v-model="checked_box">
                    </td>
                    <td>{{hash_fichier.id}}</td>
                    <td>{{hash_fichier.nom_de_fichier}}</td>
                    <td>{{hash_fichier.Chemin_de_fichier}}</td>
                    <td>{{hash_fichier.Hash_de_fichier}}</td>
                    <td>{{hash_fichier.created_at}}</td>
                </tr>
            </tbody>
        </table>

        <!-- tous les button en fin de la table pour checker, supprimer et ajouter un chemin -->
        <div>
            <form submit="supprime_HashFichier">
                <button class="btn btn-primary">Ajouter</button>
                <input type="submit" value="Supprimer" class="btn btn-danger">

                <button class="btn btn-success">verification</button>
                <button class="btn btn-secondary">Checker</button>
            </form>
        </div>


        <hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
        </div>



</template>

<script>
export default{
    data() {
        return {
            list_fichier : {},  //un dictionaire pour ajouter tous les données qui sont recuperer de la base de donnéés.
            checked_box: [],  // un tableu pour sauvgarder (ajouter) tous les box qui sont selecter.
            all_select : false,
        }
    },
    methods: {
        getHashFiles() {
            axios.get('http://192.168.56.200:8000/table-fichier')
                .then(response => {this.list_fichier = response.data.fichiers_hash})
                .catch(error => { console.log(error)});
        },
        supprime_HashFichier() {
            axios.post('/supprimer')
                .then((response) => { 
                    this.getHashFiles();
                    this.checked_box = []
                    this.all_select == true ? 
                            this.all_select = false : this.all_select = true;
            })
        },
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

    },
    /*
    methods: {
        BoxChecked(id){
            if(id in this.checked_box){
                this.checked_box.splice(id);
            }else{
                this.checked_box.push(id);
            }
        }
    },
    */

    //crée
    created() {
        this.getHashFiles();
    },
    mounted() {
        console.log('acuueil table  mounted.')
    }
}
</script>
