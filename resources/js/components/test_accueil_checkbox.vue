
<template>
    <div>
        {{ success}}
    </div>    
</template>



<script>
export default {
  data() {
    return{
      path: '',       //chemin de fichier inserer par utilisateur.
      success: '', //variable pour donner le resultat de post 
      errors:  [], //variable pour afficher l'erreurs 
    }
  },

  

  mounted() {
    console.log(' .... mounted.')
  }

}
</script>
