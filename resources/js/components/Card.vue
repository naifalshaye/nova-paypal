<template>
    <card class="h-auto">
        <div class="px-3 py-3" style="min-height:200px;">
            <div align="left">
                <img :src="paypal_logo" v-show="hide_logo === false" width="150"/>
                <div class="spinner" id="spinner" align="center"></div>
            </div>

            <div v-show="!loading">
                <div style="margin-bottom: 20px; font-family: 'Arial';">
                    <div class="text-center text-2lg font-light" v-if="balance.ACK === 'Success'" style="font-size:14px; color:green;">Current Balance: ${{balance.L_AMT0}}</div>
                    <div class="text-center" style="color:red; font-size:12px;" v-if="balance.ACK === 'Failure'">{{balance.L_SEVERITYCODE0}} {{balance.L_ERRORCODE0}}: {{balance.L_LONGMESSAGE0}}</div>
                </div>
                <div style="margin-bottom:20px;" v-show="transactions">
                    <table class="table table-bordered table-hover table-responsive" style="font-size:14px; margin-left:45px;">
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        <tr v-for="transaction in transactions">
                            <td style="height: 40px; font-size:12px;">
                                <a :href="'https://www.paypal.com/activity/payment/' +transaction.transaction_id" target="_blank">{{transaction.transaction_id}}</a>
                            </td>
                            <td style="height: 40px;">{{transaction.timestamp}}</td>
                            <td style="height: 40px;">${{transaction.amt}}</td>
                            <td style="height: 40px;">{{transaction.status}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </card>
</template>
<script>
    export default {
        props: ['card'],
        data: () => {
            return {
                paypal_logo: 'https://www.paypalobjects.com/webstatic/en_US/mktg/pages/stories/pp_h_rgb.jpg',
                response: [],
                balance: [],
                hide_logo: false,
                loading: true
            }
        },
        mounted() {
            if (this.card.hide_logo == true){
                this.hide_logo = true;
            }
            Nova.request().get('/nova-vendor/paypal/getData', {
                params: {
                    days: this.card.days,
                    count: this.card.count
                }
            })
            .then(response => {
                this.balance = response.data.balance;
                this.transactions = response.data.transactions;
                this.loading = false;
                document.getElementById('spinner').style.display = 'none';

    });
        }
    }
</script>