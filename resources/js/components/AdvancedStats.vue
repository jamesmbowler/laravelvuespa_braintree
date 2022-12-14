<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Advanced Stats</h3>
                    </div>
                    <div class="card-body">
                        <p>stats</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                post: null,
                error: null,
            }
        },
        created() {
            // watch the params of the route to fetch the data again
            this.$watch(
                () => this.$route.params,
                () => {
                    this.fetchData()
                },
                // fetch the data when the view is created and the data is
                // already being observed
                { immediate: true }
            )
        },
        methods: {
            fetchData() {
                this.error = this.post = null
                this.loading = true
                axios.get('/api/advanced_stats').
                    then((response) => {
                        this.stats = response.data
                });
            },
        },
    }
</script>
