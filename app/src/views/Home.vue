<template>
  <div class="home">
    <h1>Resumo</h1>
    <StoreList :stores="stores"/>
  </div>
</template>

<script>
import StoreList from '@/components/StoreList.vue'
import StoreService from '@/services/store'

export default {
  data() {
     return {
       stores: []
     }
  },
  methods: {
    async load() {
      try{
        let response = await StoreService.list()
        this.stores = response.data.data
      } catch(e) {
        console.log(e);
      }
    }
  },
  mounted() {
    this.load()
  },
  components: {
    StoreList
  },
}
</script>
