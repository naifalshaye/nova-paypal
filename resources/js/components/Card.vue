<template>
    <card class="flex flex-col items-center justify-center" style="width:250px;">
        <div align="center" style="margin-top:-20px; margin-bottom:10px;">
            <div v-if="response.show_logo !== true">Paypal Balance:</div>
            <img :src="paypal_logo" v-show="response.show_logo === true"  width="150"/>
        </div>

        <div>
            <div class="text-center text-2lg font-light" v-if="response.ACK === 'Success'">${{response.L_AMT0}}</div>
            <div class="text-center" style="color:red; font-size:12px;" v-if="response.ACK === 'Failure'">{{response.L_SEVERITYCODE0}} {{response.L_ERRORCODE0}}: {{response.L_LONGMESSAGE0}}</div>
        </div>
    </card>
</template>

<script>

    export default {
        props: ['card'],

    data: () => {
        return {
            paypal_logo: 'https://www.paypalobjects.com/webstatic/en_US/mktg/pages/stories/pp_h_rgb.jpg',
            response: []

        }
    },
    mounted() {
        Nova.request().get('/nova-vendor/paypal/getBalance')
            .then(response => {
                this.response = response.data;
            }
        );
    },
}
</script>
