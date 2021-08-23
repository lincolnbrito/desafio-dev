<template>
  <form @submit.prevent="upload" class="bg-gray-300 p-4 rounded mt-4 w-1/2">
    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/> <br><br>
    <button type="submit" class="btn btn-primary" v-if="file">Enviar Arquivo</button>
  </form>
</template>

<script>
import ImporService from '@/services/import'

export default {
  data() {
    return {
      file: null,
    }
  },
  methods: {
    handleFileUpload(){
      this.file = this.$refs.file.files[0];
    },
    async upload() {
      let formData = new FormData();
      formData.append('file', this.file);

      try{
        await ImporService.post(formData);

        this.form.file = null;
      } catch (e) {
        console.log(e)

      }
    }
  }
}
</script>