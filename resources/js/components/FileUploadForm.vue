


<form @submit="checkForm" action="/something" method="post">
  
  <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
  
  <p>
    <label for="name">Fichier<label>
    <input type="file" name="file" id="file" v-model="name">
  </p>

  <p>
    <input type="submit" value="Submit">  
  </p>
</form>



<script>
export default {

    data: {
        errors: [],
        name: null,
    },
    methods: {
        checkForm: function (e) {
            this.errors = [];

            if (!this.name) {
                this.errors.push("Name required.");
            }

            if (!this.errors.length) {
                return true;
            }

            e.preventDefault();
        },
    },

    mounted() {
        console.log('Component mounted.')
    }
}
</script>
