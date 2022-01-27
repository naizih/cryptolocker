

<template>
 <aside>
            <h3>File Verification</h3>
            <hr>

            {{response}}



        </aside>    
</template>



<script>
//import hash_file from './sync_hash_verify.vue'
export default {
  name : 'sync_hash_verify',
  //props : ['list_fichier', 'getResult'],



  data() {
    return{
      response: '',

    }
  },
  async created() {
    axios.get('/bash1').then(response => this.response = response.data);
  },


  mounted(){
    console.log('sync-hashes-verify component mounted')
    
  }

}
</script>



<style>
aside {
  width: 20%;
  padding-left: 15px;
  margin-left: 15px;
  float: right;
  font-style: italic;
  background-color: lightgray;
}
</style>