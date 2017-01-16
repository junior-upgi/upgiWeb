var todayGlass = new Vue({
    el: '#todayGlass',
    data: {
        ip: null,
        auth: false,
        glasses: {},
        search: null,
        date: null,
        quantity: null,
    },

    mounted: function () {
        this.searchGlassInfo();
    },

    methods: {
        searchGlassInfo: function () {
            $.get( window.baseurl + "/production/getTodayGlassInfo", function( results ) {
                console.log(results);
                todayGlass.glasses = results;
                var date = new Date(todayGlass.glasses[0]['date']);
                todayGlass.setDate(date);
                todayGlass.sumQuantity();
            }).fail(function(e){
                console.log( e );
            });
        },

        sumQuantity: function () {
            var sum = 0;
            for (i = 0; i < todayGlass.glasses.length; i++) {
                var value = parseFloat(todayGlass.glasses[i]['quantity']);
                console.log(i + ": " + value);
                if (value > 0) {
                    sum += value;
                }
            }
            todayGlass.quantity = sum;
        },

        setDate: function (date) {

            todayGlass.date = date.getFullYear() + '/' + (date.getMonth() + 1) + '/' +  date.getDate();
        }
    }
});   