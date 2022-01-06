<template>
  <div>
    <div class="row mb-4">
      <div class="col-md-12">
        <h1>O que você está anunciando?</h1>
      </div>
    </div>
    <div class="row px-4 pb-5">
      <div class="col-md-12 box-ads">
        <form
          data-toggle="validator"
          role="form"
          class="form"
          action
          method="post"
          enctype="multipart/form-data"
        >
          <input type="hidden" id="token" name="_token" value />
          <div class="row text-left">
            <!-- ==================================================================================== -->
            <!-- Título do Anúncio                                                    -->
            <!-- ==================================================================================== -->
            <div class="col-12">
              <div class="form-group">
                <label for="name">Título do Anúncio</label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  v-model="title"
                  placeholder
                  required
                />
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <!-- ==================================================================================== -->
          <!-- Descrição do Anuncio                                                     -->
          <!-- ==================================================================================== -->
          <div class="row text-left">
            <div class="col-12">
              <div class="form-group">
                <label for="name">Descrição</label>
                <textarea
                  class="form-control"
                  name="description"
                  id="description"
                  cols="30"
                  rows="3"
                  v-model="description"
                ></textarea>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <!-- ==================================================================================== -->
          <!-- Site do anúncio                                                     -->
          <!-- ==================================================================================== -->
          <div class="row text-left">
            <div class="col-12">
              <div class="form-group">
                <label for="site">
                  Site
                  <i
                    class="fa fa-question-circle help"
                    aria-hidden="true"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="O endereço em que o seu anúncio será redirecionado."
                  ></i>
                </label>
                <input
                  type="url"
                  class="form-control"
                  id="site"
                  name="site"
                  placeholder
                  v-model="site"
                  required
                />
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <div class="row text-left">
            <!-- ==================================================================================== -->
            <!-- Categoria Selecionada                                                     -->
            <!-- ==================================================================================== -->
            <div class="col-6">
              <label for="name">Seleciona a Categoria</label>

              <div class="list-group list-category">
                <a
                  v-for="(item, index) in categories"
                  :key="index"
                  href="#"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                  v-on:click.prevent="selectCategory(index)"
                  :class="{ 'active': categoryActive == item.id }"
                >
                  {{ item.name }}
                  <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </a>
              </div>
            </div>

            <!-- ==================================================================================== -->
            <!-- Subcategoria selecionada                                                       -->
            <!-- ==================================================================================== -->

            <input type="hidden" name="subcategory_id" id="subcategory_id" v-model="subcategoryActive" />
            <div class="col-6">
              <label for="name">Seleciona a Subcategoria</label>

              <div class="list-group list-category">
                <a
                  v-for="(item, index) in subcategories"
                  :key="index"
                  href="#"
                  v-on:click.prevent="selectSubcategory(index)"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                  :class="{ 'active': subcategoryActive == item.id }"
                >{{ item.name }}</a>
              </div>
            </div>
          </div>
          <!-- fm da div row -->

          <!-- ==================================================================================== -->
          <!--  Tipo do Anúncio                                                    -->
          <!-- ==================================================================================== -->
          <div class="row mt-3" v-if="canImageBox">
            <div class="col-md-12">
              <label for="name">Escolha o tipo de anúncio</label>

              <div class="row">
                <div
                  class="col-md-3"
                  style="margin-bottom: 20px;"
                  v-for="(item, index) in configsAds"
                  :key="index"
                >

                  <label class="label-plane-radio">
                    <input
                      type="radio"
                      class="radio-image"
                      name="advert_configuration_id"
                      :value="item.id"
                      v-model="advertConfigurationId"
                      @change="selectPlane"
                    />
                    <div class="card card-plane">
                      <img :src="item.img" class="card-img-top" alt />

                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <strong class="title">{{ item.title }}</strong>
                        </li>
                        <li class="list-group-item">
                          <strong>Plano:</strong>
                          {{ item.plane.amount_per_payment }} R$
                        </li>
                        <li class="list-group-item">
                          <strong>Período:</strong>
                          {{ item.plane.period }}
                        </li>
                        <li class="list-group-item text-center">
                          <span class="btn btn-outline-b-blue">Selecionar</span>
                        </li>
                      </ul>
                    </div>
                    <!-- //card -->
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- ==================================================================================== -->
          <!--  Imagem do Anúncio                                                    -->
          <!-- ==================================================================================== -->
          <div class="row" v-if="canImageBox">
            <div class="col-md-12" v-if="hasUpload">
              <label for="banner">Selecione a imagem do seu anúncio</label>

              <div class="row" id="rowBanner" style>
                <div class="form-group col-md-12">
                  <input
                    type="file"
                    id="banner"
                    name="banner"
                    @change="processFile($event)"
                    required
                  />
                  <p class="help-block"></p>
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="img-preview" v-if="imgPreview">
                <img :src="imgPreview" class="img-fluid" />
              </div>
            </div>
          </div>

          <!-- ==================================================================================== -->
          <!--  Dados de Compra                                                    -->
          <!-- ==================================================================================== -->
          <div class="row mt-5" v-if="(imgPreview || !hasUpload)">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header text-b-red">Sua Fatura</div>
                <div class="card-body">
                  <h5 class="card-title text-b-red">Responsável Financeiro</h5>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <strong>Nome:</strong>
                      {{ user.name }}
                    </li>
                    <li class="list-group-item">
                      <strong>Email:</strong>
                      {{ user.email }}
                    </li>
                  </ul>

                  <h5 class="card-title mt-3 text-b-red">Dados de Cobrança</h5>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <strong>Plano:</strong>
                      {{ plane.title }}
                    </li>
                    <li class="list-group-item">
                      <strong>Localização:</strong>
                      {{ plane.position }}
                    </li>
                    <li class="list-group-item">
                      <strong>Valor mensal:</strong>
                      {{ plane.amount_per_payment }} R$/mês
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-md-12">
              <div class="form-check m-0 p-0">
                <input
                  type="checkbox"
                  class="form-check-input styled-checkbox"
                  id="acept"
                  v-model="acept"
                />
                <label class="form-check-label" for="acept">Aceitar termos e condições</label>
              </div>
            </div>
          </div>

          <!-- ==================================================================================== -->
          <!--  Botão de Envio                                                    -->
          <!-- ==================================================================================== -->
          <div class="row mt-5">
            <div class="col-md-12">
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Será enviado um email
                <strong>dentro de 24 Horas</strong> com o link de pagamento após a
                nossa aprovação.
                <button
                  type="button"
                  class="close"
                  data-dismiss="alert"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-12">
              <button
                type="submit"
                class="btn btn-success btn-lg btn-block"
                v-if="(imgPreview || !hasUpload) && acept"
              >Anunciar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "",
      description: "",
      site: "",
      categoryActive: null,
      categories: [],
      subcategoryActive: null,
      subcategories: [],
      subcategoryId: "",
      advertConfigurationId: "",
      configsAds: [],
      imgPreview: null,
      acept: null,
      hasUpload: true,
      plane: {
        title: "",
        position: "",
        amount_per_payment: 0.0
      },
      user: {
        name: "",
        email: ""
      }
    };
  },

  computed: {
    canImageBox: function() {
      return this.subcategoryActive != null;
    }
  },
  methods: {
    selectCategory(index) {
      this.categoryActive = this.categories[index].id;
      this.subcategoryActive = null; //limpa para nova seleção
      this.advertConfigurationId = null;
      this.imgPreview = null;
      console.log(this.categories[index]);

      var category_id = this.categories[index].id;
      //carrega os dados das categories
      axios.get("/api/subcategories/" + category_id).then(response => {
        this.subcategories = response.data;
      });
    },

    selectSubcategory(index) {
      console.log(this.subcategories[index]);

      this.subcategoryActive = this.subcategories[index].id;

      this.subcategoryId = index; //determina o id da subcategoria
    },

    selectPlane() {
      // api/ads-config/4
      var id = this.advertConfigurationId;
      this.imgPreview = null;



      console.log(id);
      axios.get("/api/ads-config/" + id).then(response => {
        console.log(response.data);

        this.hasUpload = response.data[0].type != 5 ? true : false;

        this.plane.title = response.data[0].plane.name;
        this.plane.position = response.data[0].position;
        this.plane.amount_per_payment =
          response.data[0].plane.amount_per_payment;
      });
    },

    processFile(event) {
      var file = event.target.files[0];

      console.log(file);

      if (file) {
        if (file.type == "image/jpeg" || file.type == "image/png"  || file.type == "image/gif") {
          //se tem arquivo
          this.imgPreview = URL.createObjectURL(file);
        } else {
          this.imgPreview = null;
        }
      } else {
        this.imgPreview = null;
      }
    }
  },

  mounted: async function() {
    //pega o token e monta no hidden
    var csrf = document.getElementsByName("csrf-token");
    var token = csrf[0].content;
    var elementToken = document.getElementById("token");
    elementToken.value = token;

    //pega nome do usuário
    var auth_user_name = document.getElementsByName("auth-user-name");
    this.user.name = auth_user_name[0].content;

    //pega email do usuário
    var auth_user_name = document.getElementsByName("auth-user-email");
    this.user.email = auth_user_name[0].content;

    //carrega os dados das categories
    await axios.get("/api/categories").then(response => {
      this.categories = response.data;
    });

    //carrega os tipos de configurações de anúncios
    //carrega os dados das categories
    await axios.get("/api/ads-config").then(response => {
      this.configsAds = response.data;
    });
  }
};
</script>

