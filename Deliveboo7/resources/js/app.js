require('./bootstrap');

require('slick-carousel');
window.Vue = require('vue');

document.addEventListener("DOMContentLoaded", function () {

    new Vue({
        el: '#app',

        data: {

            //data per filtro ricerca checkbox input
            categories: [],
            restaurantsList: [],
            allRestaurants: [],
            category_restaurant: [],
            filter: [],

            //data per filtro ricerca text input
            searchedRestaurantTxt: "",
            filteredRestaurants: [],
            txtFilteredRestaurant: [],
            showSearch: false,

            //data per piatti per carrello
            carrello: [],
            carrelloID: [],
            carrelloIDs: [],
            totalPrice: 0,
            productNumber: [],
            cartItems: 0,
            multiPrice: 0,

            //visibilità carrello
            cartHidden: true,

            //Statistiche
            allOrders: [],

            //visibilità helperInfo in showRestaurant
            hiddenHelperInfo: true,

            //visibilità ordini in showOrders
            hiddenOrdersPagati: true,
            hiddenChevronPagati: false,
            hiddenOrdersSospesi: true,
            hiddenChevronSospesi: false,
            hiddenOrdersRifiutati: true,
            hiddenChevronRifiutati: false,
            hiddenOrdersAccettati: true,
            hiddenChevronAccettati: false,
        },

        mounted: function () {
            console.log('Questa pagina utlizza VUE');
            this.getCategories();
            this.getAllRestaurants();

        },

        methods: {
            // Funzione di chiamata al controller per le categorie
            getCategories: function () {

                axios.get('/api/get/categories/')
                    .then(data => {

                        data.data.forEach(element => {
                            this.categories.push({
                                'id': element.id,
                                'nome': element.nome
                            });
                        });

                    }).catch((error) => {
                        console.log(error);
                    });
            },

            //funzione che richiama tutti i ristoranti dal db
            getAllRestaurants: function () {

                axios.get('/api/get/all/restaurants')
                    .then(data => {
                        this.restaurantsList = data.data[0];
                        this.category_restaurant = data.data[1];
                        this.giveGenres();
                    })
                    .catch((error) => {
                        console.log(error);
                    });

            },

            //funzione che prende i generi
            giveGenres: function () {

                for (let i = 0; i < this.restaurantsList.length; i++) {
                    this.restaurantsList[i].categories = [];
                    for (let j = 0; j < this.category_restaurant[i].length; j++) {
                        this.restaurantsList[i].categories.push({
                            'id': this.category_restaurant[i][j].id,
                            'name': this.category_restaurant[i][j].nome
                        });
                    }
                }
            },

            //filtro per categorie
            getFilteredRestaurant: function () {
                this.filteredRestaurants = [];
                let arrayCategorie = [];

                for (var i = 0; i < this.restaurantsList.length; i++) {
                    arrayCategorie.push(this.restaurantsList[i].categories);
                }

                this.restaurantsList.forEach(element => {
                    let categorie = element.categories;
                    let categoriesID = [];
                    let filter = [];

                    for (var i = 0; i < this.filter.length; i++) {
                        filter.push(parseInt(this.filter[i]));
                    }

                    for (var i = 0; i < categorie.length; i++) {
                        categoriesID.push(categorie[i].id);
                        let checker = (arr, target) => target.every(v => arr.includes(v));

                        if (checker(categoriesID, filter) && !this.filteredRestaurants.includes(element)) {
                            this.filteredRestaurants.push(element);
                        }
                    }
                });

            },

            //filtro per nome
            searchRestaurant: function () {

                if (this.searchedRestaurantTxt.length >= 0) {

                    this.filter = [];

                    axios.get('/api/get/all/restaurants')
                        .then(data => {
                            this.allRestaurants = data.data[0];
                            this.txtFilteredRestaurant = [];

                            for (let i = 0; i < this.allRestaurants.length; i++) {

                                const restaurant = this.allRestaurants[i];

                                const nomeSingoloRistorante = restaurant.nome_attivita;

                                if (nomeSingoloRistorante.toLowerCase().includes(this.searchedRestaurantTxt.toLowerCase())) {

                                    this.txtFilteredRestaurant.push(restaurant);

                                    console.log(this.txtFilteredRestaurant);
                                }
                                this.showSearch = true;
                            }

                        }).catch((error) => {
                            console.log(error);
                        });


                } else {
                    this.txtFilteredRestaurant = [];
                }
            },

            //aggiungi al carrello
            addToCart: function (dish) {
                let choosenDish = dish;

                if (this.cartHidden) {
                    this.showCart();
                }

                if (this.carrello.length == 0) {
                    choosenDish.counter = 1;
                    this.totalPrice += (choosenDish.prezzo);
                    this.carrello.push(choosenDish);
                    this.carrelloID.push(choosenDish.id);
                    this.carrelloIDs.push(choosenDish.id);
                    this.cartItems += 1;


                } else {
                    if (!this.carrelloID.includes(choosenDish.id)) {
                        this.carrello.push(choosenDish);
                        this.carrelloID.push(choosenDish.id);

                    }

                    for (let i = 0; i < this.carrello.length; i++) {

                        if (this.carrello[i].id == choosenDish.id) {
                            this.increase(this.carrello[i].id, i);
                        }
                    }
                }
            },

            // aumenta quantità
            increase: function (dishId, index) {
                this.carrelloIDs.push(this.carrello[index].id);
                if (this.carrello[index].counter >= 1) {
                    this.totalPrice += (this.carrello[index].prezzo);
                    this.carrello[index].counter++;
                    this.cartItems++;

                } else {
                    this.totalPrice += (this.carrello[index].prezzo);
                    this.carrello[index].counter = 1;
                    this.cartItems++;
                }
            },

            // diminuisci quantità
            decrease: function (dishId, index) {

                this.totalPrice -= (this.carrello[index].prezzo);
                this.cartItems--;

                if (this.carrelloIDs.includes(this.carrello[index].id)) {
                    let indice = this.carrelloIDs.indexOf(this.carrello[index].id)
                    this.carrelloIDs.splice(indice, 1);

                }

                if (this.carrello[index].counter > 1) {
                    this.carrello[index].counter--;

                } else {
                    this.carrello.splice(index, 1);
                    this.carrelloID.splice(index, 1);
                }

                if (this.carrello.length == 0) {
                    this.showCart();
                }
            },

            //mostro-nascondo helperInfo
            showHelperInfo: function () {

                this.hiddenHelperInfo = !this.hiddenHelperInfo;
            },

            // mostro-nascondo carrello
            showCart: function () {

                this.cartHidden = !this.cartHidden;
            },

            // mostro-nascondo ordini in pagati
            showOrdersPagati: function () {

                this.hiddenOrdersPagati = !this.hiddenOrdersPagati;
                this.hiddenChevronPagati = !this.hiddenChevronPagati;
            },

            // mostro-nascondo ordini sospesi
            showOrdersSospesi: function () {

                this.hiddenOrdersSospesi = !this.hiddenOrdersSospesi;
                this.hiddenChevronSospesi = !this.hiddenChevronSospesi;
            },

            // mostro-nascondo ordini rifiutati
            showOrdersRifiutati: function () {

                this.hiddenOrdersRifiutati = !this.hiddenOrdersRifiutati;
                this.hiddenChevronRifiutati = !this.hiddenChevronRifiutati;
            },

            // mostro-nascondo ordini accettati
            showOrdersAccettati: function () {

                this.hiddenOrdersAccettati = !this.hiddenOrdersAccettati;
                this.hiddenChevronAccettati = !this.hiddenChevronAccettati;
            },

            getOrdersStats: function () {

                axios.get('/api/statistiche')
                    .then(data => {
                        this.allOrders = data.data;
                        console.log(this.allOrders);

                    }).catch((error) => {
                        console.log(error);
                    });
            }
        } // fine methods
    }); //fine vue


});

$(document).ready(() => {
    $('.autoplay').slick({
        // slidesToShow: 3,
        // slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
        //centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    //centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    //centerMode: true,
                    centerPadding: '80px',
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.single-item').slick();
})