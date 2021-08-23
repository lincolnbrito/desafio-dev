<template>
  <div>
    <table>
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
        <td>{{ transaction.processed_at }}</td>
        <td>{{ transaction.type.description }}</td>
        <td>{{ transaction.amount }}</td>
        <td>{{ transaction.credit_card }}</td>
        <td>{{ transaction.document }}</td>
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
  }
}
</script>