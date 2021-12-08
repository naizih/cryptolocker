


<template>

    <div class="container">  
        <h1 class="pt-4">Bienvenue à la Page d'Accueil - Client en Vue.js</h1>
        
        <hashes-verificaion> </hashes-verificaion>
        
        <div class="card flex-item">
            <div class="card-body">
                <accueil-table> </accueil-table>

            <!--
                <modale v-bind:revele="revele" v-bind:toggleModale="toggleModale"> </modale>
                <div v-on:click="toggleModale" class="btn btn-success">Ajouter le fichier</div>
            -->
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
        <page-footer> </page-footer>
    </div>  
</template>

<script>
    //import Modale from './Modale'
    import accueiltable from './AccueilTable.vue'
    import footer from './Footer.vue'
    import infiniteLoop from './sync_hash_verify.vue'

    export default {
        name: 'Contenu',
        components: {
            //'modale': Modale,
            'accueil-table': accueiltable,
            'page-footer': footer,
            'hashes-verificaion': infiniteLoop,
        },

        data() {
            return{
                result: {},
                revele: false
            }
        },
        created() {
           
        },
        methods: {
            toggleModale: function() {
                this.revele = !this.revele

            }
               
        },

        mounted() {
            console.log('Accueil Component mounted.')
        }

    }
</script>



<style scoped>


</style>