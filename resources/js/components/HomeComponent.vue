<template>
  <div class="container-fluid m-0 vh-100 d-flex justify-content-center" > 
    <div class="row w-100">
      <div class="col-12 p-0">
        <card-component no-padding=true>
          <template v-slot:body>
            <div class="row h-100">
              <div class="col-lg-6 col-12 height-100">
                <component :is="currentComponent" :token="token" :route-dashboard="routeDashboard" :route-login="routeLogin" 
                  :route-register="routeRegister" :route-code-verification-email="routeCodeVerificationEmail" :route-verified-cep="routeVerifiedCep" 
                  :route-verified-email="routeVerifiedEmail" :route-forgetten-password="routeForgettenPassword"/>
              </div>
              <div class="col-lg-6 bg-overlay d-none d-lg-block"></div>
            </div>
          </template>
        </card-component>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from 'vuex';

export default {
  props: ['token', 'routeDashboard', 'routeLogin', 'routeRegister', 'routeCodeVerificationEmail', 'routeVerifiedEmail', 'routeForgettenPassword', 'routeVerifiedCep'],
  computed: {
    ...mapState(['currentComponent']),
  },
};
</script>