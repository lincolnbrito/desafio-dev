<template>
  <div class="home">
    <h1 class="">Loja</h1>
    <StoreDetails :store="store" v-if="store" />
    <h3 class="mt-8">Histórico de Transações</h3>
    <TransactionList :transactions="transactions" />
  </div>
</template>

<script>
import TransactionService from '@/services/transaction'
import StoreService from '@/services/store'
import TransactionList from '@/components/TransactionList.vue'
import StoreDetails from "@/components/StoreDetails"

export default {
  props: {
    id: {
      type: Number,
      required: true
    }
  },
  data() {
     return {
       store: null,
       transactions: []
     }
  },
  methods: {
    async load() {
      try{
        let response = await TransactionService.list(this.id)
        this.transactions = response.data.data
      } catch(e) {
        console.log(e);
      }
    },
    async loadStore() {
      try{
        let response = await StoreService.show(this.id)
        this.store = response.data.data
      } catch(e) {
        console.log(e);
      }
    }
  },
  mounted() {
    console.log(this.store)
    this.load()
    this.loadStore()
  },
  components: {
    TransactionList,
    StoreDetails
  },
}
</script>
