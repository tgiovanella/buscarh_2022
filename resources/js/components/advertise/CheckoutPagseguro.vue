<template>
    <div>
        <!-- trocar por componente -->
        <div class="text-center" id="loader" v-if="$wait.any">
            <div class="spinner-border mt-5" style="" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="text-center">Aguarde...</p>
        </div>
        <!-- fim do componente -->

        <div class="row mb-2">
            <div class="col-md-12">
                <h1>Checkout</h1>
            </div>

            <!-- <div class="col-md-12">
                <p>{{ form.sendHash }}</p>
                <p>{{ form.bandCard }}</p>
                <p>{{ form.tokenCard }}</p>
            </div> -->
        </div>

        <form
            data-toggle="validator"
            role="form"
            class="form"
            action
            method="post"
            @submit.prevent="checkout()"
        >
            <div class="row pb-4 mb-2 text-muted">
                <div class="col-md-7">
                    <div class="box-ads">
                        <input
                            type="hidden"
                            id="token"
                            name="_token"
                            :value="csrf"
                        />

                        <h3 class="title">Dados do Cartão</h3>

                        <!-- ==================================================================================== -->
                        <!-- Número de Cartão                                                   -->
                        <!-- ==================================================================================== -->
                        <div class="row text-left">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nome no Cartão</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        v-model="form.nameCard"
                                        placeholder
                                        required
                                        maxlength="100"
                                    />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ==================================================================================== -->
                        <!-- Número de Cartão                                                   -->
                        <!-- ==================================================================================== -->
                        <div class="row text-left">
                            <div class="col-12">
                                <div
                                    class="form-group"
                                    :class="[
                                        error.card,
                                        'has-error has-danger'
                                    ]"
                                >
                                    <label for="name">Número do Cartão</label>
                                    <input
                                        type="text"
                                        class="form-control bandeira-cartao"
                                        id="cartao"
                                        name="cartao"
                                        v-model="form.numCard"
                                        placeholder
                                        @keyup="checkBandeira"
                                        maxlength="16"
                                        required
                                    />
                                    <div class="help-block with-errors">
                                        <ul
                                            v-show="error.card"
                                            class="list-unstyled"
                                        >
                                            <li>Número de Cartão Inválido</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ==================================================================================== -->
                        <!-- Vencimento                                                 -->
                        <!-- ==================================================================================== -->
                        <div class="row text-left">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="mes">Mês</label>
                                    <select
                                        name="mes"
                                        id="mes"
                                        class="form-control"
                                        v-model="form.mouthCard"
                                        required
                                    >
                                        <option value>- selecione -</option>
                                        <option
                                            v-for="(item, index) in mesesCard"
                                            :value="item"
                                            :key="index"
                                            >{{ item }}</option
                                        >
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Ano</label>
                                    <select
                                        name="ano"
                                        id="ano"
                                        class="form-control"
                                        v-model="form.yearCard"
                                        required
                                    >
                                        <option value>- selecione -</option>

                                        <option
                                            v-for="(item, index) in anosCard"
                                            :key="index"
                                            :value="item"
                                            >{{ item }}</option
                                        >
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cvv"
                                        name="cvv"
                                        v-model="form.cvvCard"
                                        placeholder
                                        maxlength="3"
                                        required
                                    />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="box-ads">
                        <h3 class="title">Dados da Assinatura</h3>
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                <strong>{{ name_plane }}</strong>
                                <span class="badge badge-primary badge-pill"
                                    >{{ value_plane }} R$</span
                                >
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    <i
                                        class="fa fa-check text-b-green"
                                        aria-hidden="true"
                                    ></i>
                                    Pagamento Mensal
                                </span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    <i
                                        class="fa fa-check text-b-green"
                                        aria-hidden="true"
                                    ></i>
                                    {{ test_plane }} dias de teste
                                </span>
                            </li>

                            <li
                                v-if="category && subcategory"
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    <i
                                        class="fa fa-check text-b-green"
                                        aria-hidden="true"
                                    ></i>
                                    {{ category }} > {{ subcategory }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mb-4 pb-4">
                <div class="col-12 text-right">
                    <button
                        type="submit"
                        href="#"
                        class="btn btn-lg btn-success"
                    >
                        Finalizar Pagamento
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { async, reject } from "q";
export default {
    data() {
        return {
            form: {
                nameCard: "",
                numCard: "",
                mouthCard: "",
                yearCard: "",
                cvvCard: "",
                bandCard: "",
                sendHash: "",
                tokenCard: ""
            },

            error: {
                card: false
            }
        };
    },

    props: {
        ads_id: String,
        csrf: String,
        token: String,
        name_plane: String,
        reference: String,
        value_plane: String,
        test_plane: String,
        category: String,
        subcategory: String,
        plane_code: String,

        user: String //user name
    },

    methods: {
        setSessionPagseguro: async function() {
            const v = this;
            this.$wait.start();
            return new Promise(async (resolve, reject) => {
                try {
                    await axios
                        .get("/pagseguro/session")
                        .then(async function(res) {
                            //determina a sessão do pagseguro
                            PagSeguroDirectPayment.setSessionId(res.data);
                            v.$wait.end();
                            console.log(`Sessão pagseguro: ${res.data}`);
                            resolve(res.data);
                        });
                } catch (error) {
                    this.$wait.end();

                    reject(error);
                }
            });
        },

        setSenderHash: async function() {
            return new Promise(async (resolve, reject) => {
                try {
                    let hash = await PagSeguroDirectPayment.getSenderHash();
                    resolve(hash);
                } catch (error) {
                    reject(error);
                }
            });
        },

        checkBandeira: async function() {
            // console.log(this.form.numCard);
            const v = this;
            if (this.form.numCard.length > 5) {
                let numCard = this.form.numCard.length;
                ///pega a baideira do cartão
                await PagSeguroDirectPayment.getBrand({
                    cardBin: v.form.numCard, // v.form.numCard, //411111 visa
                    success: function(response) {
                        //bandeira encontrada
                        v.form.bandCard = response.brand.name;
                        v.error.card = false;
                        console.log(response);
                    },
                    error: function(response) {
                        v.error.card = true;
                        v.form.bandCard = "";

                        //tratamento do erro
                        console.log(response);
                    },
                    complete: function(response) {}
                });
            }
        },

        setCardToken: async function() {
            const v = this;

            return new Promise(async (resolve, reject) => {
                await PagSeguroDirectPayment.createCardToken({
                    cardNumber: v.form.numCard, // Número do cartão de crédito
                    brand: v.form.bandCard, // Bandeira do cartão
                    cvv: v.form.cvvCard, // CVV do cartão
                    expirationMonth: v.form.mouthCard, // Mês da expiração do cartão
                    expirationYear: v.form.yearCard, // Ano da expiração do cartão, é necessário os 4 dígitos.
                    success: function(response) {
                        // Retorna o cartão tokenizado.
                        console.log(response);

                        v.form.tokenCard = response.card.token;

                        resolve(response.card.token);
                    },
                    error: function(error) {
                        // Callback para chamadas que falharam.
                        console.log(error);
                        v.form.tokenCard = "";
                        reject(error);
                    },
                    complete: function(response) {}
                });
            });
        },

        setPlan: async function() {
            const v = this;
            return new Promise(async (resolve, reject) => {
                try {
                    let data = {
                        _token: v.csrf,
                        ads_id: v.ads_id,

                        plane_code: v.plane_code,
                        senderName: v.form.nameCard,
                        senderPhone: v.userData.phone,
                        senderEmail: v.userData.email,
                        senderHash: v.form.sendHash,
                        senderCPF: v.userData.cpf,
                        creditCardHolderBirthDate: v.userData.birth
                            .split("-")
                            .reverse()
                            .join("/"), //converte para dd/mm/yyyy
                        senderAddressStreet: v.userData.street,
                        senderAddressNumber: v.userData.number,
                        senderAddressComplement: v.userData.complement,
                        senderAddressDistrict: v.userData.destrict,
                        senderAddressPostalCode: v.userData.cep,
                        senderAddressCity: v.userData.city_name,
                        senderAddressState: v.userData.uf,
                        creditCardToken: v.form.tokenCard
                    };

                    await axios
                        .post(`/checkout/${v.token}`, data)
                        .then(function(response) {
                            console.log(response.data);
                            resolve(response.data);
                        })
                        .catch(function(error) {
                            console.length(error);
                            reject(error);
                        });
                } catch (error) {
                    console.log(error);
                    reject(error);
                }
            });
        },

        checkout: async function(event) {
            const v = this;
            this.$wait.start();
            try {
                await this.setCardToken();
                await this.setPlan().then(res => {
                    v.$wait.end();

                    if (res.status) {
                        $.confirm({
                            title: "Pagamento Processado",
                            content:
                                "O seu pagamento foi processado. Em breve você receberá um email de confirmação!",
                            buttons: {
                                Ok: function() {
                                    window.location.href = "/";
                                }
                            }
                        });
                    } else {
                        $.confirm({
                            title: "Erro no processamento",
                            content: `Ocorreu um erro inesperado ao processar o pagamento. Verifique os dados do cartão e tente novamente mais tarde. ${res.message}`,
                            type: "red",

                            buttons: {
                                Ok: function() {
                                    // window.location.href = "/"; #redirecionamento
                                }
                            }
                        });
                    }
                });
                this.$wait.end();

                console.log("finalizado");
            } catch (error) {
                console.log(error);
                this.$wait.end();
            }
        }
    },

    computed: {
        anosCard: function() {
            let data = new Date();
            data = data.getFullYear();
            let dataFim = data + 11;
            let anos = [];
            for (let index = 0; data < dataFim; data++, index++) {
                anos.push(data);
            }

            return anos;
        },

        mesesCard: function() {
            return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        },

        userData: function() {
            return JSON.parse(this.user);
        }
    },

    async mounted() {
        const v = this;
        try {
            //abre a sessão do pagseguro
            await this.setSessionPagseguro();
            await this.setSenderHash().then(function(res) {
                v.form.sendHash = res;
            });
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="scss" scoped>
.box-ads {
    padding: 1rem;
    border: 1px solid #d2d2d2;
    border-radius: 5px;

    .title {
        font-size: 1.5em;
    }

    .bandeira-cartao {
        background: url("/img/pay/credit-card-6-24.gif") no-repeat scroll 98%
            7px;
    }

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
