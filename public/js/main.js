
// new Vue({
//     el: "#info",
//     data: function () {
//         var data;
//         this.$http.get('/api/users/1/info/').then((res) => {
//             // console.log(res.body);
//             data = res.body;
//             console.log(data.id);
//             // this.$set('id', data.id);
//         }, (res) => {
//             //error
//         });
//         return data;
//     }
// });

var cmp = new Vue({
    el: "info",
    template: "#info-tmp",

    data: function () {
        return {
            id: null,
            name: ''
        };
    },

    created: function () {
        console.log('create');
        this.getInfo();
    },

    methods: {
        getInfo: function () {
            console.log('get');
            $.getJSON('/api/users/1/info/', function(data) {
                    console.log(data);
                    this.id = data.id;
                    this.name = data.name;
            }.bind(this));
            // this.$http.get(
            //     '/api/users/1/info/', function (res) {
            //         console.log('ok');
            //         console.log(res);
            //         // this.info = res;
            //     }, function (err) {
            //         console.log('err');
            //         console.log(err);
            //     });
        }
    }
});