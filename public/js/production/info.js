var glass = new Vue({
    el: '#glass',
    data: {
        ip: null,
        auth: false,
        glasses: {},
        search: ''
    },

    mounted: function () {
        this.searchGlassInfo();
    },

    methods: {
        searchGlassInfo: function () {
            if (this.search == null || this.search == "") {
                this.glasses = {};
                return;
            }
            $.get( window.baseurl + "/production/glassInfo/" + this.search, function( results ) {
                glass.glasses = results;
            }).fail(function(e){
                console.log( e );
            });
        },
        formatDate: function (date) {
            return moment(date, "YYYY-MM-DD").format("YYYY-MM-DD")
        }
    }
});   