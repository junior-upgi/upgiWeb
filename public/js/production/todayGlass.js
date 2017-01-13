var todayGlass = new Vue({
    el: '#todayGlass',
    data: {
        ip: null,
        auth: false,
        glasses: {},
        search: null,
        date: null,
    },

    mounted: function () {
        this.searchGlassInfo();
    },

    methods: {
        searchGlassInfo: function () {
            $.get( window.baseurl + "//production/getTodayGlassInfo/", function( results ) {
                console.log(results);
                todayGlass.glasses = results;
                var date = new Date(todayGlass.glasses[0]['date']);
                todayGlass.date = date.getFullYear() + '/' + (date.getMonth() + 1) + '/' +  date.getDate();
            }).fail(function(e){
                console.log( e );
            });
        },
    }
});   