var glass = new Vue({
    el: '#glass',
    data: {
        ip: null,
        auth: false,
        glasses: {},
        search: '',
        searching: ''
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
            this.searching = 'searching...';
            $.get( window.baseurl + "/production/glassInfo/" + this.search, function( results ) {
                glass.glasses = results;
                glass.searching = '';
            }).fail(function(e){
                console.log( e );
            });
        },
        formatDate: function (date) {
            return moment(date, "YYYY-MM-DD").format("YYYY-MM-DD")
        }
    }
});   