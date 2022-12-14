<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                    
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
