
<template>    
    <div class="bloc-modale" v-if="revele">
        <div class="overlay" v-on:click="toggleModale"></div>
        <div class="modale card">
            <!--<div class="btn-modale btn btn-danger" v-on:click="toggleModale">X</div>-->
            <h2>Ajouter le chemin</h2>

            <div class="space">
                <input type="text" name="" id="" v-model="file">
            </div>
            <div class="login_footer">
                <button type="primary">Submit</button>
            </div>



            <form action="/fichier-appat" method="post">
            <input type="hidden" name="_token" :value="csrf">

            <!--
                <label for="fichierappat" class="btn btn-secondary">Ajouter</label>
                <input type="file" style="visibility:hidden;" name="fichierappat" id="fichierappat">
            -->    
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choisir un fichier appat</label>
                    <input class="form-control" type="file" id="formFile" name="fichier">
                </div>
                <button class="btn btn-danger" v-on:click="toggleModale"> Cancel </button>
                <input type="submit" value="Ajouter" class="btn btn-success">
            </form>
        </div>
    </div>

</template>



<script>
window.CSRF_TOKEN = '{{ csrf_token() }}';
export default {
    name: 'Modale',
    props: ['revele', 'toggleModale'],
    
    data() {
        return{
            file: '' 
        }
        //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        //errors: [],
        //fichier: null
    },
    /*
    methods:{
        checkForm: function (e) {
            if (this.fichier){
                return true
            }
            this.errors = [];
            if (!this.fichier) {
                this.errors.push('Fichier requis.');
            }
            e.preventDefault();
        }
    }
    */

}
</script>



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