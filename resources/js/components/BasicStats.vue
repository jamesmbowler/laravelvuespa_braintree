<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                    <div>Subscription duration: {{ picked }}</div>

                    <input type="radio" name="duration" value="MONTHLY" v-model="picked" />
                    <label for="one">Monthly - $10/month</label>
                    <br>
                    <input type="radio" name="duration" value="YEARLY" v-model="picked" />
                    <label for="two">Yearly - $100</label>
                    <!-- Putting the empty container you plan to pass to
                    `braintree.dropin.create` inside a form will make layout and flow
                    easier to manage -->
                    <form>
                        <div id="dropin-container"></div>
                    </form>
                    <button id="submit-button">Buy Subscription</button>
            </div>
        </div>
    </div>
</template>

<script>
    import dropin from 'braintree-web-drop-in';
    export default {
        data() {
            return {
                token: "",
                picked: 'MONTHLY',
                hideSubmit: true,
                payment_method_nonce: "",
                paypal_info: {
                    email: "",
                    payerId: ""
                }
            };
        },
        created() {
            const fetchData = async () => {
                await axios.get(
                    '/api/braintree/clientToken'
                ).then((response) => {
                    var button = document.querySelector('#submit-button');
                    dropin.create({
                        authorization: response.data.token,
                        selector: '#dropin-container',
                        dataCollector: true,
                        paypal: {
                            flow: 'vault'
                        }
                    }, function (createErr, instance) {
                        if (createErr) {
                            console.log('Create Error', createErr);
                            return;
                        }
                        button.addEventListener('click', function () {
                            instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
                                
                                console.log(payload);
                                axios.post(
                                    '/api/checkout', {
                                        payment_method_nonce: payload.nonce,
                                        device_data: payload.deviceData,
                                        time_period: document.querySelector('input[name = duration]:checked').value
                                    }
                                ).then((response) => {
                                    console.log(response.data);
                                });
                            });
                        });
                    })
                });
            };
            fetchData();
        },
    }
</script>
