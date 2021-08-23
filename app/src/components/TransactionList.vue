<template>
  <div>
    <table class="striped">
      <thead>
      <tr>
        <th>Data</th>
        <th>Tipo</th>
        <th>Valor</th>
        <th>Cartão</th>
        <th>CPF</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="transaction in transactions" :key="transaction.id">
        <td>{{ transaction.processed_at | moment('DD/MM/YYYY H:m:ss') }}</td>
        <td>{{ transaction.type.description }}</td>
        <td>
          <span :class="getClass(transaction)">{{ transaction.amount | currency }}</span></td>
        <td>{{ transaction.credit_card }}</td>
        <td>{{ transaction.document | mask('###.###.###-##') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    transactions: {
      type: Array
    }
  },
  methods: {
    getClass(transaction) {
      return {
        'danger': transaction.type.operator === '-',
        'success': transaction.type.operator === '+'
      }
    }
  }
}
</script>
