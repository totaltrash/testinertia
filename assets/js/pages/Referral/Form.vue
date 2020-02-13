<template>
  <div>
    <v-form class="white px-2">
      <v-container>
        <h1 class="font-weight-light my-4">Referral Form</h1>
        <h2 class="font-weight-light my-2">Child Details</h2>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field v-model="form.firstName" label="First name" :error-messages="errors.firstName"></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field v-model="form.lastName" label="Last name" :error-messages="errors.lastName"></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-menu
              ref="dateOfBirthMenu"
              v-model="dateOfBirthMenu"
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="formattedDateOfBirth"
                  label="Date of birth"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                ref="dateOfBirthPicker"
                v-model="form.dateOfBirth"
                :max="new Date().toISOString().substr(0, 10)"
                min="1910-01-01"
                change="save"
              ></v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" md="6">
            <v-select v-model="form.gender" label="Gender" :items="['Male', 'Female']" :error-messages="errors.gender"></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-autocomplete v-model="form.nationality" label="Nationality" :items="nationalities" :error-messages="errors.nationality"></v-autocomplete>
          </v-col>
          <v-col cols="12" md="6">
            <v-autocomplete v-model="form.language" label="Language spoken" :items="languages" :error-messages="errors.language"></v-autocomplete>
          </v-col>
          <v-col cols="12" md="6">
            <v-select v-model="form.atsi" label="Indigenous status" :items="['Not ATSI', 'Aboriginal / not TSI', 'TSI / not Aboriginal']" :error-messages="errors.atsi"></v-select>
          </v-col>

          <v-col cols="12" class="text-right">
            <v-btn color="primary" dark @click="save" :loading="sending">Submit</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    {{ $page }}
  </div>
</template>

<script>
import FormLayout from '~/shared/FormLayout'
import { format, parseISO } from 'date-fns'
import nationalities from '~/nationalities'
import languages from '~/languages'

export default {
  props: {
    guid: {
      required: true,
      type: String
    },
    errors: {
      required: false,
      type: Object,
      default () {
        return {}
      }
    }
  },
  data () {
    return {
      sending: false,
      dateOfBirthMenu: false,
      form: {
        firstName: '',
        lastName: '',
        dateOfBirth: null,
        nationality: null,
        language: null,
        gender: null,
        atsi: null,
      },
      nationalities,
      languages,
    }
  },
  methods: {
    save () {
      this.sending = true
      this.$inertia.put(this.$route('referral_submit', {id: this.item.id}), this.form)
        .then(() => this.sending = false)
    },
  },
  computed: {
    formattedDateOfBirth () {
      return this.form.dateOfBirth ? format(parseISO(this.form.dateOfBirth), 'dd/MM/yyyy') : ''
    }
  },
  watch: {
    dateOfBirthMenu (val) {
      val && setTimeout(() => (this.$refs.dateOfBirthPicker.activePicker = 'YEAR'))
    },
    'form.dateOfBirth': function (val) {
      val && (this.dateOfBirthMenu = false)
    }
  },
  layout: FormLayout,
}
</script>

<style>

</style>
