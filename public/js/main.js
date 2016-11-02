
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

// var cmp = new Vue({
//     el: "info",
//     template: "#info-tmp",
//
//     data: function () {
//         return {
//             id: null,
//             name: ''
//         };
//     },
//
//     created: function () {
//         console.log('create');
//         this.getInfo();
//     },
//
//     methods: {
//         getInfo: function () {
//             console.log('get');
//             $.getJSON('/api/users/1/info/', function(data) {
//                     console.log(data);
//                     this.id = data.id;
//                     this.name = data.name;
//             }.bind(this));
//             // this.$http.get(
//             //     '/api/users/1/info/', function (res) {
//             //         console.log('ok');
//             //         console.log(res);
//             //         // this.info = res;
//             //     }, function (err) {
//             //         console.log('err');
//             //         console.log(err);
//             //     });
//         }
//     }
// });

var book = new Vue({
    el: "book",
    template: "#book_info",
    props: ['book_id'],

    data: function () {
        return {
            id: this.book_id,
            name: '',
            pages: 0,
            current_page: 0,
            text: '',
            prevBtn: false,
            nextBtn: false
        }
    },

    created: function () {
        this.getData(1);
    },

    methods: {
        getData: function (page) {
            $.getJSON('/api/book/' + this.id + '/page/' + page + '/', function (data) {
                this.id = data.id;
                this.name = data.name;
                this.pages = data.pages;
                this.current_page = data.current_page;
                this.text = data.text;

                if (this.current_page !== this.pages) {
                    this.nextBtn = true;
                } else {
                    this.nextBtn = false;
                }

                if (this.current_page > 1) {
                    this.prevBtn = true;
                } else {
                    this.prevBtn = false;
                }
            }.bind(this));
        },

        prev: function () {
            if (this.current_page > 1) {
                this.getData(this.current_page - 1);
            }
        },

        next: function () {
            if (this.current_page !== this.pages) {
                this.getData(this.current_page + 1);
            }
        },

        filterBtn: function (dir) {
            console.log('filter');
            if (dir) {
                if (this.current_page !== this.pages) {
                    return false;
                }
            } else {
                if (this.current_page > 1) {
                    return false;
                }
            }

            return true;
        }
    }
});