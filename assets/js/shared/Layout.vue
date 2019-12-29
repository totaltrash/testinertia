<template>
  <v-app id="inspire">

    <v-navigation-drawer v-model="drawer" app>
      <v-list dense>
        <v-list-item link @click="$inertia.visit('/')" value="/">
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link @click="$inertia.visit('/item/')" value="/item/">
          <v-list-item-action>
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Items</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="blue" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-container fluid>
        <slot />
      </v-container>
    </v-content>

    <v-footer color="blue" app>
      <span class="white--text">&copy; 2019</span>
    </v-footer>

  </v-app>
</template>

<script>

export default {
  data: () => ({
    drawer: null,
  }),
}

</script>
