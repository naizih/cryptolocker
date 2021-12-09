


<template>

    <div class="container pt-4">  
        <h1 class="pt-4">Bienvenue à la Page d'Accueil - Client en Vue.js</h1>

        <!-- verification de  -->
        <hashes-verificaion> </hashes-verificaion>
        
        <div class="card flex-item">
            <div class="card-body">
                <accueil-table> </accueil-table>
            </div>
        </div>
        <!--<page-footer> </page-footer>-->
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