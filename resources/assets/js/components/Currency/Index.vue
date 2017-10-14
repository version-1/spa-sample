<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crypto Currency Rate</div>

                    <div class="panel-body">
                        <p>{{message}}</p>
                        <ul class="list-unstyled" v-if="!is_loading">
                            <li>
                                1{{name.toUpperCase()}} =   <span class="h2">{{currency.jpy.toLocaleString()}}</span> JPY
                            </li>
                            <li v-if="name != 'btc'">
                                1{{name.toUpperCase()}} =   <span class="h2">{{currency.btc.toLocaleString()}}</span> BTC
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crypto Currencies</div>

                    <div class="panel-body">
                        <p>{{message}}</p>
                        <ul class="list-unstyled" v-if="is_init">
                            <li v-for="(currency, key) in currencies" >
                                <span v-on:click="loading">
                                    <router-link :to="{ path: '/currencies/' + currency.key }" >{{currency.name_ja}} / {{currency.name_en}}</router-link>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.fetchCurrencies(),
        this.fetchRate(),
        this.timer = setInterval(this.fetchRate, 2000)
    },
    props:['name'],
    data() {
        return {
            currency: { 'currency':'', 'jpy': 0 , 'btc':0 },
            is_init: false,
            is_loading: true,
            message: "Fetching Data..."
        }
    },
    methods: {
        loading(){
            this.is_loading = true;
            this.message = "Fetching Data...";
        },
        fetchCurrencies() {
            axios.get('/api/currencies')
            .then(res =>  {
                this.currencies = res.data;
                this.is_loading = false;
                this.is_init = true;
                this.message = "";
            });
        },
        fetchRate() {
            if (this.name === undefined){
                this.name = 'btc';
            }
            axios.get('/api/rate/' + this.name)
            .then(res =>  {
                this.currency.btc = res.data.btc;
                this.currency.jpy = res.data.jpy;
                this.name = res.data.currency;
                this.is_loading = false;
                this.message = "";
            });

        },
        cancelAutoUpdate: function() {
            clearInterval(this.timer)
        }
    },
    beforeDestroy() {clearInterval(this.timer)}
}
</script>
