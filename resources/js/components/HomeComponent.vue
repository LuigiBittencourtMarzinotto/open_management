<template>
  <div class="container-fluid m-0 vh-100 d-flex justify-content-center">
    <div class="row w-100">
      <div class="col-12 p-0">
        <card-component has-border="true">
          <template v-slot:body>
            <div class="row h-100">
              <div class="col-6 height-100">
                <card-component center="true">
                  <template v-slot:body>
                    <form-component form-id="frmLogin">
                      <template v-slot:body>
                        teettetet
                        <div class="mb-3 d-flex">
                          <GoogleLogin
                            :callback="callback"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            prompt
                            auto-login
                          />
                        </div>
                      </template>
                    </form-component>
                  </template>
                </card-component>
              </div>
              <div class="col-6"></div>
            </div>
          </template>
        </card-component>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const callback = (resposnse) => {
  console.log("adad", resposnse);
};
</script>