<style lang="scss" scoped>
.box-ads {
  padding: 2rem;
  border: 1px solid #d2d2d2;
  border-radius: 5px;

  label {
    font-weight: 700;
    font-size: 1.2rem;
    color: #262626;
  }
  .form-control {
    border: 1px solid #d2d2d2;
    color: #4a4a4a;
    font-size: 16px;
    line-height: 1.2;
    font-family: Helvetica, sans-serif;
    padding: 10px 10px 10px 16px;
  }

  .fa.help {
    font-size: 0.7em;
  }

  .img-preview img {
    border: 1px solid #d2d2d2;
    max-width: 350px;
    max-height: 350px;
    padding: 0.5em;
  }

  .styled-checkbox {
    position: absolute; // take it out of document flow
    opacity: 0; // hide it

    & + label {
      position: relative;
      cursor: pointer;
      padding: 0;
      font-size: 1.3em;
      font-weight: normal;
    }

    // Box.
    & + label:before {
      content: "";
      margin-right: 10px;
      display: inline-block;
      vertical-align: text-top;
      width: 20px;
      height: 20px;
      background: white;
      border: 1px solid #0072bc;
    }

    // Box hover
    &:hover + label:before {
      background: #0072bc;
    }

    // Box focus
    &:focus + label:before {
      box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
    }

    // Box checked
    &:checked + label:before {
      background: #0072bc;
    }

    // Disabled state label.
    &:disabled + label {
      color: #b8b8b8;
      cursor: auto;
    }

    // Disabled box.
    &:disabled + label:before {
      box-shadow: none;
      background: #ddd;
    }

    // Checkmark. Could be replaced with an image
    &:checked + label:after {
      content: "";
      position: absolute;
      left: 5px;
      top: 9px;
      background: white;
      width: 2px;
      height: 2px;
      box-shadow: 2px 0 0 white, 4px 0 0 white, 4px -2px 0 white,
        4px -4px 0 white, 4px -6px 0 white, 4px -8px 0 white;
      transform: rotate(45deg);
    }
  }

  .card-plane {
    .title {
      font-size: 1em;
      width: 100%;
    }
  }

  .radio-image:checked + .card {
    border: 1px solid #0072bc;

    .btn {
      background: #0072bc;
      color: #ffffff;
    }
  }

  label.label-plane-radio {
    font-size: 1em;
    font-weight: normal;
  }
}
</style>
