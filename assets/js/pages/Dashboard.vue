<template>
  <p>Testing {{ prop }}</p>
</template>

<script>
export default {
  props: {
    prop: {
      required: true,
      type: String
    }
  }
}
</script>

<style>

</style>
