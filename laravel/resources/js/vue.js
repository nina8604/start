let app1 = new Vue({
    el:'#app1',
    data() {
        return {
            product: 'Nina'
        };
    },
    created() {
        // debugger;
    },
    methods: {
        changeProduct() {
            // debugger;
            this.product = 'vova';
        }
    }
});