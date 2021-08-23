<template>
  <div class="home">
    <TransactionList :transactions="transactions" />
  </div>
</template>

<script>
import TransactionList from '@/components/TransactionList.vue'
import TransactionService from '@/services/transaction'

export default {
  props: {
    store: {
      type: Number,
      required: true
    }
  },
  data() {
     return {
       transactions: []
     }
  },
  methods: {
    async load() {
      try{
        let response = await TransactionService.list(this.store)
        this.transactions = response.data.data
      } catch(e) {
        console.log(e);
      }
    }
  },
  mounted() {
    this.load()
  },
  components: {
    TransactionList
  },
}
</script>
