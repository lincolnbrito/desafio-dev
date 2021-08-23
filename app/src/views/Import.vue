<template>
  <div class="import">
    <h1>Importar arquivo CNAB</h1>
    <p>Importe um arquivo <strong>CNAB.txt</strong> válido para atualizar as transações das lojas</p>
    <ImportForm />
  </div>
</template>

<script>
import ImportForm from "@/components/ImportForm";
export default {
  components: {
    ImportForm
  }
}
</script>
