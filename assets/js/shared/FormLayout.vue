<template>
  <v-app id="app">
    <v-content>
      <v-container fluid>
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            md="10"
            lg="8"
            xl="5"
          >
            <slot />
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>

export default {
  data: () => ({
  }),
}

</script>
